<?php


use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;

$module_name = 'Employees';
$idpConfig  = new Config(\DotbConfig::getInstance());
$isIDMModeEnabled  = $idpConfig->isIDMModeEnabled();
if ($isIDMModeEnabled) {
    $newEmployeeLink = [
        'route' => $idpConfig->buildCloudConsoleUrl('userCreate'),
        'openwindow' => true,
        'label' =>'LNK_NEW_EMPLOYEE',
        'acl_action'=>'admin',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ];
} else {
    $newEmployeeLink = [
        'route' => '#bwc/index.php?' . http_build_query([
                'module' => $module_name,
                'action' => 'EditView',
            ]),
        'label' =>'LNK_NEW_EMPLOYEE',
        'acl_action'=>'admin',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ];
}
$viewdefs[$module_name]['base']['menu']['header'] = array(
    $newEmployeeLink,
    array(
        'route'=>'#'.$module_name,
        'label' =>'LNK_EMPLOYEE_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
);
