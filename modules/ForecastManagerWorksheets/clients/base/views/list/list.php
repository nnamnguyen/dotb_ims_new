<?php

$viewdefs['ForecastManagerWorksheets']['base']['view']['list'] = array(
    'css_class' => 'forecast-manager-worksheet',
    'panels' =>
    array(
        0 =>
        array(
            'label' => 'LBL_PANEL_1',
            'fields' =>
            array(
                array(
                    'name' => 'name',
                    'type' => 'userLink',
                    'label' => 'LBL_NAME',
                    'link' => true,
                    'route' =>
                    array(
                        'recordID' => 'user_id'
                    ),
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'related_fields' => array(
                        'user_id',
                        'is_manager',
                        'show_history_log',
                        'draft',
                        'pipeline_opp_count',
                        'pipeline_amount',
                        'closed_amount',
                        'opp_count',
                        'timeperiod_id'
                    )
                ),
                array(
                    'name' => 'quota',
                    'type' => 'currency',
                    'label' => 'LBL_QUOTA_ADJUSTED',
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'convertToBase' => true,
                    'skip_preferred_conversion' => true,
                    'related_fields' => array(
                        'base_rate',
                        'currency_id'
                    ),
                    'align' => 'right',
                    'click_to_edit' => true,
                ),
                array(
                    'name' => 'worst_case',
                    'type' => 'currency',
                    'label' => 'LBL_WORST',
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'convertToBase' => true,
                    'skip_preferred_conversion' => true,
                    'related_fields' => array(
                        'base_rate',
                        'currency_id'
                    ),
                    'align' => 'right'
                ),
                array(
                    'name' => 'worst_case_adjusted',
                    'type' => 'currency',
                    'label' => 'LBL_WORST_ADJUSTED',
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'convertToBase' => true,
                    'skip_preferred_conversion' => true,
                    'related_fields' => array(
                        'base_rate',
                        'currency_id'
                    ),
                    'align' => 'right',
                    'click_to_edit' => true,
                ),
                array(
                    'name' => 'likely_case',
                    'type' => 'currency',
                    'label' => 'LBL_LIKELY',
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'convertToBase' => true,
                    'skip_preferred_conversion' => true,
                    'related_fields' => array(
                        'base_rate',
                        'currency_id'
                    ),
                    'align' => 'right'
                ),
                array(
                    'name' => 'likely_case_adjusted',
                    'type' => 'currency',
                    'label' => 'LBL_LIKELY_ADJUSTED',
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'convertToBase' => true,
                    'skip_preferred_conversion' => true,
                    'related_fields' => array(
                        'base_rate',
                        'currency_id'
                    ),
                    'align' => 'right',
                    'click_to_edit' => true,
                ),
                array(
                    'name' => 'best_case',
                    'type' => 'currency',
                    'label' => 'LBL_BEST',
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'convertToBase' => true,
                    'skip_preferred_conversion' => true,
                    'related_fields' => array(
                        'base_rate',
                        'currency_id'
                    ),
                    'align' => 'right'
                ),
                array(
                    'name' => 'best_case_adjusted',
                    'type' => 'currency',
                    'label' => 'LBL_BEST_ADJUSTED',
                    'sortable' => true,
                    'default' => true,
                    'enabled' => true,
                    'convertToBase' => true,
                    'skip_preferred_conversion' => true,
                    'related_fields' => array(
                        'base_rate',
                        'currency_id'
                    ),
                    'align' => 'right',
                    'click_to_edit' => true,
                )
            ),
        ),
    ),
);
