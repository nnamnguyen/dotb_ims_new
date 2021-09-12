<?php



$viewdefs['base']['view']['notifications'] = array(
    // currently we don't support different filters per module
    // (Calls and Meetings) because this is temporary code.
    'remindersFilterDef' => array(
        'reminder_time' => array(
            '$gte' => 0,
        ),
        'status' => array(
            '$equals' => 'Planned',
        ),
        'accept_status_users' => array(
            '$not_equals' => 'decline',
        ),
    ),
    'remindersLimit' => 100,
    'fields' => array(
        'severity' => array(
            'name' => 'severity',
            'type' => 'severity',
        ),
    ),
);
