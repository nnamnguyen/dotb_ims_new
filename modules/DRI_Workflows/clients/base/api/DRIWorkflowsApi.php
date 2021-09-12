<?php

use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;

require_once 'include/api/DotbApi.php';
require_once 'modules/DRI_Workflows/ConnectorHelper.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRIWorkflowsApi extends DotbApi
{
    /**
     * @return array
     */
    public function registerApiRest() {
        return array (
            'chartData' => array(
                'reqType' => 'GET',
                'path' => array('?', '?', 'customer-journey', 'chart-data'),
                'pathVars' => array('module', 'record'),
                'method' => 'chartData',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'momentumChart' => array(
                'reqType' => 'GET',
                'path' => array('?', '?', 'customer-journey', 'momentum-chart'),
                'pathVars' => array('module', 'record'),
                'method' => 'momentumChart',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'widgetData' => array(
                'reqType' => 'GET',
                'path' => array('DRI_Workflows', '?', 'widget-data'),
                'pathVars' => array('module', 'record'),
                'method' => 'widgetData',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'cancel' => array(
                'reqType' => 'POST',
                'path' => array('DRI_Workflows', '?', 'cancel'),
                'pathVars' => array('module', 'record'),
                'method' => 'cancel',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'archive' => array(
                'reqType' => 'POST',
                'path' => array('DRI_Workflows', '?', 'archive'),
                'pathVars' => array('module', 'record'),
                'method' => 'archive',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'unarchive' => array(
                'reqType' => 'POST',
                'path' => array('DRI_Workflows', '?', 'unarchive'),
                'pathVars' => array('module', 'record'),
                'method' => 'unarchive',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'start' => array(
                'reqType' => 'POST',
                'path' => array('?', '?', 'customer-journey', 'start-cycle'),
                'pathVars' => array('module', 'record'),
                'method' => 'start',
                'shortHelp' => '',
                'longHelp' => '',
                'noEtag' => true,
            ),
            'validateLicense' => array(
                'reqType' => 'GET',
                'path' => array('DRI_Workflows', 'validate-license'),
                'pathVars' => array('module', 'record'),
                'method' => 'validateLicense',
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
     * @throws Exception
     */
    public function chartData(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));

        try {
            $this->checkLicense();

            $journey = $this->getChartJourneyFromArgs($api, $args);

            $data = array (
                'id' => $journey->id,
                'name' => $journey->name,
                'state' => $journey->state,
                'progress' => $journey->progress,
                'stages' => array (),
            );

            foreach ($journey->getStages() as $stage) {
                $data['stages'][] = array (
                    'id' => $stage->id,
                    'label' => $stage->label,
                    'name' => $stage->name,
                    'state' => $stage->state,
                );
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $data;
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     * @throws DotbApiExceptionError
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws Exception
     */
    public function momentumChart(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));

        try {
            $this->checkLicense();

            $journey = $this->getChartJourneyFromArgs($api, $args);
            $ratio = round($journey->momentum_ratio * 100);

            $data = array(
                'id' => $journey->id,
                'name' => $journey->name,
                'ratio' => $ratio,
                "values" => array (
                    array(
                        "group" => 1,
                        "t" => $ratio,
                    ),
                ),
                'data' => array(
                    array(
                        "key" => "Range 1",
                        "y" => 25,
                        "color" => "#e61718"
                    ),
                    array(
                        "key" => "Range 2",
                        "y" => 50,
                        "color" => "#fb8724"
                    ),
                    array(
                        "key" => "Range 3",
                        "y" => 75,
                        "color" => "#e5a117"
                    ),
                    array(
                        "key" => "Range 4",
                        "y" => 100,
                        "color" => "#33800d"
                    )
                  ),
            );
        } catch (\Exception $e) {
            throw $e;
        }

        return $data;
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return DRI_Workflow|null|DotbBean
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    private function getChartJourneyFromArgs(ServiceBase $api, array $args)
    {
        $bean = $this->loadBean($api, $args);

        if (!$bean) {
            // Couldn't load the bean
            throw new DotbApiExceptionNotFound('Could not find record: ' . $args['record'] . ' in module: ' . $args['module']);
        }

        if ($bean instanceof DRI_Workflow) {
            $journey = $bean;
        } else {
            $bean->load_relationship('dri_workflows');

            $journeys = $bean->dri_workflows->getBeans(array('orderby' => 'date_entered DESC'));

            $GLOBALS['log']->info("CJ: loading chart data for journey {$bean->id} for parent {$args['module']}:{$args['record']}");

            if (!empty($args['selected'])) {
                $journey = BeanFactory::retrieveBean('DRI_Workflows', $args['selected']);
            } else {
                $journey = $this->getChartJourney($journeys);
            }
        }
        return $journey;
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     * @throws DotbApiExceptionError
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
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

        /** @var DRI_Workflow $journey */
        $journey = $this->loadBean($api, $args);

        $fields = array(
            'id',
            'name',
            'progress',
            'state',
            'score',
            'points',
            'archived',
            'description',
            'dri_workflow_template_id',
            'dri_workflow_template_name',
            'disabled_stage_actions',
            'disabled_activity_actions',
            'momentum_ratio',
            'momentum_points',
            'momentum_score',
        );

        foreach ($journey->getParentDefinitions() as $def) {
            $fields[] = $def['name'];
            $fields[] = $def['id_name'];
        }

        // start with loading the complete journey so we
        // can do this in the most optimised fashion
        $journey->load();

        $template = $journey->getTemplate();

        $data = $this->formatBean($api, array ('fields' => $fields), $journey);
        $data['stages'] = array ();
        $data['user_access'] = $user_access;
        $data['disabled_stage_actions'] = $template->getDisabledStageActions();
        $data['disabled_activity_actions'] = $template->getDisabledActivityActions();

        $GLOBALS['log']->info("CJ: loading widget data for journey {$journey->id} for parent {$args['module']}:{$args['record']}");

        if ($user_access) {
            foreach ($journey->getStages() as $stage) {
                if ($stage->ACLAccess('view')) {
                    $data['stages'][] = $this->formatStage($api, $args, $stage);
                }
            }
        }

        return $data;
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function cancel(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));

        $this->checkLicense();

        /** @var DRI_Workflow $journey */
        $journey = $this->loadBean($api, $args);

        $blocked = array ();
        foreach ($journey->getStages() as $stage) {
            foreach ($stage->getActivities() as $activity) {
                $activityHandler = ActivityHandlerFactory::factory($activity->module_dir);

                if ($activityHandler->isParent($activity)) {
                    foreach ($activityHandler->getChildren($activity) as $child) {
                        $childHandler = ActivityHandlerFactory::factory($child->module_dir);
                        if (!$childHandler->isCompleted($child)) {
                            if ($childHandler->isBlocked($child)) {
                                $blocked[$child->id] = $child;
                            } else {
                                $childHandler->setStatus($child, $childHandler->getNotApplicableStatus());
                                $child->save();
                            }
                        }
                    }
                } elseif (!$activityHandler->isCompleted($activity)) {
                    if ($activityHandler->isBlocked($activity)) {
                        $blocked[$activity->id] = $activity;
                    } else {
                        $activityHandler->setStatus($activity, $activityHandler->getNotApplicableStatus());
                        $activity->save();
                    }
                }
            }
        }

        foreach ($blocked as $activity) {
            $this->resolveBlock($activity, $blocked);
        }
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @throws DRI_SubWorkflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     * @throws DotbQueryException
     */
    public function archive(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));

        $this->checkLicense();

        /** @var DRI_Workflow $journey */
        $journey = $this->loadBean($api, $args);
        $journey->archived = true;
        $journey->save();
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @throws DRI_SubWorkflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflow_Templates_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_IdNotFound
     * @throws DRI_Workflows_Exception_ParentNotFound
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidParameter
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     * @throws DotbQueryException
     */
    public function unarchive(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));

        $this->checkLicense();

        /** @var DRI_Workflow $journey */
        $journey = $this->loadBean($api, $args);
        $journey->archived = false;
        $journey->save();
    }

    /**
     * @param DotbBean $activity
     * @param DotbBean[] $blocked
     */
    private function resolveBlock(\DotbBean $activity, array $blocked)
    {
        $activityHandler = ActivityHandlerFactory::factory($activity->module_dir);

        if (!$activityHandler->isCompleted($activity)) {
            foreach ($activityHandler->getBlockedByActivityIds($activity) as $blockedById) {
                $blockedBy = $blocked[$blockedById];
                $blockedByHandler = ActivityHandlerFactory::factory($blockedBy->module_dir);
                if (!$blockedByHandler->isBlocked($activity)) {
                    $blockedByHandler->setStatus($blockedBy, $blockedByHandler->getNotApplicableStatus());
                    $blockedBy->save();
                } else {
                    $this->resolveBlock($blockedBy, $blocked);
                }
            }

            $activityHandler->setStatus($activity, $activityHandler->getNotApplicableStatus());
            $activity->save();
        }
    }

    /**
     * @param DRI_Workflow[] $journeys
     * @return DRI_Workflow
     * @throws DotbApiExceptionNotFound
     */
    private function getChartJourney(array $journeys)
    {
        if (count($journeys) === 0) {
            throw new DotbApiExceptionNotFound();
        }

        foreach ($journeys as $journey) {
            if ($journey->state !== DRI_Workflow::STATE_COMPLETED) {
                return $journey;
            }
        }

        $journey = array_shift($journeys);

        if (!($journey instanceof DRI_Workflow)) {
            throw new DotbApiExceptionNotFound();
        }

        return $journey;
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @return array
     */
    public function validateLicense(ServiceBase $api, array $args)
    {
        $this->checkLicense();
        return array ();
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
     * @param array $args
     * @return array
     * @throws DotbApiExceptionMissingParameter
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function start(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record', 'template_id'));
        $this->checkLicense();
        $bean = $this->loadBean($api, $args);

        $GLOBALS['log']->info("CJ: starting journey template {$args['template_id']} on parent {$args['module']}:{$args['record']}");

        DRI_Workflow::start($bean, $args['template_id']);

        return $this->formatBean($api, $args, $bean);
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @param \DRI_SubWorkflow $stage
     * @return array
     */
    protected function formatStage(ServiceBase $api, array $args, $stage)
    {
        $fields = array (
            'id',
            'name',
            'label',
            'sort_order',
            'state',
            'score',
            'points',
            'progress',
            'momentum_ratio',
            'momentum_points',
            'momentum_score',
            'dri_subworkflow_template_id',
            'dri_subworkflow_template_name',
        );

        $data = $this->formatBean($api, array('fields' => $fields), $stage);

        $data['progress'] = (float)$data['progress'];
        $data['progress'] *= 100;
        $data['progress'] = round($data['progress']);

        $data['activities'] = array();
        foreach ($stage->getActivities() as $activity) {
            if ($activity->ACLAccess('view')) {
                $data['activities'][] = $this->formatActivity($api, $args, $activity);
            }
        }

        return $data;
    }

    /**
     * @param ServiceBase $api
     * @param array $args
     * @param \DotbBean $activity
     * @return array
     */
    protected function formatActivity(ServiceBase $api, array $args, \DotbBean $activity)
    {
        $fields = array (
            'id',
            'name',
            'status',
            'dri_workflow_sort_order',
            'customer_journey_type',
            'customer_journey_score',
            'customer_journey_progress',
            'customer_journey_points',
            'cj_parent_activity_type',
            'is_cj_parent_activity',
            'is_customer_journey_activity',
            'dri_subworkflow_id',
            'cj_parent_activity_id',
            'assigned_user_id',
            'assigned_user_name',
            'cj_momentum_start_date',
            'cj_momentum_end_date',
            'cj_momentum_points',
            'cj_momentum_ratio',
            'cj_momentum_score',
            'cj_url',
        );

        if ($activity instanceof Task) {
            $fields[] = 'date_due';
        } else {
            $fields[] = 'date_start';
        }

        $data = $this->formatBean($api, array ('fields' => $fields), $activity);
        $data['customer_journey_progress'] *= 100;
        $data['customer_journey_progress'] = round($data['customer_journey_progress']);
        $data['cj_momentum_ratio'] *= 100;
        $data['cj_momentum_ratio'] = round($data['cj_momentum_ratio']);

        $activityHandler = ActivityHandlerFactory::factory($activity->module_dir);

        $data['blocked_by'] = $activityHandler->getBlockedByActivityIds($activity);

        if ($activityHandler->hasParent($activity)) {
            $parent = $activityHandler->getParent($activity);

            if ($parent) {
                $parentHandler = ActivityHandlerFactory::factory($parent->module_dir);

                if ($parentHandler->isBlocked($parent)) {
                    $data['blocked_by'] = array_merge($data['blocked_by'], $parentHandler->getBlockedByActivityIds($parent));
                    $data['blocked_by'] = array_unique($data['blocked_by']);
                }
            }
        }

        if (!empty($data['assigned_user_id'])) {
            $user = BeanFactory::retrieveBean('Users', $data['assigned_user_id']);

            if ($user) {
                $userData = $this->formatBean($api, $args, $user);
                $data['assigned_user'] = $userData;
            }
        }

        if ($activityHandler->isParent($activity)) {
            $data['children'] = array();
            foreach ($activityHandler->getChildren($activity) as $child) {
                $data['children'][] = $this->formatActivity($api, $args, $child);
            }
        }

        $data['forms'] = array();
        if ($activityHandler->hasActivityTemplate($activity)) {
            foreach ($activityHandler->getForms($activity) as $form) {
                $data['forms'][] = $this->formatBean($api, $args, $form);
            }
        }

        return $data;
    }
}
