<?php

/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */


$viewdefs['Leads']['base']['view']['rtDotbBoards'] = array(

	'groupBy' => array(
		'status',
		'lead_source',
		'assigned_user_name',
	),

    'successFailureStage' => array(
        'status' => array(
            'success' => 'Converted',
            'failure' => 'Dead',
        ),
    ),

	'titleField' => 'full_name',

	'basicFields' => array(
        array(
            'name' => 'phone_work',
            'icon' => 'fa-phone',
        ),
	),

    'secondaryFields' => array(
        'title',
        'account_name',
		'description'
    ),

    'activityButtons' => array(
    	array(
    		'name' => 'Calls',
    		'icon' => 'fa-phone',
    	),
    	array(
    		'name' => 'Emails',
    		'icon' => 'fa-envelope',
    	),
    	array(
    		'name' => 'Meetings',
    		'icon' => 'fa-calendar',
    	),
    	array(
    		'name' => 'Tasks',
    		'icon' => 'fa-tasks',
    	),
        array(
            'name' => 'Notes',
            'icon' => 'fa-file-text',
        ),
    ),

    'colorLabelField' => array(
        'field' => 'lead_source',
        'colorList' => 'lead_source_colors_dom'
    ),
);
