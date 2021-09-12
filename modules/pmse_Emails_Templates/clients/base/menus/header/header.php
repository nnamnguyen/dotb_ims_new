<?php



$moduleName = 'pmse_Emails_Templates';
$viewdefs[$moduleName]['base']['menu']['header'] = array(
    array(
        'route' => "#$moduleName/create",
        'label' => 'LNK_NEW_PMSE_EMAILS_TEMPLATES',
        'acl_action' => 'create',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => "#$moduleName",
        'label' => 'LNK_LIST',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#'.$moduleName.'/layout/emailtemplates-import',
        'label' =>'LNK_IMPORT_PMSE_EMAILS_TEMPLATES',
        'acl_action'=>'import',
        'acl_module'=>$moduleName,
        'icon' => 'fa-cloud-upload',
    ),
);
