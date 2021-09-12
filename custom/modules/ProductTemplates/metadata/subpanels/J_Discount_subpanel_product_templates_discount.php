<?php
// created: 2020-11-05 16:11:40
$subpanel_layout['list_fields'] = array (
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
    'remove_button'=>array(
        'vname' => 'LBL_REMOVE',
        'widget_class' => 'SubPanelRemoveButton',
        'module' => 'ProductTemplates',
        'width' => '1%',
    ),
);