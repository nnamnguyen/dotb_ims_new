<?php
$hook_version = 1;
$hook_array = Array();
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, '', 'custom/modules/Calls/logicHandle.php','logicHandle', 'handleAfterSave');
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, '', 'custom/modules/Calls/logicHandle.php','logicHandle', 'handleBeforeSave');
$hook_array['after_retrieve'] = Array();
$hook_array['after_retrieve'][] = Array(1, '', 'custom/modules/Calls/logicHandle.php','logicHandle', 'handleAfterRetrieve');
