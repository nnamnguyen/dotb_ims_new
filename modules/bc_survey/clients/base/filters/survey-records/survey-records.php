<?php

/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */
$viewdefs['bc_survey']['base']['filter']['survey-records'] = array(
    'create' => true,
    'filters' => array(
        array(
            'id' => 'survey-records',
            'name' => 'LBL_SURVEY_RECORDS',
            'filter_definition' => array(
                array(
                    'survey_type' => array(
                        '$not_equals' => 'poll',
                    ),
                ),
            ),
            'editable' => false,
        ),
    ),
);
