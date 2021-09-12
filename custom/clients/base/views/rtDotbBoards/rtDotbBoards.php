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


$viewdefs['base']['view']['rtDotbBoards'] = array(

	'groupBy' => array(
		'assigned_user_name'
	),

    'successFailureStage' => array(

    ),
    
	'titleField' => 'name',

	'basicFields' => array(

	),

    'secondaryFields' => array(

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
    		'icon' => 'fa-users',
    	),
    	array(
    		'name' => 'Tasks',
    		'icon' => 'fa-Calendar',
    	),
    ),

    'colorLabelField' => array(

    ),

);