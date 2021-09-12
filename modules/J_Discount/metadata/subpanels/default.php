<?php


$module_name='J_Discount';
$subpanel_layout = array(
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
        array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => $module_name),
    ),

    'where' => '',

    'list_fields' => array(
        'name' => 
        array (
            'vname' => 'LBL_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '20%',
            'default' => true,
        ),
        'status' => 
        array (
            'type' => 'enum',
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_STATUS',
            'width' => '10%',
        ),
        'type' => 
        array (
            'type' => 'enum',
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_TYPE',
            'width' => '10%',
        ),
        'apply_for' => 
        array (
            'type' => 'enum',
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_APPLY_FOR',
            'width' => '10%',
        ),
        'policy' => 
        array (
            'type' => 'text',
            'studio' => 'visible',
            'vname' => 'LBL_POLICY',
            'sortable' => false,
            'width' => '12%',
            'default' => true,
        ),
        'description' => 
        array (
            'type' => 'text',
            'vname' => 'LBL_DESCRIPTION',
            'sortable' => false,
            'width' => '12%',
            'default' => true,
        ),
        'date_entered' => 
        array (
            'vname' => 'LBL_DATE_ENTERED',
            'width' => '10%',
            'default' => true,
        ),
    ),
);

?>