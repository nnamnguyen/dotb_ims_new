<?php

use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;

/**
 * This class contains logic hooks related to the Addoptify Customer Insight plugin for the leads module
 *
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class Leads_LogicHook_DRICustomerJourney
{
    /**
     * This logic hook stores the fetched_row before a lead is saved.
     *
     * It makes the fetched_row available after save for self::startJourney
     *
     * @param \Lead $lead
     */
    public function saveFetchedRow(\Lead $lead)
    {
        $lead->dri_customer_journey_fetched_row = $lead->fetched_row;
    }

    /**
     * This logic hook gets triggered after a lead is saved.
     *
     * If the conditions of self::shouldStartJourney is met, a new journey
     * will be started related to the lead
     *
     * @param \Lead $lead
     * @throws \DotbApiException
     */
    public function startJourney(\Lead $lead)
    {
        try {
            if ($this->shouldStartJourney($lead)) {
                DRI_Workflow::start($lead, $lead->dri_workflow_template_id);
                $lead->dri_customer_journey_started_template = $lead->dri_workflow_template_id;
            }
        } catch (\DotbApiException $e) {
            if ('invalid_license' !== $e->errorLabel) {
                throw $e;
            }
        }
    }

    /**
     * This logic hook gets triggered after a lead is converted, if the lead is related to an account,
     * all related journeys will be related to the converted account
     *
     * @param \Lead $lead
     * @throws \DotbApiException
     */
    public function convertLead(\Lead $lead)
    {
        $map = array ();
        $j = new \DRI_Workflow();

        foreach ($j->getParentDefinitions() as $def) {
            if ($def['module'] !== 'Leads') {
                $map[$def['module']] = !empty($def[\DRI_Workflow::PARENT_VARDEF_KEY]['lead_id_name'])
                    ? $def[\DRI_Workflow::PARENT_VARDEF_KEY]['lead_id_name']
                    : $def['id_name'];
            }
        }

        try {
            if (empty($lead->converted) || !empty($lead->dri_customer_journey_fetched_row['converted'])) {
                return;
            }

            $lead->load_relationship('dri_workflows');

            foreach ($lead->dri_workflows->getBeans() as $cycle) {
                /** @var \DRI_Workflow $cycle */
                $modules = $cycle->getAvailableModules();

                foreach ($modules as $module) {
                    if (!isset($map[$module])) {
                        continue;
                    }

                    if (!empty($lead->{$map[$module]})) {
                        $target = \BeanFactory::retrieveBean($module, $lead->{$map[$module]});
                        $this->loadRelationship($target);
                        $target->dri_workflows->add($cycle);
                    }
                }

                $cycle->retrieve();
                $parent = $cycle->getParent();
                foreach ($cycle->getStages() as $stage) {
                    foreach ($stage->getActivities() as $activity) {
                        $handler = ActivityHandlerFactory::factory($activity->module_dir);
                        $handler->populateFromParent($activity , $parent);
                        $activity->save($activity->assigned_user_id !== $GLOBALS['current_user']->id);
                        $handler->relateToParent($activity , $parent);
                    }
                }
            }
        } catch (\DotbApiException $e) {
            if ('invalid_license' !== $e->errorLabel) {
                throw $e;
            }
        }
    }

    /**
     * The journey will be started if the template id is set and one of the following conditions is met:
     *
     *   - the lead is new
     *   - the template id has been changed
     *
     * @param \Lead $bean
     * @return bool
     */
    private function shouldStartJourney(\Lead $bean)
    {
        return !empty($bean->dri_workflow_template_id)
            && (empty($bean->dri_customer_journey_started_template) || $bean->dri_workflow_template_id !== $bean->dri_customer_journey_started_template)
            && (empty($bean->dri_customer_journey_fetched_row)
                || $bean->dri_workflow_template_id !== $bean->dri_customer_journey_fetched_row['dri_workflow_template_id']);
    }

    /**
     * @param \DotbBean $bean
     * @throws \DotbApiException
     */
    private function loadRelationship(\DotbBean $bean)
    {
        $bean->load_relationship('dri_workflows');

        if (!($bean->dri_workflows instanceof \Link2)) {
            throw new \DotbApiException();
        }
    }
}
