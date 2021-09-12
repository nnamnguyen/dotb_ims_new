<?php

$viewdefs['base']['view']['search-list'] = array(
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'preview-button',
                'css_class' => 'btn',
                'tooltip' => 'LBL_PREVIEW',
                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),
        ),
    ),
    'panels' => array(
        array(
            'name' => 'primary',
            'fields' => array(
                array(
                    'name' => 'picture',
                    'type' => 'avatar',
                    'size' => 'medium',
                    'readonly' => true,
                    'css_class' => 'pull-left',
                ),
                array(
                    'name' => 'name',
                    'type' => 'name',
                    'link' => true,
                    'label' => 'LBL_SUBJECT',
                ),
            ),
        ),
        array(
            'name' => 'secondary',
            'fields' => array(
            ),
        ),
    ),
);

