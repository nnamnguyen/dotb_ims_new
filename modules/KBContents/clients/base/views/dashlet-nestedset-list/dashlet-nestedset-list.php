<?php

$viewdefs['KBContents']['base']['view']['dashlet-nestedset-list'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_CATEGORIES_NAME',
            'description' => 'LBL_DASHLET_CATEGORIES_DESCRIPTION',
            'config' => array(
                'last_state' => array(
                    'id' => 'dashlet-nestedset-list-kbcontents',
                ),
                'data_provider' => 'Categories',
                'config_provider' => 'KBContents',
                'root_name' => 'category_root',
                'extra_provider' => array(
                    'module' => 'KBContents',
                    'field' => 'category_id',
                ),
            ),
            'preview' => array(
                'data_provider' => 'Categories',
                'config_provider' => 'KBContents',
                'root_name' => 'category_root',
            ),
            'filter' => array(
                'module' => array(
                    'KBContents',
                    'KBContentTemplates',
                ),
                'view' => array(
                    'record',
                    'records',
                ),
            ),
        ),
    ),
    'config' => array (
    ),
);
