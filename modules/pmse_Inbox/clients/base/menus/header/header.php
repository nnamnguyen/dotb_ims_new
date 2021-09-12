<?php




$moduleName = 'pmse_Inbox';
$viewdefs[$moduleName]['base']['menu']['header'] = array(
//    array(
//        'route' => "#$moduleName/create",
//        'label' => 'LNK_NEW_RECORD',
//        'acl_action' => 'create',
//        'acl_module' => $moduleName,
//        'icon' => 'fa-plus',
//    ),
    array(
        'route' => "#$moduleName",
        'label' => 'LNK_LIST',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#'.$moduleName.'/layout/casesList',
        'label' =>'LNK_PMSE_INBOX_PROCESS_MANAGEMENT',
        'acl_action'=>'developer',
        'acl_module'=>$moduleName,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#'.$moduleName.'/layout/unattendedCases',
        'label' =>'LNK_PMSE_INBOX_UNATTENDED_PROCESSES',
        'acl_action'=>'developer',
        'acl_module'=>$moduleName,
        'icon' => 'fa-bars',
    ),
);
