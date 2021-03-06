<?php


$viewdefs['base']['view']['forecast-pareto'] = array(
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
                    'Home',
                    'Opportunities',
                    'RevenueLineItems'
                ),
                'view' => array(
                    'record'
                )
            )
        )
    ),
    'panels' => array(
        array(
            'name' => 'panel_body',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'visibility',
                    'label' => 'LBL_DASHLET_CONFIGURE_MY_ITEMS_ONLY',
                    'type' => 'enum',
                    'options' => 'forecast_pareto_visibility_options',
                    'enum_width' => 'auto',
                ),
            ),
        ),
    ),
    'chart' => array(
        'name' => 'paretoChart',
        'label' => 'Pareto Chart',
        'type' => 'forecast-pareto-chart',
        'view' => 'detail'
    ),
    'timeperiod' => array(
        array(
            'module' => 'Forecasts',
            'name' => 'selectedTimePeriod',
            'label' => 'TimePeriod',
            'type' => 'timeperiod',
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
