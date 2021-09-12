<?php
// created: 2020-04-15 03:31:01
$dictionary["Case"]["fields"]["cases_cases_1"] = array (
  'name' => 'cases_cases_1',
  'type' => 'link',
  'relationship' => 'cases_cases_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_CASES_CASES_1_FROM_CASES_L_TITLE',
  'id_name' => 'cases_cases_1cases_idb',
  'link-type' => 'many',
  'side' => 'left',
);
$dictionary["Case"]["fields"]["cases_cases_1_right"] = array (
  'name' => 'cases_cases_1_right',
  'type' => 'link',
  'relationship' => 'cases_cases_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'side' => 'right',
  'vname' => 'LBL_CASES_CASES_1_FROM_CASES_R_TITLE',
  'id_name' => 'cases_cases_1cases_ida',
  'link-type' => 'one',
);
$dictionary["Case"]["fields"]["cases_cases_1_name"] = array (
  'name' => 'cases_cases_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_CASES_1_FROM_CASES_L_TITLE',
  'save' => true,
  'id_name' => 'cases_cases_1cases_ida',
  'link' => 'cases_cases_1_right',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["cases_cases_1cases_ida"] = array (
  'name' => 'cases_cases_1cases_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_CASES_1_FROM_CASES_R_TITLE_ID',
  'id_name' => 'cases_cases_1cases_ida',
  'link' => 'cases_cases_1_right',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
