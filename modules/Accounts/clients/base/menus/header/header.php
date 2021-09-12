<?php



$module_name = 'Accounts';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'label' =>'LNK_NEW_ACCOUNT',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
        'route'=>'#'.$module_name.'/create',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_ACCOUNT_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route' => '#Reports?filterModule=' . $module_name,
        'label' =>'LNK_ACCOUNT_REPORTS',
        'acl_action'=>'list',
        'acl_module' => 'Reports',
        'icon' => 'fa-user-chart',
    ),
    array(
        'route' => '#bwc/index.php?' . http_build_query(
            array(
                'module' => 'Import',
                'action' => 'Step1',
                'import_module' => $module_name,
            )
        ),
        'label' =>'LNK_IMPORT_ACCOUNTS',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
);
