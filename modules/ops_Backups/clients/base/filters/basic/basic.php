<?php
 if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');
/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 */

$viewdefs['ops_Backups']['base']['filter']['basic'] = array(
    'create'               => true,
    'quicksearch_field'    => array('name'),
    'quicksearch_priority' => 1,
    'quicksearch_split_terms' => false,
    'filters'              => array(
        array(
            'id'                => 'all_records',
            'name'              => 'LBL_LISTVIEW_FILTER_ALL',
            'filter_definition' => array(),
            'editable'          => false
        ),
        array(
            'id'                => 'recently_viewed',
            'name'              => 'LBL_RECENTLY_VIEWED',
            'filter_definition' => array(
                '$tracker' => '-7 DAY',
            ),
            'editable'          => false
        ),
        array(
            'id'                => 'recently_created',
            'name'              => 'LBL_NEW_RECORDS',
            'filter_definition' => array(
                'date_entered' => array(
                    '$dateRange' => 'last_7_days',
                ),
            ),
            'editable'          => false
        ),
    ),
);
