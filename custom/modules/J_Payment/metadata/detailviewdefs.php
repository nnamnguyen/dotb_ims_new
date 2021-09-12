<?php
$module_name = 'J_Payment';
$viewdefs[$module_name] =
array (
    'DetailView' =>
    array (
        'templateMeta' =>
        array (
            'form' =>
            array (
                'buttons' =>
                array (
                    0 => 'EDIT',
                    1 =>
                    array (
                        'customCode' => '{$CUSTOM_DELETE}',
                    ),
                    2 =>
                        array (
                            'customCode' => '{$BUTTON_COPY}',
                        ),
                    3 =>
                    array (
                        'customCode' => '{$EXPORT_FROM_BUTTON} {$CUSTOM_BUTTON}',
                    ),
                    4 =>
                    array (
                        'customCode' => '{$BTN_UNDO}',
                    ),
                ),
                'hidden' =>
                array (
                    0 => '{include file="custom/modules/J_Payment/tpl/paymentTemplate.tpl"}',
                    1 => '{include file="custom/modules/J_Payment/tpl/delayPayment.tpl"}',
                    2 => '{include file="custom/modules/J_Payment/tpl/convert_payment.tpl"}',
                    3 => '<input type="hidden" name="is_corporate" id="is_corporate" value="{$fields.is_corporate.value}">',
                    4 => '<input type="hidden" name="payment_type" id="payment_type" value="{$fields.payment_type.value}">',
                    5 => '<input type="hidden" name="team_id" id="team_id" value="{$fields.team_id.value}">',
                    6 => '<input type="hidden" name="status" id="status" value="{$fields.status.value}">',
                    7 => '<input type="hidden" name="is_paid" id="is_paid" value="{$is_paid}">',
                    8 => '<input type="hidden" name="end_study" id="end_study" value="{$fields.end_study.value}">',
                    9 => '{include file="custom/modules/J_Payment/tpl/export_invoice.tpl"}',
                ),
            ),
            'maxColumns' => '3',
            'widths' =>
            array (
                0 =>
                array (
                    'label' => '10',
                    'field' => '20',
                ),
                1 =>
                array (
                    'label' => '10',
                    'field' => '20',
                ),
                2 =>
                array (
                    'label' => '10',
                    'field' => '20',
                ),
            ),
            //'javascript' => '
            //            <link rel="stylesheet" type="text/css" href="{dotb_getjspath file=\'custom/include/javascript/Bootstrap/bootstrap.min.css\'}">
            //            ',
            'useTabs' => false,
            'tabDefs' =>
            array (
                'LBL_ENROLLMENT' =>
                array (
                    'newTab' => false,
                    'panelDefault' => 'expanded',
                ),
                'LBL_PLACE_HOLDER' =>
                array (
                    'newTab' => false,
                    'panelDefault' => 'expanded',
                ),
                'LBL_PAYMENT_PT_BOOK' =>
                array (
                    'newTab' => false,
                    'panelDefault' => 'expanded',
                ),
                'LBL_OTHER' =>
                array (
                    'newTab' => false,
                    'panelDefault' => 'expanded',
                ),
            ),
            'syncDetailEditViews' => true,
            'includes' =>
            array (
                0 =>
                array (
                    'file' => 'custom/modules/J_Payment/js/detaill_view.js',
                ),
            ),
        ),
        'panels' =>
        array (
            //Payment Enrollment
            'LBL_ENROLLMENT' =>
            array (
                0 => array (
                    0 => array(
                        'name'=>'name',
                        'customCode' => '{$payment_id}',
                    ),
                    1 => array (
                        'name' => 'status',
                        'customCode' => '<b>{$fields.status.value}</b>',
                    ),
                    2 =>
                    array (
                        'name' => 'sale_type',
                        'customCode' => '{$sale_typeQ}',
                    ),
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 => array (
                        'name' => 'payment_type',
                    ),
                    2 =>
                    array (
                        'name' => 'sale_type_date',
                        'customCode' => '{$sale_type_dateQ}',
                    ),
                ),
                2 => array (
                    0 => array (
                        'label' => 'LBL_CLASSES_NAME',
                        'customCode' => '{$html_class}'
                    ),
                    1 =>
                    array (
                        'name' => 'kind_of_course_string',
                    ),
                    2 => array (
                        'name' => 'payment_date',
                    ),

                ),
                3 => array (
                    0 => array (
                        'name' => 'start_study',
                        'label' => 'LBL_START_STUDY',
                    ),
                    1 => array (
                        'name' => 'level_string',
                    ),
                    2 => array (
                        'hideLabel' => 'true',
                    ),

                ),
                4 => array (
                    0 => array (
                        'name' => 'end_study',
                        'label' => 'LBL_END_STUDY',
                    ),
                    1 => 'sessions',
                    2 => array (
                        'hideLabel' => 'true',
                    ),
                ),
                5 => array (
                    0 => array (
                        'name' => 'tuition_fee',
                        'label' => 'LBL_TUITION_FEE',
                    ),
                    1 => 'tuition_hours',
                    2 => array (
                        'name' => 'j_coursefee_j_payment_1_name',
                        'customCode' => '{$j_coursefee}'
                    ),

                ),
                7 => array (
                    0 => array (
                        'name' => 'paid_amount',
                        'customLabel' => '{$MOD.LBL_PAID_AMOUNT}:
                        <img border="0" onclick="return DOTB.util.showHelpTips(this,\'{$MOD.LBL_PAID_AMOUNT_HELP}\');" src="themes/RacerX/images/helpInline.png" alt="paidAmountHelpTip" class="paidAmountHelpTip">',
                    ),
                    1 => array (
                        'name' => 'paid_hours',
                        'label' => 'LBL_PAID_HOURS',
                    ),
                    2 => array (
                        'hideLabel' => 'true',
                    ),

                ),
                8 => array (
                    0 => 'amount_bef_discount',
                    1 => array (
                        'name' => 'total_hours',
                        'label' => 'LBL_TOTAL_HOURS',
                    ),
                    2 => array (
                        'hideLabel' => 'true',
                    ),
                ),
                9 => array (
                    0 => 'discount_amount',
                    1 => 'discount_percent',
                    2 =>
                    array (
                        'name' => 'payment_expired',
                        'customCode' => '{$payment_expiredQ}',
                    ),
                ),
                10 => array (
                    0 => 'final_sponsor',
                    1 => 'final_sponsor_percent',
                    2 => 'is_installment'
                ),
                11 => array (
                    0 => 'loyalty_amount',
                    1 => 'loyalty_percent',
                    2 => 'installment_plan'
                ),
                13 => array (
                    0 => array (
                        'name' => 'total_after_discount',
                    ),
                    1 => array (
                        'name' => 'deposit_amount',
                        'customLabel' => '{$MOD.LBL_DEPOSIT_AMOUNT}:
                        <img border="0" onclick="return DOTB.util.showHelpTips(this,\'{$MOD.LBL_DEPOSIT_AMOUNT_HELP}\');" src="themes/RacerX/images/helpInline.png" alt="paidAmountHelpTip" class="paidAmountHelpTip">',
                    ),

                    2 => 'account_name'
                ),
                14 => array (
                    0 => 'payment_amount',
                    1 => array(
                        'label' => 'LBL_PAID_AMOUNT_2',
                        'customCode' => '{$PAID_AMOUNT}',
                    ),
                    2 => array(
                        'customLabel' => '{$MOD.LBL_UNPAID_AMOUNT}:<img border="0" onclick="return DOTB.util.showHelpTips(this,\'{$MOD.LBL_PAYMENT_WARNING}\');" src="themes/RacerX/images/helpInline.png">',
                        'customCode' => '{$UNPAID_AMOUNT}',
                    ),
                ),
            ),
            //Payment Place Holder
            'LBL_PLACE_HOLDER' =>
            array (
                0 => array (
                    0 => array(
                        'name'=>'name',
                        'customCode' => '{$payment_id}',
                    ),
                    1 => array (
                        'name' => 'status',
                        'customCode' => '<b>{$fields.status.value}</b>',
                    ),
                    2 =>
                    array (
                        'name' => 'sale_type',
                        'customCode' => '{$sale_typeQ}',
                    ),
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 => array (
                        'name' => 'payment_type',
                    ),
                    2 =>
                    array (
                        'name' => 'sale_type_date',
                        'customCode' => '{$sale_type_dateQ}',
                    ),
                ),
                2 => array (
                    0 => 'amount_bef_discount',
                    1 => array (
                        'name' => 'tuition_hours',
                        'customLabel' => '{$MOD.LBL_TUITION_HOURS}:',
                    ),
                    2 => array (
                        'name' => 'j_coursefee_j_payment_1_name',
                        'customCode' => '{$j_coursefee}'
                    ),
                ),

                3 => array (
                    0 => 'discount_amount',
                    1 => 'discount_percent',
                    2 => 'payment_date',


                ),
                4 => array (
                    0 => 'final_sponsor',
                    1 => 'final_sponsor_percent',
                    2 =>
                    array(
                        'name' => 'payment_expired',
                        'customCode'   => '{$payment_expiredQ}',
                    )

                ),
                5 => array (
                    0 => 'loyalty_amount',
                    1 => 'loyalty_percent',
                    2 => array(
                        'name' => 'kind_of_course_string',
                    )
                ),
                6 => array (
                    0 => array (
                        'name' => 'total_after_discount',
                    ),
                    1 =>
array (
                        'name'=> 'duration_exp',
                        'label'   => 'LBL_DURATION_EXP',
                    ),
                    2 => 'use_type'
                ),
                7 => array (
                    0 => array (
                        'name' => 'deposit_amount',
                        'customLabel' => '{$MOD.LBL_DEPOSIT_AMOUNT}:
                        <img border="0" onclick="return DOTB.util.showHelpTips(this,\'{$MOD.LBL_DEPOSIT_AMOUNT_HELP}\');" src="themes/RacerX/images/helpInline.png" alt="paidAmountHelpTip" class="paidAmountHelpTip">',
                    ),
                    1 => array (
                        'hideLabel' => 'true',
                    ),
                    2 =>  array (
                        'hideLabel' => 'true',
                    ),
                ),
                8 => array (
                    0 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_PAYMENT_AMOUNT}:',
                        'name'          => 'payment_amount',
                    ),
                    1 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_TOTAL_HOURS}:',
                        'name'          => 'total_hours',
                    ),
                    2 => 'installment_plan'

                ),
                9 => array (
                    0 => 'remain_amount',
                    1 =>
                    array (
                        'name'          => 'remain_hours',
                    ),
                    2 => 'is_installment'
                ),

                10 => array (
                    0 => array(
                        'label' => 'LBL_PAID_AMOUNT_2',
                        'customCode' => '{$PAID_AMOUNT}',
                    ),
                    1 => array(
                        'customLabel' => '{$MOD.LBL_UNPAID_AMOUNT}:<img border="0" onclick="return DOTB.util.showHelpTips(this,\'{$MOD.LBL_PAYMENT_WARNING}\');" src="themes/RacerX/images/helpInline.png">',
                        'customCode' => '{$UNPAID_AMOUNT}',
                    ),
                    2 => 'account_name',
                ),
            ),

            //Payment Deposit
            'LBL_DEPOSIT' =>
            array (
                0 => array (
                    0 => array(
                        'name'=>'name',
                        'customCode' => '{$payment_id}',
                    ),
                    1 => array (
                        'name' => 'status',
                        'customCode' => '<b>{$fields.status.value}</b>',
                    ),
                    2 =>
                    array (
                        'name' => 'sale_type',
                        'customCode' => '{$sale_typeQ}',
                    ),
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 => array (
                        'name' => 'payment_type',
                    ),
                    2 =>
                    array (
                        'name' => 'sale_type_date',
                        'customCode' => '{$sale_type_dateQ}',
                    ),
                ),
                2 => array (
                    0 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_PAYMENT_AMOUNT}:',
                        'name'          => 'payment_amount',
                    ),
                    1 => array(
                        'name'          => 'kind_of_course_string',
                    ),
                    2 => 'payment_date',

                ),
                3 => array (
                    0 => 'remain_amount',
                    1 => array(
                        'name'          => 'level_string',
                    ),
                    2 => array(
                        'name' => 'payment_expired',
                        'customCode' => '{$payment_expiredQ}',
                    ),
                ),
                4 => array (
                    0 => array(
                        'label' => 'LBL_PAID_AMOUNT_2',
                        'customCode' => '{$PAID_AMOUNT}',
                    ),
                    1 => array(
                        'customLabel' => '{$MOD.LBL_UNPAID_AMOUNT}:<img border="0" onclick="return DOTB.util.showHelpTips(this,\'{$MOD.LBL_PAYMENT_WARNING}\');" src="themes/RacerX/images/helpInline.png">',
                        'customCode' => '{$UNPAID_AMOUNT}',
                    ),
                    2 => 'account_name'
                ),
            ),

            //Payment BookGift & Payment Placement Test
            'LBL_BOOK_PLACEMENT_TEST' => array (
                0 => array (
                    0 => array(
                        'name'=>'name',
                        'customCode' => '{$payment_id}',
                    ),
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 => array (
                        'name' => 'payment_type',
                    ),
                    2 => 'payment_date',
                ),
                2 => array (
                    0 => array(
                        'customCode' => '
                        <table id="tblbook" style="width: 50%;" border="1" class="list view">
                        <thead>
                        <tr>
                        <th width="30%" style="text-align: center;">Name</th>
                        <th width="10%" style="text-align: center;">Unit</th>
                        <th width="20%" style="text-align: center;">Quantity</th>
                        <th width="25%" style="text-align: center;">Price</th>
                        <th width="25%" style="text-align: center;">Amount</th>
                        </tr>
                        </thead>
                        <tbody id="tbodybook">
                        {$bookList}
                        </tbody>
                        <tfoot>
                        <tr>
                        <td style="text-align: center;" colspan="2"><b>Total:</b></td>
                        <td style="text-align: center;"><b>{$total_book_quantity}</b></td><td></td>
                        <td style="text-align: center;"><b>{$total_book_amount}</b></td>
                        </tr>
                        </tfoot>
                        </table>',
                        'cuscomLabel'=> ''
                    ),
                ),
                5 => array (
                    0 => 'loyalty_amount',
                    1 => 'loyalty_percent',
                    2 => array(
                        'name' => 'j_payment_j_payment_2_name',
                        'label' => 'LBL_PRIMARY_PAYMENT',
                    )
                ),
                6 => array (
                    0 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_PAYMENT_AMOUNT}:',
                        'name'          => 'payment_amount',
                    ),
                    1 => array(
                        'hideLabel' => 'true',
                    ),
                    2 => '',
                ),
                7 => array (
                    0 => array(
                        'label' => 'LBL_PAID_AMOUNT_2',
                        'customCode' => '{$PAID_AMOUNT}',
                    ),
                    1 => array(
                        'customLabel' => '{$MOD.LBL_UNPAID_AMOUNT}:<img border="0" onclick="return DOTB.util.showHelpTips(this,\'{$MOD.LBL_PAYMENT_WARNING}\');" src="themes/RacerX/images/helpInline.png">',
                        'customCode' => '{$UNPAID_AMOUNT}',
                    ),
                    2 => 'account_name'
                ),
            ),

            //Payment Moving Out
            'LBL_MOVING' => array (
                0 => array (
                    0 => 'name',
                    1 => array (
                        'customLabel' => '{$PAYMENT_RELA_LABEL}:',
                        'customCode' => '{$PAYMENT_RELA}',
                    ),
                    2 => array (
                        'hideLabel' => true,
                    ),
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 => 'payment_type',
                    2 => 'payment_date',
                ),
                2 => array (
                    0 =>
                    array (
                        'name'          => 'total_hours',
                    ),
                    1 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_PAYMENT_AMOUNT}:',
                        'name'          => 'payment_amount',
                    ),
                    2 =>
                    array (
                        'customCode'   => '{$fields.use_type.value}',
                        'name'          => 'use_type',
                    ),
                ),
                3 => array (
                    0 =>
                    array (
                        'name'          => 'remain_hours',
                    ),
                    1 => 'remain_amount',
                    2 =>
                    array (
                        'name' => 'payment_expired',
                        'customCode' => '{$payment_expiredQ}',
                    ),
                ),
            ),

            //Payment Transfer
            'LBL_TRANSFER' => array (
                0 => array (
                    0 => 'name',
                    1 => array (
                        'customLabel' => '{$PAYMENT_RELA_LABEL}',
                        'customCode' => '{$PAYMENT_RELA}',
                    ),
                    2 => 'payment_type',
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 => array (
                        'customLabel' => '{$STUDENT_RELA_LABEL}',
                        'customCode' => '{$STUDENT_RELA}',
                    ),
                    2 => 'payment_date',
                ),
                2 => array (
                    0 =>
                    array (
                        'name'          => 'total_hours',
                    ),
                    1 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_PAYMENT_AMOUNT}:',
                        'name'          => 'payment_amount',
                    ),
                    2 =>
                    array (
                        'customCode'   => '{$fields.use_type.value}',
                        'name'          => 'use_type',
                    ),
                ),
                3 => array (
                    0 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_REMAIN_HOURS}:',
                        'name'          => 'remain_hours',
                    ),
                    1 => 'remain_amount',
                    2 =>
                    array (
                        'name' => 'payment_expired',
                        'customCode' => '{$payment_expiredQ}',
                    ),
                ),
            ),
            //Payment Refund
            'LBL_REFUND' => array (
                0 => array (
                    0 => 'name',
                    1 => array (
                        'hideLabel' => true,
                    ),
                    2 => array (
                        'hideLabel' => true,
                    ),
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 => array (
                        'hideLabel' => true,
                    ),
                    2 => 'payment_type',
                ),
                2 => array (
                    0 => array (
                        'name' => 'payment_amount',
                        'label' => 'LBL_REFUND_AMOUNT',
                    ),
                    1 => array (
                        'hideLabel' => true,
                    ),
                    2 => array (
                        'name' => 'refund_revenue',
                        'label' => 'LBL_DROP_REVENUE',
                    ),
                ),
                3 => array (
                    0 => array (
                        'name' => 'payment_date',
                        'label' => 'LBL_REFUND_DATE',
                    ),
                    1 => array (
                        'hideLabel' => true,
                    ),
                    2 => 'uploadfile',

                ),
            ),
            // Payment Delay
            'LBL_DELAY' => array (
                0 => array (
                    0 => array(
                        'name'=>'name',
                        'customCode' => '{$payment_id}',
                    ),
                    1 => array (
                        'hideLabel' => true,
                    ),
                    2 => 'payment_type'
                ),
                1 => array (
                    0 => array (
                        'name' => 'contacts_j_payment_1_name',
                        'customCode' => '{$student_link}'
                    ),
                    1 =>
                    array (
                        'customCode'   => '{$fields.use_type.value}',
                        'name'          => 'use_type',
                    ),
                    2 => 'payment_date',
                ),
                2 => array (
                    0 =>
                    array (
                        'name'          => 'total_hours',
                    ),
                    1 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_PAYMENT_AMOUNT}:',
                        'name'          => 'payment_amount',
                    ),
                    2 => array(
                        'name' => 'payment_expired',
                        'customCode' => '{$payment_expiredQ}',
                    ),
                ),
                3 => array (
                    0 =>
                    array (
                        'customLabel'   => '{$MOD.LBL_REMAIN_HOURS}:',
                        'name'          => 'remain_hours',
                    ),
                    1 => 'remain_amount',
                    2 => array (
                        'hideLabel' => true,
                    ),
                ),
            ),
            //Desctiption & Assign To & Team
            'LBL_OTHER' => array (
                0 => array (
                    0 => 'description',
                    1 =>  array (
                        'name' => 'note',
                        'customCode' => '{$fields.note.value}  {$revenue_link}',
                    ),
                    2 =>  ''
                ),
                1 => array (
                    0 =>
                    array (
                        'name' => 'assigned_user_name',
                        'customCode' => '{$assigned_user_idQ}',
                    ),
                    1 => array (
                        'name' => 'date_entered',
                        'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
                        'label' => 'LBL_DATE_ENTERED',
                    ),
                    2 => ''
                ),
                2 => array (
//                    0 =>array (
//                        'name' => 'user_closed_sale',
//                        'customCode' => '{$user_closed_sale_idQ}',
//                    ),
                    0 => 'team_name',
                    1 =>
                    array (
                        'name' => 'date_modified',
                        'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
                        'label' => 'LBL_DATE_MODIFIED',
                    ),
                    2 =>  ''
                ),
//                3 =>
//                array (
////                    0 =>
////                    array (
////                        'name' => 'user_pt_demo',
////                        'customCode' => '{$user_pt_demo_idQ}',
////                    ),
//                    1 =>  array (
//                        'hideLabel' => 'true',
//                    ),
//                    2 => 'team_name',
//                ),
            ),
        ),
    ),
);
