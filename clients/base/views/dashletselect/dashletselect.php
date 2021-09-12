<?php


$viewdefs['base']['view']['dashletselect'] = array(
    'template' => 'filtered-list',
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'label' => 'LBL_DASHLET_CONFIGURE_TITLE',
                    'name' => 'title',
                    'type' => 'text',
                    'link' => true,
                    'events' => array(
                        'click a' => 'dashletlist:select-and-edit',
                    ),
                    'filter' => 'startsWith',
                    'sortable' => true,
                ),
                array(
                    'label' => 'LBL_DESCRIPTION',
                    'name' => 'description',
                    'type' => 'text',
                    'filter' => 'contains',
                    'sortable' => true,
                ),
                array(
                    'type' => 'rowaction',
                    'tooltip' => 'LBL_PREVIEW',
                    'event' => 'dashletlist:preview:fire',
                    'css_class' => 'btn',
                    'icon' => 'fa-search-plus',
                    'width' => '7%',
                    'sortable' => false,
                ),
            ),
        ),
    ),
);
