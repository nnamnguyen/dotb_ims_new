<?php

$viewdefs['Opportunities']['base']['view']['config-opps-view-by'] = array(
    'label' => 'LBL_OPPS_CONFIG_VIEW_BY_LABEL',
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'opps_view_by',
                    'type' => 'radioenum',
                    'view' => 'edit',
                    'default' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'opps_closedate_rollup',
                    'type' => 'radioenum',
                    'label' => 'LBL_OPPS_CONFIG_VIEW_BY_DATE_ROLLUP',
                    'view' => 'edit',
                    'options' => 'opps_config_view_by_closedate_rollup_dom',
                    'default' => false,
                    'enabled' => true,
                )
            )
        )
    )
);
