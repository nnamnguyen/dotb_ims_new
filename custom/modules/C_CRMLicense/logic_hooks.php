<?php
$hook_version = 1;
$hook_array = Array();


$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, '', 'custom/modules/C_CRMLicense/logicCRMLicense.php', 'logicCRMLicense', 'handleBeforeSave');

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, '', 'custom/modules/C_CRMLicense/logicCRMLicense.php', 'logicCRMLicense', 'handleAfterSave');

$hook_array['after_delete'] = Array();
$hook_array['after_delete'][] = Array(1, '', 'custom/modules/C_CRMLicense/logicCRMLicense.php', 'logicCRMLicense', 'handleAfterDelete');

$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(1, '', 'custom/modules/C_CRMLicense/logicCRMLicense.php','logicCRMLicense', 'handleProcessRecord');
