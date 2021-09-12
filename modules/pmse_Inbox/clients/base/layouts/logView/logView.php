<?php


$viewdefs['pmse_Inbox']['base']['layout']['logView'] = array(
    'components' => array(
        array(
            'layout' => array(
                'components' => array(
                    array(
                        'view' => 'logView-headerpane',
                        'primary' => true,
                    ),
                    array(
                        'layout' => array(
                            'components' => array(
                                array(
                                    'view' => 'logView-pane',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        array(
            'layout' => array(
                'components' => array(
                    array(
                        'layout' => 'sidebar',
                    ),
                ),
            ),
        ),
    ),
);
