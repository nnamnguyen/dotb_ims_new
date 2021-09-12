<?php


$subpanel_layout = array(
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
        array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'ProjectTask'),
    ),
    'where' => '',
    'list_fields' => array(
        'name' => array(
            'vname' => 'LBL_LIST_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '20%',
        ),
        'percent_complete' => array(
            'vname' => 'LBL_LIST_PERCENT_COMPLETE',
            'width' => '20%',
        ),
        'status' => array(
            'vname' => 'LBL_LIST_STATUS',
            'width' => '20%',
        ),
        'assigned_user_name' => array(
            'vname' => 'LBL_ASSIGNED_TO_NAME',
            'module' => 'Users',
            'width' => '20%',
        ),
        'date_finish' => array(
            'vname' => 'LBL_LIST_DATE_DUE',
            'width' => '20%',
        ),
    ),
);
