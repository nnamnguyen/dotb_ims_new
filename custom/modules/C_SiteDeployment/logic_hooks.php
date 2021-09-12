<?php
$hook_version = 1;
$hook_array = Array();
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, '', 'custom/modules/C_SiteDeployment/logicSiteDeployment.php','logicSiteDeployment', 'handleAfterSave');
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, '', 'custom/modules/C_SiteDeployment/logicSiteDeployment.php','logicSiteDeployment', 'handleBeforeSave');

$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(1, 'Color', 'custom/modules/C_SiteDeployment/logicSiteDeployment.php','logicSiteDeployment', 'listViewColor');