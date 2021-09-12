<?php


$viewdefs['Opportunities']['EditView'] = array(
    'templateMeta' => array('maxColumns' => '2',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
            array('label' => '10', 'field' => '30')
        ),
        'javascript' => '{$PROBABILITY_SCRIPT}',
    ),
    'panels' =>array (
        'default' =>
        array (

            array (
                array('name'=>'name'),
                'account_name',
            ),
            array (
                'opportunity_type',
                'lead_source',
            ),
            array (
                'campaign_name',
                'next_step',
            ),
            array (
                'description',
            ),
        ),

        'LBL_PANEL_ASSIGNMENT' => array(
            array(
                'assigned_user_name',

                array('name'=>'team_name'),
            ),
        ),
    )
);
