<?php



$viewdefs['Forecasts']['base']['layout']['preview'] = array(
    'components' => array(
        array(
            'view' => array(
                'type' => 'preview-header',
            ),
        ),
        array(
            'view' => array(
                'type' => 'preview',
            ),
        ),
        array(
            'layout' => array(
                'type' => 'preview-activitystream',
            ),
            'context' => array(
                'module' => 'Forecasts',
                'forceNew' => true,
            ),
        ),
    ),
);
