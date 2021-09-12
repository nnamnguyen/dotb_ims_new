<?php

$viewdefs['Bugs']['base']['layout']['list-dashboard'] = array(
    'metadata' => array(
        'components' => array(
            array(
                'rows' => array(
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
    'name' => 'LBL_BUGS_LIST_DASHBOARD',
);
