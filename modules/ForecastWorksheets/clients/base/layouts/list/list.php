<?php



$viewdefs['ForecastWorksheets']['base']['layout']['list'] = array(
    'components' => array(
        array(
            'view' => 'filter',
        ),
        array(
            'view' => 'recordlist',
            'primary' => true,
        ),
    ),
);
