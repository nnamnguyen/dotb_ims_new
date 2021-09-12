<?php

/**
 * The file used to store definition for relationship 
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$dictionary["bc_survey"]["fields"]["bc_survey_submission_bc_survey"] = array(
    'name' => 'bc_survey_submission_bc_survey',
    'type' => 'link',
    'relationship' => 'bc_survey_submission_bc_survey',
    'source' => 'non-db',
    'module' => 'bc_survey_submission',
    'bean_name' => false,
    'side' => 'right',
    'vname' => 'LBL_BC_SURVEY_SUBMISSION_BC_SURVEY_FROM_BC_SURVEY_SUBMISSION_TITLE',
);