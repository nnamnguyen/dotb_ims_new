<?php
//FILE DOTBCRM flav=ent

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs['portal']['view']['tutorial'] = array(
    'record' => array(
        'version' => 1,
        'content' => array(
            array(
                'text' => 'LBL_PORTAL_TOUR_RECORD_DETAILS',
                'full' => true,
            ),
            array(
                'name' => '.block h4',
                'text' => 'LBL_PORTAL_TOUR_RECORD_NOTES',
                'full' => true,
            ),
            array(
                'name' => 'a.addNote',
                'text' => 'LBL_PORTAL_TOUR_RECORD_ADD_NOTE',
                'full' => true,
            ),
            array(
                'name' => 'i.fa-eye',
                'text' => 'LBL_PORTAL_TOUR_RECORD_VIEW_NOTE',
                'full' => true,
            ),
        )
    ),
    'dashboard' => array(
        'version' =>1,
        'intro' => 'LBL_PORTAL_TOUR_RECORDS_INTRO',
        'content' => array(
            array(
                'text' => 'LBL_PORTAL_TOUR_RECORDS_PAGE',
            ),
            array(
                'name' => '[data-route="#Cases"]',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_CASES',
                'full' => true,
            ),
            array(
                'name' => '[data-route="#Bugs"]',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_BUGS',
                'full' => true,
            ),
            array(
                'name' => 'input.search-query',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_GLOBAL_SEARCH',
                'full' => true,
            ),
            array(
                'name' => 'li#userActions',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_USER',
                'full' => true,
            ),
            array(
                'name' => 'li#createList',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_QUICK_CREATE',
                'full' => true,
            ),
            array(
                'name' => '.dataTables_filter',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_SEARCH',
                'full' => true,
            ),
            array(
                'name' => '[href=#Home]',
                'text' => 'LBL_PORTAL_TOUR_RECORDS_RETURN',
                'full' => true,
            ),
        )
    ),
);
