<?php

$module_name = 'Shippers';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#Shippers/create',
        'label' =>'LNK_NEW_SHIPPER',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => '',
    ),
    array(
        'route'=>'#TaxRates/create',
        'label' =>'LNK_NEW_TAXRATE',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => '',
    ),
);