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


$viewdefs['ProspectLists']['base']['view']['rtDotbBoards'] = array(

	'groupBy' => array(
		'assigned_user_name',
	),

	'titleField' => 'name',

	'basicFields' => array(
		array(
			'name' => 'list_type',
		),
	),

    'secondaryFields' => array(
        'entry_count',
        'description',
    ),

    'activityButtons' => array(
    	array(
    		'name' => 'Prospects',
    		'icon' => 'fa-bullseye',
    	),
    ),

    'colorLabelField' => array(

    ),
);
