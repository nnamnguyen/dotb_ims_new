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
                                'type' => 'forecastdetails',
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
                                'type' => 'forecasts-chart',
                                'label' => 'LBL_DASHLET_FORECASTS_CHART_NAME',
                            ),
                            'context' =>
                            array(
                                'module' => 'Forecasts',
                            ),
                            'width' => 12,
                        ),
                    ),
                ),
                'width' => 12,
            ),
        ),
    ),
    'name' => 'LBL_FORECASTS_DASHBOARD',
);

