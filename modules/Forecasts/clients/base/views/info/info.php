<?php


$viewdefs['Forecasts']['base']['view']['info'] = array(
    'timeperiod' => array(
        array(
            'name' => 'selectedTimePeriod',
            'label' => 'LBL_TIMEPERIOD_NAME',
            'type' => 'timeperiod',
            'css_class' => 'forecastsTimeperiod',
            'dropdown_class' => 'topline-timeperiod-dropdown',
            'dropdown_width' => 'auto',
            'view' => 'edit',
            // options are set dynamically in the view
            'default' => true,
            'enabled' => true,
        ),
    ),
    'last_commit' => array(
        array(
            'name' => 'lastCommitDate',
            'type' => 'lastcommit',
            'datapoints' => array(
                'worst_case',
                'likely_case',
                'best_case'
            )
        )
    ),
    'commitlog' => array(
        array(
            'name' => 'commitLog',
            'type' => 'commitlog',
        )
    ),
    'datapoints' => array(
        array(
            'name' => 'quota',
            'label' => 'LBL_QUOTA',
            'type' => 'quotapoint'
        ),
        array(
            'name' => 'worst_case',
            'label' => 'LBL_WORST',
            'type' => 'datapoint'
        ),
        array(
            'name' => 'likely_case',
            'label' => 'LBL_LIKELY',
            'type' => 'datapoint'
        ),
        array(
            'name' => 'best_case',
            'label' => 'LBL_BEST',
            'type' => 'datapoint'
        )
    ),
);
