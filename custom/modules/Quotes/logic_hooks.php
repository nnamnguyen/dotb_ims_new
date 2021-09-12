<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
$hook_version = 1;
$hook_array = Array();
// position, file, function


$hook_array['before_delete'] = Array();
$hook_array['before_delete'][] = Array(1, 'delete quote', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'beforeDeleteQuotes');

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(0, 'Add Auto-Increment Code', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'addCode');
$hook_array['before_save'][] = Array(1, 'Change unpaid', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'beforeSaveQuotes');
$hook_array['before_save'][] = Array(2, 'Use sponsor, discount, loyalty', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'handleDiscount');

$hook_array['after_retrieve'] = Array();
$hook_array['after_retrieve'][] = Array(1, 'current text', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'currentText');

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(0, 'Change lead status', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'changeLeadStatus');
$hook_array['after_save'][] = Array(1, 'use balance', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'useBalance');
$hook_array['after_save'][] = Array(2, 'add sponsor loyalty', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'addSponsorLoyalty');
//$hook_array['after_save'][] = Array(2, 'create receipt', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'createReceipt');
$hook_array['after_save'][] = Array(1, 'create balance', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'createBalance');

$hook_array['after_relationship_add'] = Array();
$hook_array['after_relationship_add'][] = Array(1, 'create balance', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'createBalance');
$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(1, 'Get balance relate', 'custom/modules/Quotes/logicQuotes.php','logicQuotes', 'getBalanceRelate');

?>