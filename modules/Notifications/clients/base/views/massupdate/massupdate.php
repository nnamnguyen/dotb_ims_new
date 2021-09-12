<?php



$viewdefs['Notifications']['base']['view']['massupdate'] = array(
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'is_read',
                    'type' => 'enum',
                    'options' => 'notifications_status_dom',
                ),
            ),
        ),
    ),
);
