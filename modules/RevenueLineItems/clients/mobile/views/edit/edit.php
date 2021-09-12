<?php


/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$viewdefs['RevenueLineItems']['mobile']['view']['edit'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'name',
                    'required' => true,
                ),
                array(
                    'name' => 'opportunity_name',
                    'required' => true,
                ),
                array(
                    'name' => 'account_name',
                    'readonly' => true,
                ),
                array(
                    'name' => 'date_closed',
                    'required' => true,
                ),
                array(
                    'name' => 'likely_case',
                    'required' => true,
                ),
                'best_case',
                'worst_case',
                'sales_stage',
                'probability',
                'product_template_name',
                'quantity',
                'discount_amount',
                array(
                    'name' => 'quote_name',
                    'readonly' => true,
                ),
                'assigned_user_name',
                'team_name',
            ),
        ),
    ),
);
