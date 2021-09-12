<?php

$module_name = 'Configurator';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=Configurator&action=EditView',
        'label' =>'LBL_CONFIGURE_SETTINGS_TITLE',
        'acl_action'=>'',
        'acl_module'=>$module_name,
        'icon' => '',
    ),
    array(
        'route'=>'#bwc/index.php?module=Configurator&action=LogView',
        'label' =>'LBL_LOGVIEW',
        'acl_action'=>'',
        'acl_module'=>$module_name,
        'icon' => '',
    ),
);