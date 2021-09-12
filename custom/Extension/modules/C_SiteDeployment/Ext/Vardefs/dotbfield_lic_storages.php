<?php
 // created: 2020-05-11 14:37:56
$dictionary['C_SiteDeployment']['fields']['lic_storages']['len']='11';
$dictionary['C_SiteDeployment']['fields']['lic_storages']['audited']=false;
$dictionary['C_SiteDeployment']['fields']['lic_storages']['massupdate']=false;
$dictionary['C_SiteDeployment']['fields']['lic_storages']['importable']='false';
$dictionary['C_SiteDeployment']['fields']['lic_storages']['duplicate_merge']='disabled';
$dictionary['C_SiteDeployment']['fields']['lic_storages']['duplicate_merge_dom_value']=0;
$dictionary['C_SiteDeployment']['fields']['lic_storages']['merge_filter']='disabled';
$dictionary['C_SiteDeployment']['fields']['lic_storages']['unified_search']=false;
$dictionary['C_SiteDeployment']['fields']['lic_storages']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['C_SiteDeployment']['fields']['lic_storages']['calculated']='true';
$dictionary['C_SiteDeployment']['fields']['lic_storages']['formula']='ifElse(equal($lic_type,"Cloud Standard"),"5",ifElse(equal($lic_type,"Cloud Pro"),"10",ifElse(equal($lic_type,"On-Premise"),"9999","")))';
$dictionary['C_SiteDeployment']['fields']['lic_storages']['enforced']=true;

 ?>