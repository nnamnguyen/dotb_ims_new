<?php
    // created: 2020-05-17 13:14:13
    $viewdefs['C_Comments']['base']['view']['subpanel-for-cases-cases_c_comments_1'] = array (
        'panels' =>
        array (
            0 =>
            array (
                'name' => 'panel_header',
                'label' => 'LBL_PANEL_1',
                'fields' =>
                array (
                    0 =>
                    array (
                        'name' => 'description',
                        'label' => 'LBL_DESCRIPTION',
                        'enabled' => true,
                        'sortable' => false,
                        'default' => true,
                        'width' => 'xlarge',
                        'type' => 'html',
                    ),
                    1 =>
                    array (
                        'name' => 'uploadfile',
                        'label' => 'LBL_FILE_UPLOAD',
                        'enabled' => true,
                        'default' => true,
                        'sortable' => false,
                        'width' => 'small',
                    ),
                    2 =>
                    array (
                        'name' => 'direction',
                        'label' => 'LBL_DIRECTION',
                        'enabled' => true,
                        'default' => false,
                    ),
                    3 =>
                    array (
                        'name' => 'created_by_name',
                        'label' => 'LBL_CREATED',
                        'enabled' => true,
                        'readonly' => true,
                        'sortable' => false,
                        'id' => 'CREATED_BY',
                        'link' => true,
                        'default' => false,
                    ),
                    4 =>
                    array (
                        'name' => 'date_entered',
                        'label' => 'LBL_DATE_ENTERED',
                        'enabled' => true,
                        'readonly' => true,
                        'sortable' => true,
                        'default' => false,
                    ),
                ),
            ),
        ),
        'rowactions' =>
        array (
            'actions' =>
            array (
                0 =>
                array (
                    'type' => 'rowaction',
                    'css_class' => 'btn',
                    'tooltip' => 'LBL_EDIT_BUTTON',
                    'event' => 'list:editrow:fire',
                    'icon' => 'fa-pencil',
                    'acl_action' => 'edit',
                ),
                1 =>
                array(
                    'type' => 'rowaction',
                    'css_class' => 'btn',
                    'icon' => 'fa-trash-alt',
                    'tooltip' => 'LBL_DELETE_BUTTON',
                    'event' => 'list:deleterow:fire',
                    'acl_action' => 'delete',
                ),
            ),
        ),
        'type' => 'subpanel-list',
);