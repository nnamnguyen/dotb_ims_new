<?php

require_once 'clients/base/api/RelateApi.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DRISubWorkflowTemplatesRelateApi extends RelateApi
{
    /**
     * @return array
     */
    public function registerApiRest() {
        return array(
            'filterRelatedRecords' => array(
                'reqType' => 'GET',
                'path' => array('DRI_SubWorkflow_Templates', '?', 'link', 'dri_workflow_task_templates', 'filter'),
                'pathVars' => array('module', 'record', '', 'link_name', ''),
                'jsonParams' => array('filter'),
                'method' => 'filterRelated',
                'shortHelp' => 'Lists related filtered records.',
                'longHelp' => 'include/api/help/module_record_link_link_name_filter_get_help.html',
            ),
            'listRelatedRecords' => array(
                'reqType' => 'GET',
                'path' => array('DRI_SubWorkflow_Templates', '?', 'link', 'dri_workflow_task_templates'),
                'pathVars' => array('module', 'record', '', 'link_name'),
                'jsonParams' => array('filter'),
                'method' => 'filterRelated',
                'shortHelp' => 'Lists related records.',
                'longHelp' => 'include/api/help/module_record_link_link_name_filter_get_help.html',
            ),
        );
    }

    public function filterRelated(ServiceBase $api, array $args)
    {
        $args['max_num'] = 20;
        return parent::filterRelated($api, $args);
    }
}
