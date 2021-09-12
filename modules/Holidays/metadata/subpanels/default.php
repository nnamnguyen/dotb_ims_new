<?php


$subpanel_layout = array(
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
    ),

    'where' => '',

    'list_fields' => array(
        'holiday_date'=>array(
            'vname' => 'LBL_HOLIDAY_DATE',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '21%',
        ),
        'type'=>array(
            'vname' => 'LBL_TYPE',
            'width' => '15%',             
        ),        
        'description'=>array(
            'vname' => 'LBL_DESCRIPTION',
            'width' => '50%',
            'sortable'=>false,				
        ),
        'remove_button'=>array(
            'widget_class' => 'SubPanelRemoveButton',
            'width' => '2%',
        ),    


    ),
);
?>