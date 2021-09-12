<?php
// created: 2020-04-23 14:11:33
$dictionary["C_SiteDeployment"]["fields"]["quotes_c_sitedeployment_1"] = array (
  'name' => 'quotes_c_sitedeployment_1',
  'type' => 'link',
  'relationship' => 'quotes_c_sitedeployment_1',
  'source' => 'non-db',
  'module' => 'Quotes',
  'bean_name' => 'Quote',
  'side' => 'right',
  'vname' => 'LBL_QUOTES_C_SITEDEPLOYMENT_1_FROM_C_SITEDEPLOYMENT_TITLE',
  'id_name' => 'quotes_c_sitedeployment_1quotes_ida',
  'link-type' => 'one',
);
$dictionary["C_SiteDeployment"]["fields"]["quotes_c_sitedeployment_1_name"] = array (
  'name' => 'quotes_c_sitedeployment_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_QUOTES_C_SITEDEPLOYMENT_1_FROM_QUOTES_TITLE',
  'save' => true,
  'id_name' => 'quotes_c_sitedeployment_1quotes_ida',
  'link' => 'quotes_c_sitedeployment_1',
  'table' => 'quotes',
  'module' => 'Quotes',
  'rname' => 'name',
);
$dictionary["C_SiteDeployment"]["fields"]["quotes_c_sitedeployment_1quotes_ida"] = array (
  'name' => 'quotes_c_sitedeployment_1quotes_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_QUOTES_C_SITEDEPLOYMENT_1_FROM_C_SITEDEPLOYMENT_TITLE_ID',
  'id_name' => 'quotes_c_sitedeployment_1quotes_ida',
  'link' => 'quotes_c_sitedeployment_1',
  'table' => 'quotes',
  'module' => 'Quotes',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
