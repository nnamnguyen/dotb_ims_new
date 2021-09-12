<?php

$viewdefs['Forecasts']['base']['view']['config-forecast-by'] = array(
    'label' => 'LBL_FORECASTS_CONFIG_BREADCRUMB_WORKSHEET_LAYOUT',
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' =>'forecast_by',
                    'type' => 'radioenum',
                    'label' => '',
                    'view' => 'edit',
                    'options' => 'forecasts_config_worksheet_layout_forecast_by_options_dom',
                    'default' => false,
                    'enabled' => true,
                ),
            ),
        ),
    ),
);
