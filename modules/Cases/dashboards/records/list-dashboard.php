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
                                'label' => 'TPL_DASHLET_MY_MODULE',
                                'display_columns' => array(
                                    'bug_number',
                                    'name',
                                    'status',
                                ),
                            ),
                            'context' => array(
                                'module' => 'Bugs',
                            ),
                            'width' => 12,
                        ),
                    ),
                    array(
                        array(
                            'view' => array(
                                'type' => 'twitter',
                                'label' => 'LBL_TWITTER_NAME',
                                'twitter' => 'dotbcrm',
                                'limit' => '5',
                            ),
                            'context' => array(
                                'module' => 'Home',
                            ),
                            'width' => 12,
                        ),
                    ),
                ),
                'width' => 12,
            ),
        ),
    ),
    'name' => 'LBL_CASES_LIST_DASHBOARD',
);
