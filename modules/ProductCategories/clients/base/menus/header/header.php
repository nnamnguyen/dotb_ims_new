<?php

$module_name = 'ProductCategories';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#ProductCategories/create',
        'label' =>'LNK_NEW_PRODUCT',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#ProductTemplates',
        'label' =>'LNK_PRODUCT_LIST',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-list',
    ),
    array(
        'route'=>'#Manufacturers',
        'label' =>'LNK_NEW_MANUFACTURER',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-list',
    ),
    array(
        'route'=>'#ProductCategories',
        'label' =>'LNK_NEW_PRODUCT_CATEGORY',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-list',
    ),
    array(
        'route'=>'#ProductTypes',
        'label' =>'LNK_NEW_PRODUCT_TYPE',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-list',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=ProductCategories&return_module=ProductCategories&return_action=index',
        'label' =>'LNK_IMPORT_PRODUCT_CATEGORIES',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-cloud-upload',
    ),

);
