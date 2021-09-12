<?php


$viewdefs['Notes']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_NOTE',
			'tooltip' => 'LNK_NEW_NOTE',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Notes',
            'route'=>'#Notes/create',
            'icon' => 'fa-comment-alt-medical',
        ),
        array(


            'label' => 'LNK_IMPORT_NOTES',
			'tooltip' => 'LNK_IMPORT_NOTES',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'Notes',
            'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Notes&return_module=Notes&return_action=index',
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
