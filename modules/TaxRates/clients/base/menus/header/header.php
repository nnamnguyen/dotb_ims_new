<?php

$module_name = 'TaxRates';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#Shippers',
        'label' =>'LNK_NEW_SHIPPER',
        'acl_action'=>'admin',
        'acl_module'=>'Products',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#TaxRates/create',
        'label' =>'LNK_NEW_TAXRATE',
        'acl_action'=>'admin',
        'acl_module'=>'Products',
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?module=Import&action=Step1&import_module=TaxRates&return_module=TaxRates&return_action=index',
        'label' =>'LNK_IMPORT_TAXRATES',
        'acl_action'=>'admin',
        'acl_module'=>'Products',
        'icon' => 'fa-cloud-upload',

    )
);
