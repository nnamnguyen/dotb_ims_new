<?php
// created: 2020-09-25 12:13:44
$dictionary["C_CRMLicense"]["fields"]["c_sitedeployment_c_crmlicense_1"] = array (
  'name' => 'c_sitedeployment_c_crmlicense_1',
  'type' => 'link',
  'relationship' => 'c_sitedeployment_c_crmlicense_1',
  'source' => 'non-db',
  'module' => 'C_SiteDeployment',
  'bean_name' => 'C_SiteDeployment',
  'side' => 'right',
  'vname' => 'LBL_C_SITEDEPLOYMENT_C_CRMLICENSE_1_FROM_C_CRMLICENSE_TITLE',
  'id_name' => 'c_sitedeployment_c_crmlicense_1c_sitedeployment_ida',
  'link-type' => 'one',
);
$dictionary["C_CRMLicense"]["fields"]["c_sitedeployment_c_crmlicense_1_name"] = array (
  'name' => 'c_sitedeployment_c_crmlicense_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_C_SITEDEPLOYMENT_C_CRMLICENSE_1_FROM_C_SITEDEPLOYMENT_TITLE',
  'save' => true,
  'id_name' => 'c_sitedeployment_c_crmlicense_1c_sitedeployment_ida',
  'link' => 'c_sitedeployment_c_crmlicense_1',
  'table' => 'c_sitedeployment',
  'module' => 'C_SiteDeployment',
  'rname' => 'name',
);
$dictionary["C_CRMLicense"]["fields"]["c_sitedeployment_c_crmlicense_1c_sitedeployment_ida"] = array (
  'name' => 'c_sitedeployment_c_crmlicense_1c_sitedeployment_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_C_SITEDEPLOYMENT_C_CRMLICENSE_1_FROM_C_CRMLICENSE_TITLE_ID',
  'id_name' => 'c_sitedeployment_c_crmlicense_1c_sitedeployment_ida',
  'link' => 'c_sitedeployment_c_crmlicense_1',
  'table' => 'c_sitedeployment',
  'module' => 'C_SiteDeployment',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
