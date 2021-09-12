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


$viewdefs['Tasks']['base']['view']['rtDotbBoards'] = array(

    'groupBy' => array(
        'status',
        'priority',
        'assigned_user_name',
    ),

	'titleField' => 'name',

	'basicFields' => array(
        array(
            'name' => 'date_start',
            'icon' => 'fa-clock-o',
			'type' => 'date',
        ),
	),

    'secondaryFields' => array(
        'status',
        'description',
        'date_due'
    ),

    'activityButtons' => array(
    	array(
    		'name' => 'Notes',
    		'icon' => 'fa-file-text',
    	),
    ),

    'colorLabelField' => array(
        'field' => 'priority',
        'colorList' => 'task_priority_colors_dom'
    ),
);
