<?php
// created: 2020-04-15 17:03:36
$dictionary["C_Comments"]["fields"]["cases_c_comments_1"] = array (
  'name' => 'cases_c_comments_1',
  'type' => 'link',
  'relationship' => 'cases_c_comments_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'side' => 'right',
  'vname' => 'LBL_CASES_C_COMMENTS_1_FROM_C_COMMENTS_TITLE',
  'id_name' => 'cases_c_comments_1cases_ida',
  'link-type' => 'one',
);
$dictionary["C_Comments"]["fields"]["cases_c_comments_1_name"] = array (
  'name' => 'cases_c_comments_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_C_COMMENTS_1_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'cases_c_comments_1cases_ida',
  'link' => 'cases_c_comments_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["C_Comments"]["fields"]["cases_c_comments_1cases_ida"] = array (
  'name' => 'cases_c_comments_1cases_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_C_COMMENTS_1_FROM_C_COMMENTS_TITLE_ID',
  'id_name' => 'cases_c_comments_1cases_ida',
  'link' => 'cases_c_comments_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
