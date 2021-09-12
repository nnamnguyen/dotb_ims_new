<?php



$viewdefs['Calls']['base']['layout']['record-dashboard'] = array(
    'metadata' => array(
        'components' => array(
            array(
                'rows' => array(
                    array(
                        array(
                            'view' => array(
                                'type' => 'dashablelist',
                                'label' => 'LBL_MY_SCHEDULED_CALLS',
                                'display_columns' => array(
                                    'date_start',
                                    'name',
                                    'parent_name',
                                ),
                                'filter_id' => 'my_scheduled_calls',
                            ),
                            'context' => array(
                                'module' => 'Calls',
                            ),
                            'width' => 12,
                        ),
                    ),
                ),
                'width' => 12,
            ),
        ),
    ),
    'name' => 'LBL_CALLS_RECORD_DASHBOARD',
);
