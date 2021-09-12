<?php

$module_name = 'Contacts';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#'.$module_name.'/create',
        'label' =>'LNK_NEW_CONTACT',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name.'/vcard-import',
        'label' =>'LNK_IMPORT_VCARD',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_CONTACT_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route' => '#Reports?filterModule=' . $module_name,
        'label' =>'LNK_CONTACT_REPORTS',
        'acl_action'=>'list',
        'acl_module' => 'Reports',
        'icon' => 'fa-user-chart',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=Contacts&return_module=Contacts&return_action=index',
        'label' =>'LNK_IMPORT_CONTACTS',
        'acl_action'=>'import',
        'acl_module'=>$module_name,
        'icon' => 'fa-cloud-upload',
    ),
    array(
        'route' => '#bwc/index.php?module=C_SMS&action=sendSMS',
        'label' => 'LBL_SEND_SMS',
        'acl_action' => 'create',
        'acl_module' => 'C_SMS',
        'icon' => 'fa-comments',
    ),
);
