<?php


$viewdefs['Notifications']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',

    'filters' => array(
        array(
            'id' => 'read',
            'name' => 'LBL_READ',
            'filter_definition' => array(
                array(
                    'is_read' => array('$equals' => 1),
                ),
            ),
            'editable' => false,
        ),
        array(
            'id' => 'unread',
            'name' => 'LBL_UNREAD',
            'filter_definition' => array(
                array(
                    'is_read' => array('$equals' => 0),
                ),
            ),
            'editable' => false,
        ),
    ),
);
