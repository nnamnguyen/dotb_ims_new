<?php

$viewdefs['ProductCategories']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'parent_name',
                    'enabled' => true,
                    'default' => true,
                    'related_fields' => array(
                        'parent_id'
                    ),
                    'id' => 'parent_id',
                    'label' => 'LBL_PARENT_CATEGORY',
                ),
                array(
                    'name' => 'description',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'list_order',
                    'enabled' => true,
                    'default' => true,
                ),
            )
        )
    )
);
