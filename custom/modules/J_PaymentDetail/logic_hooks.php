<?php
    $hook_version = 1;
    $hook_array = Array();
    // position, file, function

    $hook_array['process_record'] = Array();
    $hook_array['process_record'][] = Array(1, 'Add button export', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'displayButton');

    $hook_array['before_save'] = Array();
    $hook_array['before_save'][] = Array(2, 'Handle before save', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'handleBeforeSave');
    $hook_array['before_save'][] = Array(2, 'Handle before save', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'addPaymentAmount');
    $hook_array['before_save'][] = Array(3, 'Change quotes', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'changeQuote');
    $hook_array['before_save'][] = Array(4, 'create balance', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'createBalance');

    $hook_array['after_save'] = Array();
//    $hook_array['after_save'][] = Array(1, 'Handle After save', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'handleAfterSave');
    $hook_array['after_save'][] = Array(3, 'update quotes', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'updateQuote');

    $hook_array['before_delete'] = Array();
    $hook_array['before_delete'][] = Array(2, 'Delete Payment', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'deletedPaymentDetail');
    $hook_array['before_delete'][] = Array(3, 'delete paymnet detail', 'custom/modules/J_PaymentDetail/logicPaymentDetail.php','DisplayButtonLogicHook', 'afterDeletePaymentDetail');
    ?>
