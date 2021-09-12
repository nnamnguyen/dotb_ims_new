<?php



$subpanel_layout = array(
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
        array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'PdfManager'),
    ),

    'where' => '',

    'list_fields' => array(
        'name'=>array(
             'vname' => 'LBL_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
             'width' => '45%',
        ),
        'date_modified'=>array(
             'vname' => 'LBL_DATE_MODIFIED',
             'width' => '45%',
        ),
        'edit_button'=>array(
            'widget_class' => 'SubPanelEditButton',
             'module' => 'PdfManager',
             'width' => '4%',
        ),
        'remove_button'=>array(
            'widget_class' => 'SubPanelRemoveButton',
             'module' => 'PdfManager',
            'width' => '5%',
        ),
    ),
);
