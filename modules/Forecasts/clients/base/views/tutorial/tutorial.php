<?php


/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs['Forecasts']['base']['view']['tutorial'] = array(
    'records' => array(
        'intro' =>'LBL_TOUR_FORECAST_INTRO',
        'version' =>1,
        'content' => array(
            array(
                'name' => '.topline [for="date_filter"]',
                'text' => 'LBL_TOUR_FORECASTS_TIMEPERIODS',
                'full' => true,
                'horizAdj'=> -15,
                'vertAdj'=> -15,
            ),
            array(
                'name' => '.topline .last-commit',
                'text' => 'LBL_TOUR_FORECASTS_COMMITS',
                'full' => true,
                'horizAdj'=> -20,
                'vertAdj'=> -20,
            ),
            array(
                'name' => '.editableColumn',
                'text' => 'LBL_TOUR_FORECASTS_INLINEEDIT',
                'full' => true,
            ),
            array(
                'name' => '.dashlets .forecast-details',
                'text' => 'LBL_TOUR_FORECASTS_PROGRESS',
                'full' => true,
                'horizAdj'=> -1,
                'vertAdj'=> -5,
            ),
            array(
                'name' => '.dashlets .forecasts-chart-wrapper',
                'text' => 'LBL_TOUR_FORECASTS_CHART',
                'full' => true,
                'horizAdj'=> -1,
                'vertAdj'=> -5,
            ),
        )
    ),
);
