<?php
$hook_version = 1;
$hook_array = array();
$hook_array['process_record'] = array();
$hook_array['process_record'][] = array(1, '', 'custom/modules/C_ParentAppLicense/logicC_ParentAppLicense.php', 'logicC_ParentAppLicense', 'handleProcessRecords');

$hook_array['before_save'] = array();
$hook_array['before_save'][] = array(1, '', 'custom/modules/C_ParentAppLicense/logicC_ParentAppLicense.php', 'logicC_ParentAppLicense', 'handleBeforeSave');
