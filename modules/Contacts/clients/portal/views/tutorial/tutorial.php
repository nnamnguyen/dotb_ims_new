<?php
//FILE DOTBCRM flav=ent

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs['Contacts']['portal']['view']['tutorial'] = array(
    'record' => array( //Record layout is used for the Portal profile
        'version' => 1,
        'intro' => 'LBL_PORTAL_TOUR_PROFILE_INTRO',
        'content' => array(
            array(
                'name' => '.btn-primary[name="edit_button"]',
                'text' => 'LBL_PORTAL_TOUR_PROFILE_EDIT',
                'full' => true,
            ),
            array(
                'name' => '.record-label[data-name="preferred_language"]',
                'text' => 'LBL_PORTAL_TOUR_PROFILE_LANGUAGE',
                'full' => true,
            ),
            array(
                'name' => 'li#userActions',
                'text' => 'LBL_PORTAL_TOUR_PROFILE_RETURN',
                'full' => true,
            ),
        )
    ),
);
