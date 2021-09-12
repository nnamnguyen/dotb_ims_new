<?php

$viewdefs['Quotes']['base']['view']['quote-data-list-header'] = array(
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'group_button',
                'type' => 'rowaction',
                'label' => 'LBL_CREATE_GROUP_SELECTED_BUTTON_LABEL',
                'tooltip' => 'LBL_CREATE_GROUP_SELECTED_BUTTON_TOOLTIP',
                'acl_action' => 'edit',
            ),
            array(
                'name' => 'massdelete_button',
                'type' => 'rowaction',
                'label' => 'LBL_DELETE_SELECTED_LABEL',
                'tooltip' => 'LBL_DELETE_SELECTED_TOOLTIP',
                'acl_action' => 'delete',
            ),
        ),
    ),
);
