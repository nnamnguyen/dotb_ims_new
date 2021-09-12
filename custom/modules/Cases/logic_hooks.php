<?php
$hook_version = 1;
$hook_array = Array();
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, '', 'custom/modules/Cases/logicCase.php','logicCase', 'handleBeforeSave');

$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(1, '', 'custom/modules/Cases/logicCase.php','logicCase', 'handleStatusColor');
$hook_array['process_record'][] = Array(2, '', 'custom/modules/Cases/logicCase.php','logicCase', 'handleLastCmtTime');