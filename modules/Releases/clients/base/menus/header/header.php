<?php

$module_name = 'Releases';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=Releases&action=EditView&return_module=Releases&return_action=DetailView',
        'label' =>'LNK_NEW_RELEASE',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-list',
    ),
);
