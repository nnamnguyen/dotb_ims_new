<?php

$module_name = 'EmailTemplates';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route'=>'#bwc/index.php?module=EmailTemplates&action=EditView&return_module=EmailTemplates&return_action=DetailView',
        'label' =>'LNK_NEW_EMAIL_TEMPLATE',
        'acl_action'=>'create',
        'acl_module'=>'EmailTemplates',
        'icon' => 'fa-plus',
    ),
    array(
        'route'=>'#' . $module_name,
        'label' =>'LNK_EMAIL_TEMPLATE_LIST',
        'acl_action'=>'list',
        'acl_module'=>'EmailTemplates',
        'icon' => 'fa-bars',
    ),
);
