<?php

$viewdefs['Cases']['base']['view']['dupecheck-list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'case_number',
                    'label' => 'LBL_LIST_NUMBER',
                    'default' => true,
                    'enabled' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'name',
                    'label' => 'LBL_LIST_SUBJECT',
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'account_name',
                    'label' => 'LBL_LIST_ACCOUNT_NAME',
                    'module' => 'Accounts',
                    'id' => 'ACCOUNT_ID',
                    'ACLTag' => 'ACCOUNT',
                    'related_fields' => array('account_id'),
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'priority',
                    'label' => 'LBL_LIST_PRIORITY',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_STATUS',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_ASSIGNED_TO_NAME',
                    'id' => 'ASSIGNED_USER_ID',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'default' => false,
                    'enabled' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'team_name',
                    'label' => 'LBL_LIST_TEAM',
                    'default' => false,
                    'enabled' => true,
                ),
            ),
        ),
    ),
);
