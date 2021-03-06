<?php

$viewdefs['base']['view']['audit'] = array(
    'template' => 'audit',
    'panels' =>
    array(
        array(
            'fields' => array(
                array(
                    'type' => 'fieldtype',
                    'name' => 'field_name',
                    'label' => 'LBL_FIELD_NAME',
                    'sortable' => true,
                    'filter' => 'startsWith',
                ),
                array(
                    'type' => 'base',
                    'name' => 'before',
                    'label' => 'LBL_OLD_NAME',
                    'sortable' => false,
                    'filter' => 'contains',
                ),
                array(
                    'type' => 'base',
                    'name' => 'after',
                    'label' => 'LBL_NEW_VALUE',
                    'sortable' => false,
                    'filter' => 'contains',
                ),
                array(
                    'type' => 'base',
                    'name' => 'created_by_username',
                    'label' => 'LBL_CREATED_BY',
                    'sortable' => true,
                    ),
                array(
                    'type' => 'source',
                    'name' => 'source',
                    'label' => 'LBL_SOURCE_FIELD',
                    'sortable' => false,
                ),
                array(
                    'type' => 'datetimecombo',
                    'name' => 'date_created',
                    'label' => 'LBL_LIST_DATE',
                    'options' => 'date_range_search_dom',
                    'sortable' => true,
                ),
            ),
        ),
    ),
);
