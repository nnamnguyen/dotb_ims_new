<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
 $hook_version = 1;
$hook_array = Array();
// position, file, function
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(0, 'Add Auto-Increment Code', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'addCode');
//$hook_array['before_save'][] = Array(1, 'workflow', 'include/workflow/WorkFlowHandler.php','WorkFlowHandler', 'WorkFlowHandler');
//$hook_array['before_save'][] = Array(2, 'Handle before save', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'handleBeforeSave');
$hook_array['before_save'][] = Array(3, 'Import Payment', 'custom/modules/J_Payment/logicImport.php','logicImport', 'importPayment');
//$hook_array['before_save'][] = Array(4, 'Created relationship Product', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'createdRelationshipBookGift');

$hook_array['after_save'] = Array();
//$hook_array['after_save'][] = Array(1, 'Handle After save', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'afterSavePayment');
$hook_array['process_record'] = Array();
//$hook_array['process_record'][] = Array(1, 'Color', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'listViewColorPayment');
$hook_array['process_record'][] = Array(2, 'Get balance relate', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'getBalanceRelate');
$hook_array['before_delete'] = Array();
$hook_array['before_delete'][] = Array(2, 'Delete Payment', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'deletedPayment');
//$hook_array['before_delete'][] = Array(10, 'Delete Notification', 'custom/modules/C_News/logicNews.php', 'logicNews', 'deleteMobileNotification');

$hook_array['after_delete'] = Array();
$hook_array['after_delete'][] = Array(1, 'Delete Payment', 'custom/modules/J_Payment/logicPayment.php','logicPayment', 'after_delete_payment');
?>