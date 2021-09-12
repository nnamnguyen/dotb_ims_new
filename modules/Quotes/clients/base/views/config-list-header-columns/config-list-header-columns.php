<?php

$viewdefs['Quotes']['base']['view']['config-list-header-columns'] = array(
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'group_button',
                'type' => 'rowaction',
                'label' => 'LBL_CREATE_GROUP_SELECTED_BUTTON_LABEL',
                'tooltip' => 'LBL_CREATE_GROUP_SELECTED_BUTTON_TOOLTIP',
            ),
            array(
                'name' => 'massdelete_button',
                'type' => 'rowaction',
                'label' => 'LBL_DELETE_SELECTED_LABEL',
                'tooltip' => 'LBL_DELETE_SELECTED_TOOLTIP',
            ),
        ),
    ),
);
