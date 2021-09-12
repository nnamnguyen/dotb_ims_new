<?php
    $module_name = 'J_Payment';
    $viewdefs[$module_name] =
    array (
        'EditView' =>
        array (
            'templateMeta' =>
            array (
                'form' =>
                array (
                    'enctype' => 'multipart/form-data',
                    'hidden' =>
                    array (
                        1 => '<input type="hidden" name="content" value="{$fields.content.value}">',
                        2 => '{include file="custom/modules/J_Payment/tpl/discountTable.tpl"}
                        {include file="custom/modules/J_Payment/tpl/loyatyTable.tpl"}
                        {include file="custom/modules/J_Payment/tpl/sponTable.tpl"}',
                        3 => '{$discount_list}{$sponsor_list}{$loyalty_list}',
                        4 => '<input type="hidden" name="payment_list" id="payment_list" value="{$fields.payment_list.value}">',
                        6 => '<input type="hidden" name="class_list" id="class_list" value="{$fields.class_list.value}">',
                        7 => '<input type="hidden" name="sponsor_id" id="sponsor_id" value="">',
                        8 => '
                        <input type="hidden" name="sub_discount_amount" id="sub_discount_amount" value="{dotb_number_format var=$fields.sub_discount_amount.value}">
                        <input type="hidden" name="sub_discount_percent" id="sub_discount_percent" value="{dotb_number_format var=$fields.sub_discount_percent.value precision=2}">',
                        9 => '<input type="hidden" name="lead_id" id="lead_id" value="{$fields.lead_id.value}">',
                        10 => '{$lock_assigned_to}',
                        11 => '<input type="hidden" name="outstanding_list" value="{$fields.outstanding_list.value}">',
                        12 => '<input type="hidden" name="is_outstanding" value="{$fields.is_outstanding.value}">',
                        13 => '<input type="hidden" name="ratio" id="ratio" value="{$ratio}">',
                        14 => '<input type="hidden" name="catch_limit" id="catch_limit" value="{$fields.catch_limit.value}">',
                        15 => '<input type="hidden" name="limited_discount_amount" id="limited_discount_amount" value="{$fields.limited_discount_amount.value}">',
                        16 => '<input type="hidden" name="is_outing" id="is_outing" value="{$fields.is_outing.value}">',

                        18 => '<input type="hidden" name="atype" id="atype" value="Hours">',
                        19 => '<input type="hidden" name="ahour" id="ahour" value="0">',
                        20 => '<input type="hidden" name="aprice" id="aprice" value="0">',
                        21 => '<input type="hidden" name="current_team_id" id="current_team_id" value="{$fields.team_id.value}">',
                        22 => '<input type="hidden" name="parent_type" id="parent_type" value="{$parent_type}">',
                        23 => '<input type="hidden" name="is_over_paidhours" id="is_over_paidhours" value="0">',
                    ),
                ),
                'maxColumns' => '2',
                'widths' =>
                array (
                    0 =>
                    array (
                        'label' => '10',
                        'field' => '45',
                    ),
                    1 =>
                    array (
                        'label' => '10',
                        'field' => '35',
                    ),
                ),
                'javascript' => '
                {dotb_getscript file="custom/include/javascript/Bootstrap/bootstrap.min.js"}
                {dotb_getscript file="custom/include/javascript/BootstrapSelect/bootstrap-select.min.js"}
                {dotb_getscript file="custom/include/javascript/BootstrapMultiselect/js/bootstrap-multiselect.js"}
                <link rel="stylesheet" href="{dotb_getjspath file=custom/include/javascript/Bootstrap/bootstrap.min.css}"/>
                <link rel="stylesheet" href="{dotb_getjspath file=custom/include/javascript/BootstrapSelect/bootstrap-select.min.css}"/>
                <link rel="stylesheet" href="{dotb_getjspath file=custom/include/javascript/BootstrapMultiselect/css/bootstrap-multiselect.css}"/>
                <link rel="stylesheet" href="{dotb_getjspath file=custom/modules/J_Payment/css/custom_style.css}"/>
                {$limit_discount_percent}
                {$min_deposit}
                {$lock_team}
                {$min_points_loyalty}
                {dotb_getscript file="custom/include/javascript/Multifield/jquery.multifield.min.js"}

                {if $fields.payment_type.value == "Moving Out" || $fields.payment_type.value == "Transfer Out" || $fields.payment_type.value == "Refund"}
                {dotb_getscript file="custom/modules/J_Payment/js/edit_moving_transfer_refundd.js"}
                {else}
                {dotb_getscript file="custom/modules/J_Payment/js/edit_view.js"}
                {dotb_getscript file="custom/modules/J_Payment/js/extention_layout.js"}
                {/if}
                {dotb_getscript file="custom/include/javascript/Select2/select2.min.js"}
                <link rel="stylesheet" href="{dotb_getjspath file=custom/include/javascript/Select2/select2.css}"/>
                ',
                'useTabs' => false,
                'tabDefs' =>
                array (
                    'LBL_SELECT_PAYMENT' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                    'LBL_ENROLLMENT' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                    'LBL_OTHER_PAYMENT' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                    'LBL_PAYMENT_MOVING' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                    'LBL_PAYMENT_TRANSFER' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                    'LBL_PAYMENT_REFUND' =>
                    array (
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                    ),
                ),
                'syncDetailEditViews' => false,
            ),
            'panels' =>
            array (
                'LBL_SELECT_PAYMENT' =>
                array (
                    0 =>
                    array (
                        0 => array (
                            'hideLabel' => true,
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/paymentList.tpl"}'
                        )
                    ),
                ),
                'LBL_ENROLLMENT' =>
                array (
                    0 =>
                    array (
                        0 =>
                        array (
                            'name' => 'contacts_j_payment_1_name',
                            'customLabel' => '{$MOD.LBL_STUDENT}: <span class="required">*</span>',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/fieldStudent.tpl"}'
                        ),
                        1 => array(
                            'name' => 'payment_type',
                            'customCode' => '{$payment_type}',
                        ),
                    ),
                    1 =>
                    array (
                        0 =>
                        array (
                            'customLabel' => '{$MOD.LBL_SCLASSES}: <span class="required">*</span>',
                            'customCode' => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><select id="classes" name="classes[]" multiple="multiple"> {$CLASS_OPTIONS} </select></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_LESSONS}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="sessions" id="sessions" value="{$fields.sessions.value}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>',
                        ),
                        1 =>
                        array (
                            'name' => 'class_start',
                            'label' => 'LBL_CLASS_SCHEDULE',
                            'customCode' => '<input class="date_input input_readonly" style="display:none;" autocomplete="off" type="text" name="class_start" id="class_start" value="{$fields.class_start.value}" tabindex="0" size="11" maxlength="10" readonly>
                            <input class="date_input input_readonly" style="display:none;" autocomplete="off" type="text" name="class_end" id="class_end" value="{$fields.class_end.value}" tabindex="0" size="11" maxlength="10" readonly>
                            <div id="div_sclass_schedule" style="display:none;"></div>
                            <input type="button" id="btn_show_hide_schedule" value="{$MOD.LBL_SHOW_SCHEDULE}" onclick="showClassSchedule();"/>',
                            'displayParams' =>array ('required' => false,),
                        ),

                    ),
                    2 =>
                    array (
                        0 => array (
                            'name' => 'start_study',
                            'customCode' => '
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%">
                            <span class="dateTime">
                            <input class="date_input" autocomplete="off" type="text" name="start_study" id="start_study" value="{$fields.start_study.value}" title="{$MOD.LBL_start_study}" tabindex="0" size="11" maxlength="10">
                            <img src="themes/RacerX/images/jscalendar.png" alt="Enter Date" style="position:relative; top:6px" border="0" id="start_study_trigger">
                            </span>
                            {literal}
                            <script type="text/javascript">
                            Calendar.setup ({
                            inputField : "start_study",
                            daFormat : cal_date_format,
                            button : "start_study_trigger",
                            singleClick : true,
                            dateStr : "",
                            step : 1,
                            weekNumbers:false
                            });</script>{/literal}</td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_END_STUDY}: <span class="required">*</span></label></td>
                            <td width="35%" style="padding: 0px !important;"><span class="dateTime">
                            <input class="date_input" autocomplete="off" type="text" name="end_study" id="end_study" value="{$fields.end_study.value}" title="{$MOD.LBL_END_STUDY}" tabindex="0" size="11" maxlength="10">
                            <img src="themes/RacerX/images/jscalendar.png" alt="Enter Date" style="position:relative; top:6px" border="0" id="end_study_trigger">
                            </span>
                            {literal}
                            <script type="text/javascript">
                            Calendar.setup ({
                            inputField : "end_study",
                            daFormat : cal_date_format,
                            button : "end_study_trigger",
                            singleClick : true,
                            dateStr : "",
                            step : 1,
                            weekNumbers:false
                            });</script>{/literal}
                            </td>
                            </tr></tbody>
                            </table>',
                        ),
                        1 =>
                        array (
                            'name' => 'tuition_fee',
                            'label' => 'LBL_TUITION_FEE',
                            'customCode' => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="tuition_fee" id="tuition_fee" size="20" maxlength="26" value="{dotb_number_format var=$fields.tuition_fee.value}" title="{$MOD.LBL_TUITION_FEE}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            <td width="20%" scope="col"><label>
                            {$MOD.LBL_TUITION_HOURS}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="tuition_hours" id="tuition_hours" value="{dotb_number_format var=$fields.tuition_hours.value precision=2}" tabindex="0" size="4" maxlength="10" style="color: rgb(165, 42, 42);" readonly></td>
                            </tr></tbody>
                            </table>',
                        ),

                    ),
                    3 =>
                    array (
                        0 => array ('hideLabel' => true),
                        1 => array (
                            'name' => 'paid_amount',
                            'customLabel' => '<label style="color: green;">{$MOD.LBL_PAID_AMOUNT}: </label>',
                            'customCode' => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="paid_amount" id="paid_amount" size="20" maxlength="26" value="" title="{$MOD.LBL_PAID_AMOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            <td width="20%" scope="col"><label style="color: green;">{$MOD.LBL_PAID_HOURS}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="paid_hours" id="paid_hours" value="{dotb_number_format var=$fields.paid_hours.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>',
                        ),
                    ),
                    4 =>
                    array (
                        0 => array (
                            'name' => 'j_coursefee_j_payment_1j_coursefee_ida',
                            'customCode' => '{$coursefee}',
                            'customLabel' => '{$MOD.LBL_COURSE_FEE_ID}: <span class="required">*</span>',
                        ),
                        1 => array (
                            'name' => 'amount_bef_discount',
                            'label' => 'LBL_AMOUNT_BEF_DISCOUNT',
                            'customCode' => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="amount_bef_discount" id="amount_bef_discount" size="20" maxlength="26" value="{dotb_number_format var=$fields.amount_bef_discount.value}" title="{$MOD.LBL_AMOUNT_BEF_DISCOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_TOTAL_HOURS}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="total_hours" id="total_hours" value="{dotb_number_format var=$fields.total_hours.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>',
                        ),
                    ),
                    5 =>
                    array (
                        0 => array (
                            'name' => 'discount_amount',
                            'customLabel' => '',
                            'customCode' => '
                            <div id="tab_discount" width="80%" style="display:none;">
                            <ul style="float:left">
                            <li><a href="#discount" group="discount">{$MOD.LBL_DISCOUNT}</a></li>
                            <li><a href="#sponsor" group="sponsor">{$MOD.LBL_SPONSOR}</a></li>
                            <li><a href="#loyalty" group="loyalty">{$MOD.LBL_LOYALTY}</a></li>
                            </ul><input style="float:left;margin: 3px 0px 0px 20px;" class="button discount" type="button" name="btn_get_discount" value="{$MOD.LBL_ADD_DISCOUNT}" id="btn_get_discount">
                            <input style="float:left;margin: 3px 0px 0px 20px;display:none;" class="button sponsor" type="button" name="btn_add_sponsor" value="{$MOD.LBL_ADD_SPONSOR}" id="btn_add_sponsor">
                            <input style="float:left;margin: 3px 0px 0px 20px;display:none;" class="button loyalty" type="button" name="btn_get_loyalty" value="{$MOD.LBL_USE_LOYALTY}" id="btn_get_loyalty">

                            <div id="discount"></div>
                            <div id="sponsor"></div>
                            <div id="loyalty"></div>
                            </div>
                            ',
                        ),
                        1 =>
                        array (
                            'customLabel' => '{$MOD.LBL_TOTAL_DISCOUNT_SPONSOR}:',
                            'customCode'  => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr>
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="total_discount_sponsor" id="total_discount_sponsor" size="20" maxlength="26" value="{dotb_number_format var=$fields.total_discount_sponsor.value}" title="{$MOD.LBL_TOTAL_DISCOUNT_SPONSOR}" tabindex="0"  style="font-weight: bold; color: rgb(165, 42, 42);" readonly></td>
                            </tr></tbody>
                            </table>'
                        ),
                    ),
                    6 =>
                    array (
                        0 => array (
                            'name' => 'loyalty_amount',
                            'customCode' => '
                            <div class="discount">
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr>
                            <td width="40%" style="padding: 0px !important;"><input class="currency input_readonly" type="text" name="discount_amount" id="discount_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.discount_amount.value}" title="{$MOD.LBL_DISCOUNT_AMOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_DISCOUNT_PERCENT}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="discount_percent" id="discount_percent" value="{dotb_number_format var=$fields.discount_percent.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>
                            </div>
                            <div class="sponsor" style="display:none;">
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%">
                            <input readonly size="20" maxlength="26" class="currency input_readonly" name="final_sponsor" type="text" id="final_sponsor" value="{dotb_number_format var=$fields.final_sponsor.value}" tabindex="0"  style="font-weight: bold;"></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_FINAL_SPONSOR_PERCENT}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="final_sponsor_percent" id="final_sponsor_percent" value="{dotb_number_format var=$fields.final_sponsor_percent.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>
                            </div>
                            <div class="loyalty" style="display:none;">
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td width="40%" style="padding: 0px !important;"><input class="currency input_readonly" type="text" name="loyalty_amount" id="loyalty_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.loyalty_amount.value}" title="{$MOD.LBL_LOYALTY_AMOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            <td width="20%" scope="col">{$MOD.LBL_LOYALTY_PERCENT}: </td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="loyalty_percent" id="loyalty_percent" value="{dotb_number_format var=$fields.loyalty_percent.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>
                            </div>
                            ',
                            'customLabel' => '
                            <label class="discount">{$MOD.LBL_DISCOUNT_AMOUNT}: </label>
                            <label class="sponsor" style="display:none;">{$MOD.LBL_FINAL_SPONSOR}: </label>
                            <label class="loyalty" style="display:none;">{$MOD.LBL_LOYALTY_AMOUNT}: </label>
                            '
                        ),
                        1 => array (
                            'name' => 'total_after_discount',
                            'customCode' => '<input class="currency input_readonly" type="text" name="total_after_discount" id="total_after_discount" size="20" maxlength="26" value="{dotb_number_format var=$fields.total_after_discount.value}" title="{$MOD.LBL_TOTAL_AFTER_DISCOUNT}" tabindex="0"  style="font-weight: bold;" readonly>',
                        ),
                    ),
                    7 =>
                    array (
                        0 => array (
                            'hideLabel' => true,
                        ),
                        1 => array (
                            'name' => 'deposit_amount',
                            'customCode' => '
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="deposit_amount" id="deposit_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.deposit_amount.value}" title="{$MOD.LBL_DISCOUNT_AMOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            </tr></tbody>
                            </table>',
                            'customLabel' => '<label style="color: green;">{$MOD.LBL_DEPOSIT_AMOUNT}: </label>'
                        ),
                    ),
                    8 =>
                    array (
                        0 => 'payment_date',
                        1 =>
                        array (
                            'name' => 'payment_amount',
                            'customLabel' => '<b>{$MOD.LBL_GRAND_TOTAL}:</b>',
                            'customCode' => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="payment_amount" id="payment_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.payment_amount.value}" title="{$MOD.LBL_GRAND_TOTAL}" tabindex="0"  style="font-weight: bold; color: rgb(165, 42, 42);" readonly></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_TOTAL_REWARDS_AMOUNT} <span id="accrual_rate_label"></span>: </label><input type="hidden" id="accrual_rate_value" name="accrual_rate_value" value=""></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="total_rewards_amount" id="total_rewards_amount" value="{dotb_number_format var=$total_rewards_amount precision=2}" tabindex="0" size="20" maxlength="10" style="font-weight: bold; text-align: right; color: green;" readonly></td>
                            </tr></tbody>
                            </table>
                            ',
                        ),
                    ),
                    9 =>
                    array (
                        0 => array (
                            'name' => 'number_of_payment',
                            'customLabel' => '{$MOD.LBL_SPLIT_PAYMENT}: <span class="required">*</span>',
                            'customCode' => '
                            {html_options name="number_of_payment" id="number_of_payment" options=$fields.number_of_payment.options selected=$fields.number_of_payment.value}
                            <input type="text" name="num_month_pay" id="num_month_pay" value="{$fields.num_month_pay.value}" size="4" maxlength="10" style="display:none">
                            ',
                        ),
                        1 =>
                        array (
                            'name' => 'is_corporate',
                        ),
                    ),
                    10 =>
                    array (
                        0 =>
                        array (
                            'hideLabel' => true,
                            //                        'customCode' => '{$PAYMENT_DETAILS}',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/payment_detail.tpl"}'
                        ),
                        1 =>
                        array (
                            'hideLabel' => true,
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/is_corporate.tpl"}'
                        ),
                    ),
                ),
                // PAYMENT OTHER JUNIOR
                'LBL_OTHER_PAYMENT' =>
                array (
                    0 =>
                    array (
                        0 =>
                        array (
                            'name' => 'contacts_j_payment_1_name',
                            'customLabel' => '{$MOD.LBL_STUDENT}: <span class="required">*</span>',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/fieldStudent.tpl"}'
                        ),
                        1 =>
                        array (
                            'name' => 'payment_type',
                            'customCode' => '
                            {if !empty($fields.id.value)}
                            {$fields.payment_type.value}<input type="hidden" name="payment_type" id="payment_type" value="{$fields.payment_type.value}"/>
                            {else}
                            {html_options name="payment_type" id="payment_type" options=$payment_type selected=$payment_type_selected}{/if}
                            ',
                        ),
                    ),
                    1 =>
                    array (
                        0 => array (
                            'name' => 'j_coursefee_j_payment_1j_coursefee_ida',
                            'customCode' => '{$coursefee}',
                            'customLabel' => '{$MOD.LBL_COURSE_FEE_ID}: <span class="required">*</span>',
                        ),
                        1 => array (
                            'name' => 'duration_exp',
                            'customCode' => '<table width="100%" style="padding:0px!important;"><tbody><tr>
                            <td style="padding: 0px !important;" width = "40%">
                            {html_options style="width: 60%;" name="duration_exp" class="duration_exp" id="duration_exp" options=$duration_exp_options selected=$fields.duration_exp.value}
                            <td width="20%" scope="col" class="duration_exp" style="display:none;">{$MOD.LBL_AF_DURATION_EXP}: <span class="required">*</span></td>
                            <td width="35%" class="duration_exp" style="display:none;"><input autocomplete="off" type="text" class="duration_exp input_readonly" name="af_duration_exp" id="af_duration_exp" value="{$fields.af_duration_exp.value}" tabindex="0" size="20" maxlength="225"  style="color: rgb(165, 42, 42);" readonly></td>
                            </tr></tbody>
                            </table>',
                        ),
                    ),
                    2 =>
                    array (
                        0 =>array (
                            'name' => 'kind_of_course',
                            'customCode'=> '{html_options name="kind_of_course" style="padding: 3px;" id="kind_of_course" options=$fields.kind_of_course.options selected=$fields.kind_of_course.value}'
                        ),
                        1 => array (
                            'name' => 'amount_bef_discount',
                            'label' => 'LBL_AMOUNT_BEF_DISCOUNT',
                            'customCode' => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr>
                            <td style="padding: 0px !important;" width = "40%">
                            <input type="hidden" name="tuition_fee" id="tuition_fee" value="{dotb_number_format var=$fields.tuition_fee.value}">
                            <input class="currency" type="text" name="amount_bef_discount" id="amount_bef_discount" size="20" maxlength="26" value="{dotb_number_format var=$fields.amount_bef_discount.value}" title="{$MOD.LBL_AMOUNT_BEF_DISCOUNT}" tabindex="0"  style="font-weight: bold;color: rgb(165, 42, 42);"></td>
                            <td width="20%" scope="col" class="tuition_hours">{$MOD.LBL_TUITION_HOURS}: <span class="required">*</span></td>
                            <td width="35%"><input autocomplete="off" type="text" class="tuition_hours" name="tuition_hours" id="tuition_hours" value="{dotb_number_format var=$fields.tuition_hours.value precision=2}" tabindex="0" size="4" maxlength="10"  style="color: rgb(165, 42, 42);" ></td>
                            </tr></tbody>
                            </table>',
                        ),
                    ),
                    3 =>
                    array (
                        0 => array (
                            'name' => 'discount_amount',
                            'customLabel' => '',
                            'customCode' => '
                            <div id="tab_discount" width="80%" style="display:none;">
                            <ul style="float:left">
                            <li><a href="#discount" group="discount">{$MOD.LBL_DISCOUNT}</a></li>
                            <li><a href="#sponsor" group="sponsor">{$MOD.LBL_SPONSOR}</a></li>
                            <li><a href="#loyalty" group="loyalty">{$MOD.LBL_LOYALTY}</a></li>
                            </ul><input style="float:left;margin: 3px 0px 0px 20px;" class="button discount" type="button" name="btn_get_discount" value="{$MOD.LBL_ADD_DISCOUNT}" id="btn_get_discount">
                            <input style="float:left;margin: 3px 0px 0px 20px;display:none;" class="button sponsor" type="button" name="btn_add_sponsor" value="{$MOD.LBL_ADD_SPONSOR}" id="btn_add_sponsor">
                            <input style="float:left;margin: 3px 0px 0px 20px;display:none;" class="button loyalty" type="button" name="btn_get_loyalty" value="{$MOD.LBL_USE_LOYALTY}" id="btn_get_loyalty">

                            <div id="discount"></div>
                            <div id="sponsor"></div>
                            <div id="loyalty"></div>
                            </div>
                            ',
                        ),
                        1 =>
                        array (
                            'customLabel' => '{$MOD.LBL_TOTAL_DISCOUNT_SPONSOR}:',
                            'customCode'  => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr>
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="total_discount_sponsor" id="total_discount_sponsor" size="20" maxlength="26" value="{dotb_number_format var=$fields.total_discount_sponsor.value}" title="{$MOD.LBL_TOTAL_DISCOUNT_SPONSOR}" tabindex="0"  style="font-weight: bold; color: rgb(165, 42, 42);" readonly></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_TOTAL_HOURS}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="total_hours" id="total_hours" value="{dotb_number_format var=$fields.total_hours.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>'
                        ),
                    ),
                    4 =>
                    array (
                        0 => array (
                            'name' => 'loyalty_amount',
                            'customCode' => '
                            <div class="discount">
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr>
                            <td width="40%" style="padding: 0px !important;"><input class="currency input_readonly" type="text" name="discount_amount" id="discount_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.discount_amount.value}" title="{$MOD.LBL_DISCOUNT_AMOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_DISCOUNT_PERCENT}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="discount_percent" id="discount_percent" value="{dotb_number_format var=$fields.discount_percent.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>
                            </div>
                            <div class="sponsor" style="display:none;">
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%">
                            <input readonly size="20" maxlength="26" class="currency input_readonly" name="final_sponsor" type="text" id="final_sponsor" value="{dotb_number_format var=$fields.final_sponsor.value}" tabindex="0"  style="font-weight: bold;"></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_FINAL_SPONSOR_PERCENT}: </label></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="final_sponsor_percent" id="final_sponsor_percent" value="{dotb_number_format var=$fields.final_sponsor_percent.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>
                            </div>
                            <div class="loyalty" style="display:none;">
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td width="40%" style="padding: 0px !important;"><input class="currency input_readonly" type="text" name="loyalty_amount" id="loyalty_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.loyalty_amount.value}" title="{$MOD.LBL_LOYALTY_AMOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            <td width="20%" scope="col">{$MOD.LBL_LOYALTY_PERCENT}: </td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="loyalty_percent" id="loyalty_percent" value="{dotb_number_format var=$fields.loyalty_percent.value precision=2}" tabindex="0" size="4" maxlength="10" readonly></td>
                            </tr></tbody>
                            </table>
                            </div>
                            ',
                            'customLabel' => '
                            <label class="discount">{$MOD.LBL_DISCOUNT_AMOUNT}: </label>
                            <label class="sponsor" style="display:none;">{$MOD.LBL_FINAL_SPONSOR}: </label>
                            <label class="loyalty" style="display:none;">{$MOD.LBL_LOYALTY_AMOUNT}: </label>
                            '
                        ),
                        1 => array (
                            'name' => 'total_after_discount',
                            'customCode' => '<input class="currency input_readonly" type="text" name="total_after_discount" id="total_after_discount" size="20" maxlength="26" value="{dotb_number_format var=$fields.total_after_discount.value}" title="{$MOD.LBL_TOTAL_AFTER_DISCOUNT}" tabindex="0"  style="font-weight: bold;" readonly>',
                        ),
                    ),
                    5 =>
                    array (
                        0 => array (
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/BookTemplate.tpl"}',
                        ),
                        1 =>
                        array (
                            'name' => 'is_free_book',
                            'customLabel' => '',
                            'customCode' => '<input type="hidden" name="is_free_book" id="is_free_book"/>',
                        ),
                    ),
                    6 =>
                    array (
                        0 =>
                        array (
                            'hideLabel' => true,
                        ),
                        1 =>
                        array (
                            'name' => 'deposit_amount',
                            'customCode' => '
                            <table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="deposit_amount" id="deposit_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.deposit_amount.value}" title="{$MOD.LBL_DISCOUNT_AMOUNT}" tabindex="0"  style="font-weight: bold;" readonly></td>
                            </tr></tbody>
                            </table>',
                            'customLabel' => '<label style="color: green;">{$MOD.LBL_DEPOSIT_AMOUNT}: </label>'
                        ),
                    ),
                    7 =>
                    array (
                        0 => 'payment_date',
                        1 =>
                        array (
                            'name' => 'payment_amount',
                            'customLabel' => '<b>{$MOD.LBL_GRAND_TOTAL}:</b>',
                            'customCode' => '<table width="100%" style="padding:0px!important;">
                            <tbody><tr colspan="3">
                            <td style="padding: 0px !important;" width = "40%"><input class="currency input_readonly" type="text" name="payment_amount" id="payment_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.payment_amount.value}" title="{$MOD.LBL_GRAND_TOTAL}" tabindex="0"  style="font-weight: bold; color: rgb(165, 42, 42);" readonly></td>
                            <td width="20%" scope="col"><label>{$MOD.LBL_TOTAL_REWARDS_AMOUNT} <span id="accrual_rate_label"></span>: </label><input type="hidden" id="accrual_rate_value" name="accrual_rate_value" value=""></td>
                            <td width="35%"><input class="input_readonly" autocomplete="off" type="text" name="total_rewards_amount" id="total_rewards_amount" value="{dotb_number_format var=$total_rewards_amount precision=2}" tabindex="0" size="20" maxlength="10" style="font-weight: bold; text-align: right; color: green;" readonly></td>
                            </tr></tbody>
                            </table>
                            ',
                        ),
                    ),
                    8 =>
                    array (
                        0 => array (
                            'name' => 'number_of_payment',
                            'customLabel' => '{$MOD.LBL_SPLIT_PAYMENT}: <span class="required">*</span>',
                            'customCode' => '
                            {html_options name="number_of_payment" id="number_of_payment" options=$fields.number_of_payment.options selected=$fields.number_of_payment.value}
                            <input type="text" name="num_month_pay" id="num_month_pay" value="{$fields.num_month_pay.value}" size="4" maxlength="10" style="display:none">',
                        ),
                        1 =>
                        array (
                            'name' => 'is_corporate',
                        ),
                    ),
                    9 =>
                    array (
                        0 =>
                        array (
                            'hideLabel' => true,
                            //                        'customCode' => '{$PAYMENT_DETAILS}',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/payment_detail.tpl"}'
                        ),
                        1 =>
                        array (
                            'hideLabel' => true,
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/is_corporate.tpl"}'
                        ),
                    ),
                ),
                // Payment Moving
                'LBL_PAYMENT_MOVING' =>
                array (
                    1 =>
                    array (
                        0 => array (
                            'name' => 'contacts_j_payment_1_name',
                            'customLabel' => '{$MOD.LBL_STUDENT}: <span class="required">*</span>',
                        ),
                        1 => array (
                            'name' => 'move_to_center_name',
                        ),
                    ),
                    2 => array (
                        0 => array (
                            'name' => 'total_hours',
                            'customLabel' => '{$MOD.LBL_MOVING_HOURS} : <span class="required">*</span>',
                            'customCode' => '<input class="input_readonly" type="text" name="total_hours" id="total_hours" size="20" maxlength="26" value="{dotb_number_format var=$fields.total_hours.value precision=2}" title="{$MOD.LBL_MOVING_HOURS}" tabindex="0"  style="font-weight: bold; text-align:right; color: rgb(165, 42, 42);" readonly>
                            {$payment_type}
                            <input type="hidden" id="json_student_info" name="json_student_info">
                            <input type="hidden" id="json_payment_list" name="json_payment_list">
                            ',
                        ),
                        1 => array (
                            'name' => 'payment_amount',
                            'customLabel' => '{$MOD.LBL_MOVING_AMOUNT}: <span class="required">*</span>',
                            'customCode' => '<input class="currency input_readonly" type="text" name="payment_amount" id="payment_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.payment_amount.value}" title="{$MOD.LBL_MOVING_AMOUNT}" tabindex="0"  style="font-weight: bold;color: rgb(165, 42, 42);" readonly>',
                        ),
                    ),
                    3 =>
                    array (
                        0 =>  array(
                            'name' => 'moving_tran_out_date',
                            'label' => 'LBL_MOVING_OUT_DATE',
                            'customCode' => '<span class="dateTime"><input class="date_input input_readonly" autocomplete="off" type="text" name="moving_tran_out_date" id="moving_tran_out_date" value="{$fields.moving_tran_out_date.value}" tabindex="0" size="11" maxlength="10" readonly></span>',
                        ),
                        1 =>  array(
                            'name' => 'moving_tran_in_date',
                            'label' => 'LBL_MOVING_IN_DATE',
                            'customCode' => '<span class="dateTime"><input class="date_input input_readonly" autocomplete="off" type="text" name="moving_tran_in_date" id="moving_tran_in_date" value="{$fields.moving_tran_in_date.value}" tabindex="0" size="11" maxlength="10" readonly></span>',
                        ),
                    ),
                    4 =>
                    array (
                        0 =>  array (
                            'name' => 'description',
                            'label' => 'LBL_DESCRIPTION',
                            'displayParams' =>
                            array (
                                'required' => true,
                            ),
                        ),
                    ),
                    5 =>
                    array (
                        0 =>  array (
                            'name' => 'assigned_user_name',
                        ),
                        1 =>
                        array (
                            'name' => 'team_name',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/fieldTeam.tpl"}',
                        ),
                    ),
                ),
                //Panel Transfer
                'LBL_PAYMENT_TRANSFER' =>
                array (
                    1 =>
                    array (
                        0 => array (
                            'name' => 'contacts_j_payment_1_name',
                            'customLabel' => '{$MOD.LBL_STUDENT}: <span class="required">*</span>',
                        ),
                        1 => array (
                            'name' => 'transfer_to_student_name',
                            'displayParams' =>
                            array (
                                'field_to_name_array' =>
                                array (
                                    'id' => 'transfer_to_student_id',
                                    'name' => 'transfer_to_student_name',
                                ),
                                'required' => true,
                                'class' => 'sqsNoAutofill',
                            ),
                        ),
                    ),
                    2 => array (
                        0 => array (
                            'name' => 'total_hours',
                            'customLabel' => '{$MOD.LBL_TRANSFER_HOURS}: <span class="required">*</span>',
                            'customCode' => '<input class="input_readonly" type="text" name="total_hours" id="total_hours" size="20" maxlength="26" value="{dotb_number_format var=$fields.total_hours.value precision=2}" title="{$MOD.LBL_TRANSFER_HOURS}" tabindex="0"  style="font-weight: bold; text-align:right; color: rgb(165, 42, 42);" readonly>
                            {$payment_type}
                            <input type="hidden" id="json_student_info" name="json_student_info">
                            <input type="hidden" id="json_payment_list" name="json_payment_list">',
                        ),
                        1 => array (
                            'name' => 'payment_amount',
                            'customLabel' => '{$MOD.LBL_TRANSFER_AMOUNT}: <span class="required">*</span>',
                            'customCode' => '<input class="currency input_readonly" type="text" name="payment_amount" id="payment_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.payment_amount.value}" title="{$MOD.LBL_TRANSFER_AMOUNT}" tabindex="0"  style="font-weight: bold;color: rgb(165, 42, 42);" readonly>',
                        ),
                    ),
                    3 =>
                    array (
                        0 =>  array(
                            'name' => 'moving_tran_out_date',
                            'label' => 'LBL_TRANSFER_OUT_DATE',
                            'customCode' => '<span class="dateTime"><input class="date_input input_readonly" autocomplete="off" type="text" name="moving_tran_out_date" id="moving_tran_out_date" value="{$fields.moving_tran_out_date.value}" tabindex="0" size="11" maxlength="10" readonly></span>',

                        ),
                        1 =>  array(
                            'name' => 'moving_tran_in_date',
                            'label' => 'LBL_TRANSFER_IN_DATE',
                            'customCode' => '<span class="dateTime"><input class="date_input input_readonly" autocomplete="off" type="text" name="moving_tran_in_date" id="moving_tran_in_date" value="{$fields.moving_tran_in_date.value}" tabindex="0" size="11" maxlength="10" readonly></span>',

                        ),
                    ),
                    4 =>
                    array (
                        0 =>  array (
                            'name' => 'description',
                            'displayParams' =>
                            array (
                                'required' => true,
                            ),

                        ),
                    ),
                    5 =>
                    array (
                        0 =>  array (
                            'name' => 'assigned_user_name',
                        ),
                        1 =>
                        array (
                            'name' => 'team_name',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/fieldTeam.tpl"}',
                        ),
                    ),
                ),
                //Panel Refund
                'LBL_PAYMENT_REFUND' =>
                array (
                    1 =>
                    array (
                        0 => array (
                            'name' => 'contacts_j_payment_1_name',
                            'customLabel' => '{$MOD.LBL_STUDENT}: <span class="required">*</span>',
                        ),
                    ),
                    2 => array (
                        0 => array (
                            'name' => 'payment_amount',
                            'customLabel' => '{$MOD.LBL_REFUND_AMOUNT}: ',
                            'customCode' => '<input class="currency" type="text" name="payment_amount" id="payment_amount" size="20" maxlength="26" value="{dotb_number_format var=$fields.payment_amount.value}" title="{$MOD.LBL_REFUND_AMOUNT}" tabindex="0"  style="font-weight: bold;color: rgb(165, 42, 42);" >',
                        ),

                        1 => array (
                            'name' => 'refund_revenue',
                            'customLabel' => '{$MOD.LBL_DROP_REVENUE}: ',
                            'customCode' => '<input type="text" name="refund_revenue" class="currency" id="refund_revenue" size="20" maxlength="26" value="{dotb_number_format var=$fields.refund_revenue.value}" title="{$MOD.LBL_REFUND_REVENUE}" tabindex="0"  style="font-weight: bold; text-align:right; color: rgb(165, 42, 42);" >
                            <input type="hidden" id="payment_type" name="payment_type" value={$fields.payment_type.value}>
                            <input type="hidden" id="json_student_info" name="json_student_info">
                            <input type="hidden" id="json_payment_list" name="json_payment_list">',
                        ),

                    ),
                    3 => array (
                        0 => array(
                            'hideLabel' => true,
                            'customCode' => '<img src="themes/RacerX/images/helpInline.png" class="paidAmountHelpTip">Refund Amount may be less than or equal to the Total remain amount of the payment is selected'
                        ),
                        1 => array(
                            'hideLabel' => true,
                            'customCode' => '<img src="themes/RacerX/images/helpInline.png" class="paidAmountHelpTip">If the Admin Charge equal zero system will not generate Revenue drop'
                        ),
                    ),
                    4 =>
                    array (
                        0 =>  array(
                            'name' => 'moving_tran_out_date',
                            'label' => 'LBL_REFUND_DATE',
                            'customCode' => '<span class="dateTime"><input class="date_input input_readonly" autocomplete="off" type="text" name="moving_tran_out_date" id="moving_tran_out_date" value="{$fields.moving_tran_out_date.value}" tabindex="0" size="11" maxlength="10" readonly></span>',
                        ),
                        1 =>
                        array (
                            'name' => 'uploadfile',
                            'displayParams' =>
                            array (
                                'onchangeSetFileNameTo' => 'document_name',
                            ),
                        ),
                    ),
                    5 =>
                    array (
                        0 =>  array (
                            'name' => 'description',
                            'displayParams' =>
                            array (
                                'required' => true,
                            ),
                        ),
                    ),
                    6 =>
                    array (
                        0 =>  array (
                            'name' => 'assigned_user_name',
                        ),
                        1 =>
                        array (
                            'name' => 'team_name',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/fieldTeam.tpl"}',
                        ),
                    ),
                ),
                'LBL_OTHER' =>
                array (
                    0 =>
                    array (
                        0 =>
                        array (
                            'name' => 'description',
                            'label' => 'LBL_DESCRIPTION',
                            'displayParams' =>
                            array (
                                'rows' => 4,
                                'cols' => 60,
                            ),
                        ),
                        1 =>
                        array (
                            'name' => 'note',
                            'label' => 'LBL_NOTE',
                            'customCode' => '<textarea id="note" name="note" rows="4" cols="50" title="Note" tabindex="0">{$fields.note.value}</textarea>'
                        ),
                    ),
                    1 =>
                    array (
                        0 =>
                        array (
                            'name' => 'assigned_user_name',
                            'displayParams' =>
                            array (
                                'required' => true,
                            ),
                        ),
                        1 =>
                        array (
                            'name' => 'team_name',
                            'customCode' => '{include file="custom/modules/J_Payment/tpl/fieldTeam.tpl"}',
                        ),
                    ),
//                    2 =>
//                    array (
//                        0 => array (
//                            'name' => 'user_closed_sale',
//                            'displayParams' =>
//                            array (
//                                'required' => true,
//                            ),
//                        ),
//                    ),
//                    3 =>
//                    array (
//                        0 => array (
//                            'name' => 'user_pt_demo',
//                            'displayParams' =>
//                            array (
//                                'required' => true,
//                            ),
//                        ),
//                    ),
                ),
            ),
        ),
    );
