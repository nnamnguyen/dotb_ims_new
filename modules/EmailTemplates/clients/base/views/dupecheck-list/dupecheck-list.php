<?php

$viewdefs['EmailTemplates']['base']['view']['dupecheck-list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'link' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'type',
                    'label' => 'LBL_TYPE',
                    'link' => false,
                    'default' => true
                ),
                array(
                    'name' => 'description',
                    'default' => true,
                    'sortable' => false,
                    'label' => 'LBL_DESCRIPTION'
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_LIST_ASSIGNED_USER',
                    'default' => true,
                ),
                array(
                    'name' => 'date_modified',
                    'label' => 'LBL_DATE_MODIFIED',
                    'default' => false,
                    'readonly' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'default' => false,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
