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
                                'type' => 'forecastdetails-record',
                                'label' => 'LBL_DASHLET_FORECAST_NAME',
                            ),
                            'context' =>
                            array(
                                'module' => 'Forecasts',
                            ),
                            'width' => 12,
                        ),
                    ),
                    array(
                        array(
                            'view' =>
                            array(
                                'type' => 'forecast-pareto',
                                'label' => 'LBL_DASHLET_FORECASTS_CHART_NAME',
                            ),
                            'context' =>
                            array(
                                'module' => 'Forecasts',
                            ),
                            'width' => 12,
                        ),
                    ),
                    array(
                        array(
                            'view' =>
                                array(
                                    'name' => 'active-tasks',
                                    'label' => 'LBL_ACTIVE_TASKS_DASHLET',
                                ),
                            'width' => 12,
                        ),
                    ),
                ),
                'width' => 12,
            ),
        ),
    ),
    'name' => 'LBL_REVENUE_LINE_ITEMS_RECORD_DASHBOARD',
);
