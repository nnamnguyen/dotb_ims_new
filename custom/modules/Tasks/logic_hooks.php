<?php
$hook_version = 1;
$hook_array = Array();
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, '', 'custom/modules/Tasks/logicTask.php','logicHandle', 'handleAfterSave');