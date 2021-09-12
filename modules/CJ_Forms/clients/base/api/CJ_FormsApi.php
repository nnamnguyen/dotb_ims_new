<?php

use CJ_Forms\TargetResolver;
use DRI_Workflow_Task_Templates\Activity\ActivityHandlerFactory;

require_once "modules/DRI_Workflow_Task_Templates/Activity/ActivityHandlerFactory.php";
require_once 'modules/CJ_Forms/TargetResolver.php';
require_once 'include/api/DotbApi.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class CJ_FormsApi extends DotbApi
{
    /**
     * @return array
     */
    public function registerApiRest() {
        return array (
            'target' => array(
                'reqType' => 'GET',
                'path' => array('?', '?', 'target'),
                'pathVars' => array('module', 'record'),
                'method' => 'target',
                'shortHelp' => '',
                'longHelp' => '',
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
    public function target(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record', 'activity_id'));

        /** @var CJ_Form $action */
        $action = $this->loadBean($api, $args);

        $activity = BeanFactory::retrieveBean($action->activity_module, $args['activity_id']);
        $handler = ActivityHandlerFactory::factory($activity->module_dir);
        $stage = $handler->getStage($activity);

        $finder = new TargetResolver($action);
        $response = $finder->resolve($stage, $activity);

        return array (
            'parent' => $this->formatBean($api, array (), $response['parent']),
            'target' => $response['target'] ? $this->formatBean($api, array (), $response['target']) : null,
            'linkName' => $response['linkName'],
            'module' => $response['module'],
        );
    }
}
