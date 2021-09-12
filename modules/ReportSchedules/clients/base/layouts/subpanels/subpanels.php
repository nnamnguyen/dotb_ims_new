<?php

$viewdefs['ReportSchedules']['base']['layout']['subpanels'] = array (
    'components' => array(
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_USERS_SUBPANEL_TITLE',
            'override_subpanel_list_view' => 'subpanel-for-reportschedules',
            'override_paneltop_view' => 'panel-top-for-reportschedules',
            'context' => array(
                'link' => 'users',
            ),
        ),
    ),
);
