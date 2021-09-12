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


$viewdefs['Meetings']['base']['view']['rtDotbBoards'] = array(

    'groupBy' => array(
        'status',
        'type',
        'repeat_type',
        'assigned_user_name',
    ),

	'titleField' => 'name',

	'basicFields' => array(
        array(
            'name' => 'date_start',
            'icon' => 'fa-clock-o',
			'type' => 'date',
        ),
		array (
			'name' => array('duration_hours', 'duration_minutes'),
			'prefix' => '(',
			'postfix' => ')',
			'duration_hours_postfix' => 'h ',
			'duration_minutes_postfix' => 'm ',
		),
	),

    'secondaryFields' => array(
        'location',
        'repeat_type'
    ),

    'activityButtons' => array(
    	array(
    		'name' => 'Notes',
    		'icon' => 'fa-file-text',
    	),
    ),

    'colorLabelField' => array(
        'field' => 'status',
        'colorList' => 'meeting_status_colors_dom'
    ),
);
