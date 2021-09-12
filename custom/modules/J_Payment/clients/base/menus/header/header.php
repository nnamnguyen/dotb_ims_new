<?php



$moduleName = 'J_Payment';
$viewdefs[$moduleName]['base']['menu']['header'] = array(
//    array(
//        'route' => "#bwc/index.php?module=$moduleName&action=EditView&payment_type=Enrollment",
//        'label' => 'LNK_CREATE_ENROLLMENT',
//        'acl_action' => 'create',
//        'acl_module' => $moduleName,
//        'icon' => 'fa-plus',
//    ),
    array(
        'route' => "#bwc/index.php?module=$moduleName&action=EditView&payment_type=Cashholder",
        'label' => 'LNK_CREATE_PAYMENT',
        'acl_action' => 'create',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => "#$moduleName",
        'label' => 'LNK_LIST',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-bars',
    ),
);
