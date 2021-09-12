<?php

$viewdefs['Emails']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'state' => array(
            'vname' => 'LBL_LIST_STATUS',
        ),
        'date_sent' => array(
            'vname' => 'LBL_LIST_DATE_COLUMN',
        ),
        'assigned_user_name' => array(),
        'parent_name' => array(),
        'tag' => array(),
        'mailbox_name' => array(),
        'total_attachments' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
    ),
);
