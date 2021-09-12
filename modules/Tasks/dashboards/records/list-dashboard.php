<?php



return array(
    'metadata' =>
    array(
        'components' =>
        array(
            array(
                'rows' =>
                array(
                    array(
                        array(
                            'view' =>
                            array(
                                'type' => 'dashablelist',
                                'label' => 'TPL_DASHLET_MY_MODULE',
                                'display_columns' =>
                                array(
                                    'full_name',
                                    'email',
                                    'phone_work',
                                    'status',
                                ),
                            ),
                            'context' =>
                            array(
                                'module' => 'Leads',
                            ),
                            'width' => 12,
                        ),
                    ),
                    array(
                        array(
                            'view' =>
                            array(
                                'type' => 'dashablelist',
                                'label' => 'TPL_DASHLET_MY_MODULE',
                                'display_columns' =>
                                array(
                                    'bug_number',
                                    'name',
                                    'status',
                                ),
                            ),
                            'context' =>
                            array(
                                'module' => 'Bugs',
                            ),
                            'width' => 12,
                        ),
                    ),
                ),
                'width' => 12,
            ),
        ),
    ),
    'name' => 'LBL_TASKS_LIST_DASHBOARD',
);

