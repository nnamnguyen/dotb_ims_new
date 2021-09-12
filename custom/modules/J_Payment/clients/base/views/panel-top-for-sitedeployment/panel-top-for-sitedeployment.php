<?php
$viewdefs['J_Payment']['base']['view']['panel-top-for-sitedeployment'] = array(
    'type' => 'panel-top',
    'template' => 'panel-top',
    'buttons' => array(
        array(
            'type' => 'button',
            'name' => 'add_balance_to_site',
            'icon' => 'fa-plus',
            'css_class' => 'btn',
            'label'=>'Add',
            'event' => 'button:add_balance_to_site:click',
            'acl_module' => 'J_Payment',
            'acl_action' => 'view',
        ),
    ),

);