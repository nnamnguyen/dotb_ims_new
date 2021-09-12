<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
$hook_version = 1;
$hook_array = Array();
// position, file, function

$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(0, 'create balance', 'custom/modules/Products/logicProducts.php','logicProducts', 'createBalances');

$hook_array['before_delete'] = Array();
$hook_array['before_delete'][] = Array(0, 'delete balance', 'custom/modules/Products/logicProducts.php','logicProducts', 'deleteBalances');

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(0, 'add discount', 'custom/modules/Products/logicProducts.php','logicProducts', 'addDiscount');

$hook_array['after_retrieve'] = Array();
$hook_array['after_retrieve'][] = Array(0, 'after retrieve', 'custom/modules/Products/logicProducts.php','logicProducts', 'afterRetrieve');

$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(0, 'after retrieve', 'custom/modules/Products/logicProducts.php','logicProducts', 'getProductDiscount');
?>