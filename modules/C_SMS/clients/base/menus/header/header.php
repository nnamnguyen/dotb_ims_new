<?php
$moduleName = 'C_SMS';
$viewdefs[$moduleName]['base']['menu']['header'] = array(

    array(
        'route' => "#$moduleName",
        'label' => 'LNK_LIST',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-bars',
    ),
        array(
        'route' => '#bwc/index.php?module='.$moduleName.'&action=sendSMS',
        'label' => 'LBL_SEND_SMS',
        'acl_action' => 'create',
        'acl_module' => $moduleName,
        'icon' => 'fa-comments',
    ),
);
