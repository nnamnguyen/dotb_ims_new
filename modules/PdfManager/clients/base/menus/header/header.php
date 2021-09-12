<?php

$module_name = 'PdfManager';
$viewdefs[$module_name]['base']['menu']['header'] = array(
    array(
        'route' => '#bwc/index.php?' . http_build_query(
            array(
                'module' => $module_name,
                'action' => 'EditView'
            )
        ),
        'label' =>'LNK_NEW_RECORD',
        'acl_action'=>'create',
        'acl_module'=>$module_name,
        'icon' => 'fa-plus',
    ),
    array(
        'route' => '#bwc/index.php?' . http_build_query(
            array(
                'module' => $module_name,
                'action' => 'index'
            )
        ),
        'label' =>'LNK_LIST',
        'acl_action'=>'list',
        'acl_module'=>$module_name,
        'icon' => 'fa-bars',
    ),
    array(
        'route'=>'#bwc/index.php?return_module=PdfManager&return_action=index&module=Configurator&action=DotbpdfSettings',
        'label' =>'LNK_EDIT_PDF_TEMPLATE',
        'acl_action'=>'',
        'acl_module'=>'',
        'icon' => 'fa-pencil',
    ),
);
