<?php

$subpanel_layout = array(
    'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
        array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'KBContents'),
    ),
    'where' => '',
    'list_fields' => array(
        'name' => array(
            'vname' => 'LBL_NAME',
            'widget_class' => 'SubPanelDetailViewLink',
            'width' => '35%',
            'default' => true,
        ),
        'language' => array(
            'vname' => 'LBL_LANG',
            'width' => '5%',
            'default' => true,
        ),
        'revision' => array(
            'vname' => 'LBL_DOCUMENT_REVISION',
            'width' => '5%',
            'default' => true,
        ),
        'active_rev' => array(
            'vname' => 'LBL_ACTIVE_REV',
            'width' => '5%',
            'default' => true,
        ),
        'date_entered' => array(
            'name' => 'date_entered',
            'vname' => 'LBL_DATE_ENTERED',
            'width' => '23%',
        ),
        'date_modified' => array(
            'name' => 'date_modified',
            'vname' => 'LBL_DATE_MODIFIED',
            'width' => '23%',
        ),
        'remove_button' => array (
            'vname' => 'LBL_REMOVE',
            'widget_class' => 'SubPanelRemoveButton',
            'width' => '4%',
            'default' => true,
        ),
    )
);
