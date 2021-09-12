<?php

$viewdefs['Cases']['portal']['view']['tutorial'] = array(
    'records' => array(
        'version' => 1,
        'intro' => 'LBL_PORTAL_TOUR_RECORDS_INTRO',
        'content' => array(
            array(
                'text' => 'LBL_PORTAL_TOUR_RECORDS_PAGE',
            ),
            array(
                'name' => '.dataTables_filter',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_FILTER',
                'full' => true,
            ),
            array(
                'name' => '.dataTables_filter',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_FILTER_EXAMPLE',
                'full' => true,
            ),
            array(
                'name' => '.btn-primary[name="create_button"]',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_CREATE',
                'full' => true,
            ),
            array(
                'name' => '[data-route="#Cases"]',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_RETURN',
                'full' => true,
            ),
        )
    ),
);
