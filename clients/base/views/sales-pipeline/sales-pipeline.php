<?php


$viewdefs['base']['view']['sales-pipeline'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_SALES_PIPELINE_CHART_NAME',
            'description' => 'LBL_DASHLET_SALES_PIPELINE_CHART_DESC',
            'config' => array(
            ),
            'filter' => array(
                'module' => array(
                    'Home',
                    'Accounts',
                    'Opportunities',
                    'RevenueLineItems'
                ),
                'view' => array(
                    'record',
                    'records'
                )
            )
        ),
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
