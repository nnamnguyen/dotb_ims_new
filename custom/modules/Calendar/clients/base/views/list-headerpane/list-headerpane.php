<?php


    $viewdefs['Calendar']['base']['view']['list-headerpane'] = array(

        'title' => 'LBL_PMSE_MY_PROCESSES',
        'buttons' => array(

            array(


                'label' => 'LNK_NEW_MEETING',
                'tooltip' => 'LNK_NEW_MEETING',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Meetings',
                'route'=>'#Meetings/create',
                'icon' => 'fa-users',
            ),
            array(


                'label' => 'LNK_NEW_CALL',
                'tooltip' => 'LNK_NEW_CALL',
                'acl_action' => 'create',
                'type' => 'button',
                'acl_module' => 'Calls',
                'route'=>'#Calls/create',
                'icon' => 'fa-plus',
            ),


            array(
                'name' => 'sidebar_toggle',
                'type' => 'sidebartoggle',
            ),
        ),
);