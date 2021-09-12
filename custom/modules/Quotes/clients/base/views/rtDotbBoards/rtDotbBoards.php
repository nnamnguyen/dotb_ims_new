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


$viewdefs['Quotes']['base']['view']['rtDotbBoards'] = array(

	'groupBy' => array(
        'payment_terms',
        'quote_stage',
        'assigned_user_name',
	),

    'columnSummary' => array(
        'field' => 'total',
        'currency' => 'yes',
    ),

    'successFailureStage' => array(
        'quote_stage' => array(
            'success' => 'Closed Accepted',
            'failure' => 'Closed Lost',
        ),
    ),

	'titleField' => 'name',

	'basicFields' => array(
        array(
            'name' => 'total',
						'currency' => 'yes',
        ),
	),

    'secondaryFields' => array(
        'billing_account_name',
        'date_quote_expected_closed',
        'purchase_order_num'
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

    ),
);
