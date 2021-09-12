<?php


    $viewdefs['OutboundEmail']['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_MODULE_NAME',
        'buttons' => array(

            array(

                'label' => 'LBL_CREATE_BUTTON_LABEL',
                'tooltip' => 'LBL_CREATE_BUTTON_LABEL',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'OutboundEmail',
                'route'=>'#OutboundEmail/create',
                'icon' => 'fa-plus',
            ),

            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
    );
