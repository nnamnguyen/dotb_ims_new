<?php

global $current_user;
$module_name='J_Sponsor';
$subpanel_layout = array(
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
        array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => $module_name),
    ),

    'where' => ($current_user->isAdmin()) ? "" : "(j_sponsor.type = 'Sponsor')" ,

    'list_fields' => array(
        'name' =>
        array (
            'vname' => 'LBL_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '10%',
            'default' => true,
        ),
        'type' =>
        array (
            'type' => 'enum',
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_TYPE',
            'width' => '10%',
        ),
        'foc_type' =>
        array (
            'type' => 'enum',
            'default' => true,
            'studio' => 'visible',
            'vname' => 'LBL_FOC_TYPE',
            'width' => '10%',
        ),
        'sponsor_number' =>
        array (
            'type' => 'varchar',
            'vname' => 'LBL_SPONSOR_NUMBER',
            'width' => '10%',
            'default' => true,
        ),
        'amount' =>
        array (
            'type' => 'currency',
            'vname' => 'LBL_AMOUNT',
            'currency_format' => true,
            'width' => '10%',
            'default' => true,
        ),
        'percent' =>
        array (
            'type' => 'decimal',
            'vname' => 'LBL_PERCENT',
            'width' => '10%',
            'default' => true,
        ),
        'total_down' =>
        array (
            'type' => 'currency',
            'vname' => 'LBL_DISCOUNT_SPONSOR_DOWN',
            'currency_format' => true,
            'width' => '10%',
            'default' => true,
        ),
        'date_entered' =>
        array (
            'type' => 'datetime',
            'studio' =>
            array (
                'portaleditview' => false,
            ),
            'vname' => 'LBL_DATE_ENTERED',
            'width' => '3%',
            'default' => true,
        ),
    ),
);

?>