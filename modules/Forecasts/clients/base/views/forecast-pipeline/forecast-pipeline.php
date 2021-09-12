<?php


$viewdefs['Forecasts']['base']['view']['forecast-pipeline'] = array(
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
                    'options' => 'forecast_pipeline_visibility_options',
                    'enum_width' => 'auto',
                ),
            ),
        ),
    ),
    'timeperiod' => array(
        array(
            'name' => 'selectedTimePeriod',
            'label' => 'TimePeriod',
            'type' => 'timeperiod',
        ),
    )
);
