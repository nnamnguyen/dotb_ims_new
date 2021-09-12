<?php

$viewdefs['Users']['base']['view']['customer-journey-config-users'] = array (
    'favorite' => false,
    'following' => false,
    'sticky_resizable_columns' => true,
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'deactivate_row_button',
                'type' => 'button',
                'label' => 'LBL_REVOKE_ACCESS_BUTTON',
                'acl_action' => 'edit',
                'primary' => true,
                'events' => array(
                    'click' => 'list:revoke:fire',
                ),
            ),
        ),
    ),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',
                'css_class' => 'btn',
                'tooltip' => 'LBL_REVOKE_ACCESS_BUTTON',
                'event' => 'list:revoke:fire',
                'icon' => 'fa-times',
                'acl_action' => 'edit',
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'customer-journey-config-users',
    ),
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'user_name',
                    'label' => 'LBL_USER_NAME',
                    'sortable' => true,
                ),
                array(
                    'name' => 'email',
                    'label' => 'LBL_EMAIL',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
                array (
                    'name' => 'is_admin',
                    'label' => 'LBL_IS_ADMIN',
                    'enabled' => true,
                    'default' => true,
                    'sortable' => true,
                ),
            ),
        ),
    ),
);
