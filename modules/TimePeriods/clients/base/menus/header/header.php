<?php

$module_name = 'TimePeriods';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=TimePeriods&action=EditView&return_module=TimePeriods&return_action=DetailView',
        'label' =>'LNK_NEW_TIMEPERIOD',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => '',
    ),
    array(
        'route'=>'#bwc/index.php?module=TimePeriods&action=ListView&return_module=TimePeriods&return_action=DetailView',
        'label' =>'LNK_TIMEPERIOD_LIST',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => '',
    ),
);