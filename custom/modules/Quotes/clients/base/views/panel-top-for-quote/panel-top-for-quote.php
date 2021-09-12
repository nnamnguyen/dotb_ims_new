<?php

$viewdefs['Quotes']['base']['view']['panel-top-for-quote'] = array(
    'type' => 'panel-top',
    'template' => 'panel-top',

    'buttons' => array(
        array(
            'type' => 'button',
            'name' => 'create_order',
            'icon' => 'fa-plus',
            'css_class' => 'btn',
            'label' => 'Create Order',
            'event' => 'button:create_order:click',
            'acl_module' => 'Quotes',
            'acl_action' => 'create',
        ),

    ),

);
