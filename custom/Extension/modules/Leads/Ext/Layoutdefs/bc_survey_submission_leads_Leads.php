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

$layout_defs["Leads"]["subpanel_setup"]['bc_survey_submission_leads'] = array (
  'order' => 100,
  'module' => 'bc_survey_submission',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_BC_SURVEY_SUBMISSION_LEADS_FROM_BC_SURVEY_SUBMISSION_TITLE',
  'get_subpanel_data' => 'bc_survey_submission_leads',
  'top_buttons' => array (),
);

$layout_defs["Leads"]["subpanel_setup"]['bc_survey_submission_leads_target'] = array (
  'order' => 100,
  'module' => 'bc_survey_submission',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_BC_SURVEY_SUBMISSION_LEADS_TARGET_FROM_BC_SURVEY_SUBMISSION_TITLE',
  'get_subpanel_data' => 'bc_survey_submission_leads_target',
  'top_buttons' => array (),
);