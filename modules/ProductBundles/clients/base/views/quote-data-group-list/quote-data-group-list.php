<?php

$viewdefs['ProductBundles']['base']['view']['quote-data-group-list'] = array(
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'type' => 'rowaction',
                'name' => 'edit_row_button',
                'label' => 'LBL_EDIT_BUTTON',
                'tooltip' => 'LBL_EDIT_BUTTON',
                'acl_action' => 'edit',
            ),
            array(
                'type' => 'rowaction',
                'name' => 'delete_row_button',
                'label' => 'LBL_DELETE_BUTTON',
                'tooltip' => 'LBL_DELETE_BUTTON',
                'acl_action' => 'delete',
            ),
        ),
    ),
);
