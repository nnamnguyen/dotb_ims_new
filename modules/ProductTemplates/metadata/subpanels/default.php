<?php


$module_name='ProductTemplates';
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
        'code' =>
        array (
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_CODE',
            'width' => '10%',
        ),
        'discount_price' =>
        array (
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_DISCOUNT_PRICE',
            'width' => '10%',
        ),
        'group_unit_name' =>
        array (
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_GROUP_UNIT_NAME',
            'width' => '10%',
        ),
        'unit_name' =>
        array (
            'studio' => 'visible',
            'vname' => 'LBL_UNIT',
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