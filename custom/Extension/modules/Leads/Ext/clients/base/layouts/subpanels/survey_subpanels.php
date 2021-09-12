<?php

/**
 * The file used to store Relationship Definition 
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
//$viewdefs['Leads']['base']['layout']['subpanels']['components'][] = array(
//    'layout' => 'subpanel',
//    'label' => 'LBL_BC_SURVEY_SUBMISSION_LEADS_FROM_BC_SURVEY_SUBMISSION_TITLE',
//    'context' =>
//    array(
//        'link' => 'bc_survey_submission_leads',
//    ),
//);
$viewdefs['Leads']['base']['layout']['subpanels']['components'][] = array(
    'layout' => 'subpanel',
    'label' => 'LBL_BC_SURVEY_SUBMISSION_LEADS_TARGET_FROM_BC_SURVEY_SUBMISSION_TITLE',
    'context' =>
    array(
        'link' => 'bc_survey_submission_leads_target',
    ),
);