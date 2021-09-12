<?php

$viewdefs['Forecasts']['base']['view']['forecasts-chart'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_FORECASTS_CHART_NAME',
            'description' => 'LBL_DASHLET_FORECASTS_CHART_DESC',
            'config' => array(
                'module' => 'Forecasts'
            ),
            'preview' => array(),
            'filter' => array(
                'module' => array(
                    'Forecasts'
                )
            )
        )
    ),
    'chart' => array(
        'name' => 'paretoChart',
        'label' => 'Pareto Chart',
        'type' => 'forecast-pareto-chart',
    ),
    'timeperiod' => array(
        array(
            'name' => 'selectedTimePeriod',
            'label' => 'TimePeriod',
            'type' => 'enum',
            'default' => true,
            'enabled' => true,
            'view' => 'edit',
        ),
    ),
    'group_by' => array(
        'name' => 'group_by',
        'label' => 'LBL_DASHLET_FORECASTS_GROUPBY',
        'type' => 'enum',
        'searchBarThreshold' => 5,
        'default' => true,
        'enabled' => true,
        'view' => 'edit',
        'options' => 'forecasts_chart_options_group'
    ),
    'dataset' => array(
        'name' => 'dataset',
        'label' => 'LBL_DASHLET_FORECASTS_DATASET',
        'type' => 'enum',
        'searchBarThreshold' => 5,
        'default' => true,
        'enabled' => true,
        'view' => 'edit',
        'options' => 'forecasts_options_dataset'
    )
);
