<?php


$viewdefs['Tags']['base']['view']['list-headerpane'] = array(

    'title' => 'LBL_MODULE_NAME',
    'buttons' => array(

        array(


            'label' => 'LNK_NEW_TAG',
			'tooltip' => 'LNK_NEW_TAG',
            'acl_action' => 'create',
            'type' => 'button',
            'acl_module' => 'Tags',
            'route'=>'#Tags/create',
            'icon' => 'fa-plus',
        ),

        array(


            'label' => 'LNK_IMPORT_TAGS',
			'tooltip' => 'LNK_IMPORT_TAGS',
            'acl_action' => 'import',
            'type' => 'button',
            'acl_module' => 'Tags',
            'route'=>'#bwc/index.php?' . http_build_query(
                    array(
                        'module' => 'Import',
                        'action' => 'Step1',
                        'import_module' => 'Tags',
                    )
                ),
            'icon' => 'fa-cloud-upload',
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
