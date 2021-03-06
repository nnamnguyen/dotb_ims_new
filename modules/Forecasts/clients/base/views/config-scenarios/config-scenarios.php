<?php

$viewdefs['Forecasts']['base']['view']['config-scenarios'] = array(
    'label' => 'LBL_FORECASTS_CONFIG_BREADCRUMB_SCENARIOS',
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'show_worksheet_likely',
                    'type' => 'bool',
                    'label' => 'LBL_FORECASTS_CONFIG_WORKSHEET_SCENARIOS_LIKELY',
                    'default' => false,
                    'enabled' => true,
                    'view' => 'detail',
                ),
                array(
                    'name' => 'show_worksheet_best',
                    'type' => 'bool',
                    'label' => 'LBL_FORECASTS_CONFIG_WORKSHEET_SCENARIOS_BEST',
                    'default' => false,
                    'enabled' => true,
                    'view' => 'forecastsWorksheet',
                ),
                array(
                    'name' => 'show_worksheet_worst',
                    'type' => 'bool',
                    'label' => 'LBL_FORECASTS_CONFIG_WORKSHEET_SCENARIOS_WORST',
                    'default' => false,
                    'enabled' => true,
                    'view' => 'forecastsWorksheet',
                ),
            ),
        ),
        //TODO-sfa - this will be revisited in a future sprint and determined whether it should go in 6.7, 6.8 or later
    ),
);
