<?php

$viewdefs['DRI_SubWorkflow_Templates']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'dri_workflow_template_name',
                    'label' => 'LBL_DRI_WORKFLOW_TEMPLATE',
                    'enabled' => true,
                    'id' => 'DRI_WORKFLOW_TEMPLATE_ID',
                    'link' => true,
                    'sortable' => false,
                    'default' => true,
                ),
                array(
                    'name' => 'sort_order',
                    'label' => 'LBL_SORT_ORDER',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'related_activities',
                    'label' => 'LBL_RELATED_ACTIVITIES',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'points',
                    'label' => 'LBL_POINTS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'label' => 'LBL_DATE_MODIFIED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_modified',
                    'readonly' => true,
                ),
                array(
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'date_entered',
                    'readonly' => true,
                ),
                array(
                    'name' => 'team_name',
                    'label' => 'LBL_TEAM',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'created_by_name',
                    'label' => 'LBL_CREATED',
                    'enabled' => true,
                    'readonly' => true,
                    'id' => 'CREATED_BY',
                    'link' => true,
                    'sortable' => false,
                    'default' => false,
                ),
                array(
                    'name' => 'modified_by_name',
                    'label' => 'LBL_MODIFIED_NAME',
                    'enabled' => true,
                    'readonly' => true,
                    'id' => 'MODIFIED_USER_ID',
                    'link' => true,
                    'sortable' => false,
                    'default' => false,
                ),
            ),
        ),
    ),
    'orderBy' => array(
        'field' => 'date_modified',
        'direction' => 'desc',
    ),
);
