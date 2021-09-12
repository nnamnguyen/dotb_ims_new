<?php

$viewdefs['Emails']['base']['view']['list-headerpane'] = array(
    'buttons' => array(
        array(
            'name' => 'create_button',
            'type' => 'emailaction',
            'label' => 'LBL_COMPOSE_MODULE_NAME_SINGULAR',
			'tooltip' => 'LBL_COMPOSE_MODULE_NAME_SINGULAR',
            'button' => true,
            'primary' => true,
            'acl_action' => 'create',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
