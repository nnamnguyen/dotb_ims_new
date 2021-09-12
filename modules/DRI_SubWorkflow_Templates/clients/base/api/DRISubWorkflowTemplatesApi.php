<?php

require_once 'include/api/DotbApi.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRISubWorkflowTemplatesApi extends DotbApi
{
    /**
     * @return array
     */
    public function registerApiRest() {
        return array(
            'getLastStage' => array(
                'reqType' => 'GET',
                'path' => array('DRI_SubWorkflow_Templates','?', 'last-task'),
                'pathVars' => array('module', 'record'),
                'method' => 'getLastTask',
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
    public function getLastTask(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array ('module', 'record'));
        /** @var DRI_SubWorkflow_Template $bean */
        $bean = $this->loadBean($api, $args);
        return $this->formatBean($api, $args, $bean->getLastTask());
    }
}
