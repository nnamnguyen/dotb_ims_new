<?php

$viewdefs['CampaignLog']['base']['view']['subpanel-list'] = array(
    'favorite' => false,
    'selection' => array(),
    'rowactions' => array(),
    'panels' =>
    array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' =>
            array(
                array(
                    'label' => 'LBL_LIST_CAMPAIGN_NAME',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'campaign_name1',
                ),
                array(
                    'label' => 'LBL_ACTIVITY_TYPE',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'activity_type',
                ),
                array(
                    'label' => 'LBL_ACTIVITY_DATE',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'activity_date',
                ),
                array(
                    'label' => 'LBL_RELATED',
                    'enabled' => true,
                    'default' => true,
                    'name' => 'related_name',
                    'type' => 'parent',
                    'related_fields' => array(
                        'related_id',
                        'related_type',
                    ),
                ),
            ),
        ),
    ),
);
