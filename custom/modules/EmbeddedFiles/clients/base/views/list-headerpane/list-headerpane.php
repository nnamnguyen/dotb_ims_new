<?php


$viewdefs['EmbeddedFiles']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_EMBEDDEDFILES',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_EMBEDDED_FILE',
			'tooltip' => 'LNK_NEW_EMBEDDED_FILE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'EmbeddedFiles',
            'route'=>'#EmbeddedFiles/create',
            'icon' => 'fa-plus',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);