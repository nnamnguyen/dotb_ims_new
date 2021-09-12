<?php


$module_name = 'pmse_Emails_Templates';
$viewdefs[$module_name ]['base']['view']['recordlist'] = array(
    'favorite' => true,
    'following' => false,
    'selection' => array(
    ),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',

                'tooltip' => 'LBL_PREVIEW',

                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'tooltip' => 'LBL_PMSE_LABEL_DESIGN',
'label' => 'LBL_PMSE_LABEL_DESIGN',
                'icon' => 'fa-magic',

                'event' => 'list:editemailstemplates:fire',
                'acl_action' => 'view',
            ),
            array(
                'type' => 'rowaction',
                'tooltip' => 'LBL_PMSE_LABEL_EXPORT',
'label' => 'LBL_PMSE_LABEL_EXPORT',
                'icon' => 'fa-print',
                'css_class' =>'btn',
                'event' => 'list:exportemailstemplates:fire',
                'acl_action' => 'view',
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'record-list',
    ),
);
