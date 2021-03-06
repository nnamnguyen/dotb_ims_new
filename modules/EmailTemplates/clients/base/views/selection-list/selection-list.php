<?php

$viewdefs['EmailTemplates']['base']['view']['selection-list'] = array(
    'showPreview' => false,
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array (
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'link' => true,
                    'default' => true,
                    'related_fields' => array('body_html'),
                ),
                'created_by_name',
                array(
                    'name' => 'date_modified',
                    'label' => 'LBL_DATE_MODIFIED',
                    'default' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'has_variables',
                    'default' => true,
                    'sortable' => false,
                    'label' => 'LBL_TEMPLATE_HAS_VARIABLES',
                ),
                array(
                    'name' => 'description',
                    'default' => false,
                    'sortable' => false,
                    'label' => 'LBL_DESCRIPTION',
                ),
                array(
                    'name'  => 'assigned_user_name',
                    'label' => 'LBL_LIST_ASSIGNED_USER',
                    'default' => false,
                ),
                array(
                    'name'  => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'default' => false,
                    'readonly' => true,
                ),
            ),
        ),
    ),
    'orderBy' => array(
        'field' => 'name',
        'direction' => 'asc',
    ),
);
