<?php

$viewdefs['base']['view']['pii'] = array(
    'template' => 'pii',
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'type' => 'piiname',
                    'name' => 'field_name',
                    'label' => 'LBL_DATAPRIVACY_FIELDNAME',
                    'sortable' => true,
                    'filter' => 'contains',
                ),
                array(
                    'type' => 'base',
                    'name' => 'value',
                    'label' => 'LBL_DATAPRIVACY_VALUE',
                    'sortable' => true,
                    'filter' => 'contains',
                ),
                array(
                    'type' => 'source',
                    'name' => 'source',
                    'label' => 'LBL_DATAPRIVACY_SOURCE',
                    'sortable' => false,
                ),
                array(
                    'type' => 'datetimecombo',
                    'name' => 'date_modified',
                    'label' => 'LBL_DATAPRIVACY_CHANGE_DATE',
                    'sortable' => false,
                ),
            ),
        ),
    ),
);
