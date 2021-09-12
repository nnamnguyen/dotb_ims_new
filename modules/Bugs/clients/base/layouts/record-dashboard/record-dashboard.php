<?php



$viewdefs['Bugs']['base']['layout']['record-dashboard'] = array(
    'metadata' =>
        array(
            'components' =>
                array(
                    array(
                        'rows' =>
                            array(
                                array(
                                    array(
                                        'view' => array(
                                            'type' => 'planned-activities',
                                            'label' => 'LBL_PLANNED_ACTIVITIES_DASHLET',
                                        ),
                                        'width' => 12,
                                    ),
                                ),
                                array(
                                    array(
                                        'view' => array(
                                            'type' => 'history',
                                            'label' => 'LBL_HISTORY_DASHLET',
                                        ),
                                        'width' => 12,
                                    ),
                                ),
                            ),
                        'width' => 12,
                    ),
                ),
        ),
    'name' => 'LBL_BUGS_RECORD_DASHBOARD',
);
