<?php



$moduleName = '{$moduleName}';
$viewdefs[$moduleName]['base']['menu']['header'] = array(
    array(
        'route' => "#$moduleName/create",
        'label' => 'LNK_NEW_RECORD',
        'acl_action' => 'create',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ),
{if $showVcard}
    array(
        'route' => "#$moduleName/vcard-import",
        'label' => 'LNK_IMPORT_VCARD',
        'acl_action' => 'create',
        'acl_module' => $moduleName,
        'icon' => 'fa-plus',
    ),
{/if}
    array(
        'route' => "#$moduleName",
        'label' => 'LNK_LIST',
        'acl_action' => 'list',
        'acl_module' => $moduleName,
        'icon' => 'fa-bars',
    ),
{if $showImport}
    array(
        'route' => "#bwc/index.php?module=Import&action=Step1&import_module=$moduleName&return_module=$moduleName&return_action=index",
        'label' => 'LBL_IMPORT',
        'acl_action' => 'import',
        'acl_module' => $moduleName,
        'icon' => 'fa-arrow-circle-o-up',
    ),
{/if}
);
