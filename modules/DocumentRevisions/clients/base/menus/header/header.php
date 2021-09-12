<?php

$moduleName = 'Documents';
$viewdefs['DocumentRevisions']['base']['menu']['header'] = array(
    array(
        'route' => '#bwc/index.php?' . http_build_query(
            array(
                'module' => $moduleName,
                'action' => 'editview',
            )
        ),
        'label' => 'LNK_NEW_DOCUMENT',
        'acl_action' => 'create',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => '#'.$moduleName,
        'label' => 'LNK_DOCUMENT_LIST',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-bars',
    ),
);
