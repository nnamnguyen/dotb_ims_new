<?php

require_once 'include/api/DotbApi.php';
require_once 'modules/DRI_Workflows/ConnectorHelper.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRIWorkflowTemplatesApi extends DotbApi
{
    /**
     * @return array
     */
    public function registerApiRest() {
        return array(
            'getLastStage' => array(
                'reqType' => 'GET',
                'path' => array('DRI_Workflow_Templates','?', 'last-stage'),
                'pathVars' => array('module', 'record'),
                'method' => 'getLastStage',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'widgetData' => array(
                'reqType' => 'GET',
                'path' => array('DRI_Workflow_Templates','?', 'widget-data'),
                'pathVars' => array('module', 'record'),
                'method' => 'widgetData',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
        );
    }

    /**
     * @param ServiceBase $api
     * @param array       $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function getLastStage(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));
        /** @var DRI_Workflow_Template $bean */
        $bean = $this->loadBean($api, $args);
        return $this->formatBean($api, $args, $bean->getLastStage());
    }

    /**
     *
     */
    private function checkLicense()
    {
        $helper = new \DRI_Workflows\ConnectorHelper();
        $helper->validateLicense();
    }

    /**
     * @param ServiceBase $api
     * @param array       $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function widgetData(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));

        $user_access = true;

        try {
            $this->checkLicense();
        } catch (\DRI_Workflows\Exception\UserNotAuthorizedException $e) {
            $user_access = false;
        }

        /** @var DRI_Workflow_Template $journey */
        $journey = $this->loadBean($api, $args);

        $data = $this->formatBean($api, array (), $journey);
        $data['stages'] = array ();
        $data['user_access'] = $user_access;

        $GLOBALS['log']->info("CJ: loading widget data for journey {$journey->id} for parent {$args['module']}:{$args['record']}");

        if ($user_access) {
            foreach ($journey->getStageTemplates() as $stage) {
                $data['stages'][] = $this->formatStage($api, $stage);
            }
        }

        return $data;
    }

    /**
     * @param ServiceBase $api
     * @param DRI_Workflow_Task_Template $activity
     * @return array
     */
    protected function formatActivity(ServiceBase $api, DRI_Workflow_Task_Template $activity)
    {
        $data = $this->formatBean($api, array (), $activity);

        $data['forms'] = array();
        $data['blocked_by'] = $activity->getBlockedByIds();

        if ($activity->is_parent) {
            $data['children'] = array ();
            foreach ($activity->getChildren() as $child) {
                $data['children'][] = $this->formatActivity($api, $child);
            }
        }

        $data['forms'] = array();
        foreach ($activity->getForms() as $form) {
            $data['forms'][] = $this->formatBean($api, array(), $form);
        }

        return $data;
    }

    /**
     * @param ServiceBase $api
     * @param DRI_SubWorkflow_Template $stage
     * @return array
     */
    protected function formatStage(ServiceBase $api, DRI_SubWorkflow_Template $stage)
    {
        $data = $this->formatBean($api, array(), $stage);

        $data['activities'] = array();
        $data['progress'] = 0;

        foreach ($stage->getActivityTemplates() as $activity) {
            /** @var DRI_Workflow_Task_Template $activity */
            $data['activities'][] = $this->formatActivity($api, $activity);
        }

        return $data;
    }
}
