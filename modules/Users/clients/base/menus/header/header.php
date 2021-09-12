<?php



use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Config;

global $dotb_config;

$moduleName = 'Users';
$idpConfig  = new Config(\DotbConfig::getInstance());
$isIDMModeEnabled  = $idpConfig->isIDMModeEnabled();
if ($isIDMModeEnabled) {
    $newUserLink = [
        'route' => $idpConfig->buildCloudConsoleUrl('userCreate'),
        'openwindow' => true,
        'label' => 'LNK_NEW_USER',
        'acl_action' => 'admin',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ];
} else {
    $newUserLink = [
        'route' => '#bwc/index.php?' . http_build_query(
            [
                'module' => $moduleName,
                'action' => 'EditView',
            ]
        ),
        'label' => 'LNK_NEW_USER',
        'acl_action' => 'admin',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ];
}

$viewdefs[$moduleName]['base']['menu']['header'] = array(
    $newUserLink,
    array(
        'route' => '#bwc/index.php?' . http_build_query(
            array(
                'module' => $moduleName,
                'action' => 'EditView',
                'usertype'=>'group',
                'return_module' => $moduleName,
                'return_action' => 'DetailView',
            )
        ),
        'label' => 'LNK_NEW_GROUP_USER',
        'acl_action' => 'admin',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ),
);
if (!empty($dotb_config['enable_web_services_user_creation'])) {
    $viewdefs[$moduleName]['base']['menu']['header'][] =
        array(
            'route' => '#bwc/index.php?' . http_build_query(
                array(
                    'module' => $moduleName,
                    'action' => 'EditView',
                    'usertype'=>'portal',
                    'return_module' => $moduleName,
                    'return_action' => 'DetailView',
                )
            ),
            'label' => 'LNK_NEW_PORTAL_USER',
            'acl_action' => 'admin',
            'acl_module' => $moduleName,
            'icon' => 'fa-plus',
        );
}
$viewdefs[$moduleName]['base']['menu']['header'][] =
    array(
        'route' => '#bwc/index.php?' . http_build_query(
                array(
                    'module' => $moduleName,
                    'action' => 'EditView',
                    'usertype'=>'portal',
                    'return_module' => $moduleName,
                    'return_action' => 'DetailView',
                )
            ),
        'label' => 'LNK_NEW_PORTAL_USER',
        'acl_action' => 'admin',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    );
$viewdefs[$moduleName]['base']['menu']['header'][] =
    array(
        'route' => '#bwc/index.php?' . http_build_query(
            array(
                'module' => $moduleName,
                'action' => 'reassignUserRecords',
            )
        ),
        'label' => 'LNK_REASSIGN_RECORDS',
        'acl_action' => 'admin',
        'acl_module' => $moduleName,
        'icon' => 'fa-arrows',
    );

if (!$isIDMModeEnabled) {
    $viewdefs[$moduleName]['base']['menu']['header'][] = [
        'route' => '#bwc/index.php?' . http_build_query([
            'module' => 'Import',
            'action' => 'Step1',
            'import_module' => $moduleName,
            'return_module' => $moduleName,
            'return_action' => 'index',
        ]),
        'label' => 'LNK_IMPORT_USERS',
        'acl_action' => 'admin',
        'acl_module' => $moduleName,
        'icon' => 'fa-cloud-upload',
    ];
}
