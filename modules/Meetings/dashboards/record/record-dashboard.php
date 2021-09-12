<?php



return array(
    'metadata' => array(
        'components' => array(
            array(
                'rows' => array(
                    array(
                        array(
                            'view' => array(
                                'type' => 'dashablelist',
                                'label' => 'LBL_MY_SCHEDULED_MEETINGS',
                                'display_columns' => array(
                                    'date_start',
                                    'name',
                                    'parent_name',
                                ),
                                'filter_id' => 'my_scheduled_meetings',
                            ),
                            'context' => array(
                                'module' => 'Meetings',
                            ),
                            'width' => 12,
                        ),
                    ),
                ),
                'width' => 12,
            ),
        ),
    ),
    'name' => 'LBL_MEETINGS_RECORD_DASHBOARD',
);

