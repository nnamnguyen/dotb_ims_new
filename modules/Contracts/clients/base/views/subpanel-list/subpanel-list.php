<?php

$viewdefs['Contracts']['base']['view']['subpanel-list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'account_name',
                    'target_record_key' => 'account_id',
                    'target_module' => 'Accounts',
                    'label' => 'LBL_LIST_ACCOUNT_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'start_date',
                    'label' => 'LBL_LIST_START_DATE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'end_date',
                    'label' => 'LBL_LIST_END_DATE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'status',
                    'label' => 'LBL_LIST_STATUS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'total_contract_value',
                    'label' => 'LBL_LIST_CONTRACT_VALUE',
                    'related_fields' => array(
                        'total_contract_value',
                        'currency_id',
                        'base_rate',
                    ),
                    'currency_field' => 'currency_id',
                    'base_rate_field' => 'base_rate',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'name' => 'edit_button',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire','css_class'=>'btn',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'unlink-action',
                'icon' => 'fa-chain-broken',
                'tooltip' => 'LBL_UNLINK_BUTTON', 'css_class'=>'btn',
            ),
        ),
    ),
);
