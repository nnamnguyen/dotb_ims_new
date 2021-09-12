<?php
$hook_version = 1;
$hook_array = Array();


$hook_array['after_save'] = Array();
//$hook_array['before_save'][] = Array(10, 'Create Notification', 'custom/modules/Notifications/LogicHook/Notification.php', 'LogicHook_Notification', 'createNotification');
$hook_array['after_save'][] = Array(1, 'Create Notification & Handle Save', 'custom/modules/C_Comments/logicComment.php', 'logicComment', 'handleAfterSave');


$hook_array['before_delete'] = Array();
$hook_array['before_delete'][] = Array(10, 'delete Notification', 'custom/modules/Notifications/LogicHook/Notification.php', 'LogicHook_Notification', 'deleteNotification');


$hook_array['after_retrieve'] = Array();
$hook_array['after_retrieve'][] = Array(10, 'update Read Notification', 'custom/modules/Notifications/LogicHook/Notification.php', 'LogicHook_Notification', 'updateNotification');



$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(1, 'Handle Comment Box', 'custom/modules/C_Comments/logicComment.php','logicComment', 'handleCommentBox');