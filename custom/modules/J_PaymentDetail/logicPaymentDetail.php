<?php
class DisplayButtonLogicHook{
    function addPaymentAmount($bean, $event, $arguments){
        //Bo sung chuc nang Edit so tien thu
        //            $arrayUrl = explode('/', $_REQUEST['__dotb_url']);
        //            $action = $arrayUrl[sizeof($arrayUrl) - 1];
        //            $module = $arrayUrl[sizeof($arrayUrl) - 2];
        //
        //            if (!empty($bean->fetched_row) && ($bean->fetched_row['payment_amount'] != $bean->payment_amount) && (($_POST['module'] == $bean->module_name && $_POST['action'] == 'Save') || $action == 'MassUpdate') ) {
        //                $amount =  $bean->payment_amount - $bean->fetched_row['payment_amount'];
        //                $bean->before_discount += $amount;
        //                $GLOBALS['db']->query("UPDATE j_payment SET payment_amount = payment_amount + $amount, remain_amount = remain_amount + $amount, amount_bef_discount = amount_bef_discount + $amount, total_after_discount = total_after_discount + $amount WHERE id = '{$bean->payment_id}'");
        //            }
    }
//    function deletedPaymentDetail($bean, $event, $arguments){
//
//        $GLOBALS['db']->query("UPDATE j_loyalty SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE paymentdetail_id = '{$bean->id}'");
//        $GLOBALS['db']->query("UPDATE c_commission SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE pmd_id = '{$bean->id}'");
//    }
    function displayButton($bean, $event, $arguments) {
        require_once("custom/modules/J_Payment/_helper.php");
        global $timedate,$dotb_config;
        if ($_REQUEST['module']=='J_Payment'){
            $bean->custom_button = '<div style="display: inline-flex;">';

            //Show paid amount, unpaid amount
            $sqlPayDtl = "SELECT DISTINCT
            IFNULL(pmd.id, '') primaryId,
            IFNULL(pmd.payment_no, '') payment_no,
            IFNULL(pmd.status, '') status,
            IFNULL(l1.id, '') payment_id,
            IFNULL(l1.payment_type, '') payment_type,
            IFNULL(l1.kind_of_course, '') kind_of_course,
            IFNULL(pmd.expired_date, '') expired_date,
            IFNULL(pmd.payment_date, '') receipt_date,
            IFNULL(pmd.payment_amount, '0') payment_amount
            FROM j_paymentdetail pmd
            INNER JOIN j_payment l1 ON pmd.payment_id = l1.id AND l1.deleted = 0
            WHERE l1.id = '{$bean->payment_id}' AND pmd.deleted = 0 AND pmd.status <> 'Cancelled'
            ORDER BY pmd.payment_no";
            $resultPayDtl = $GLOBALS['db']->query($sqlPayDtl);
            $paidAmount     = 0;
            $unpaidAmount   = 0;
            while($rowPayDtl = $GLOBALS['db']->fetchByAssoc($resultPayDtl)){
                if($rowPayDtl['status'] == "Unpaid") $unpaidAmount += $rowPayDtl['payment_amount'];
                else $paidAmount   += $rowPayDtl['payment_amount'];
                if($bean->id == $rowPayDtl['primaryId']) $payment = $rowPayDtl;
            }

            //Get description
            if(empty($bean->description))
                $description = generateContent($payment);
            else
                $description = $bean->description;

            if($bean->status == 'Unpaid'){
                $bean->custom_button .= '<button style="width: 100px;height: 46px;" type="button" payment_detail_id="'.$bean->id.'" payment_detail_amount="'.format_number($bean->payment_amount,0,0).'" pmd_bank_account="'.$bean->bank_account.'" pmd_reference_document="'.$bean->reference_document.'" pmd_reference_number="'.$bean->reference_number.'" inv_code="'.$bean->inv_code.'" pmd_unpaid_amount="'.format_number($unpaidAmount).'" pmd_description="'.$description.'" class="pay" onclick="pay(this);"><i class="far fa-hand-holding-usd" style="font-size: 17px;"></i> &nbsp; '.translate('LBL_PAY','J_Payment').' </button>';
                $bean->status = '<span class="textbg_orange">'.$GLOBALS['app_list_strings']['status_paymentdetail_list'][$bean->status].'</span>';
                $bean->payment_date = '';
            }elseif($bean->status == 'Cancelled'){
                $bean->status = '<b>'.$GLOBALS['app_list_strings']['status_paymentdetail_list'][$bean->status].'</b>';
            }elseif($bean->status == 'Paid'){  //Button get invoice no
                //check export receipt
                $check =0;
                $q_pdf = $GLOBALS['db']->query("SELECT COUNT(DISTINCT id) as count, id FROM pdfmanager WHERE deleted =0 AND base_module = 'J_PaymentDetail' AND published ='yes'");
                $pdf = $GLOBALS['db']->fetchByAssoc($q_pdf);
                if($pdf['count']) $check =1;
                $bean->custom_button .= '<button style="width: 100px;height: 46px;margin-left: 5px;" type="button" pdf_id = "'.$pdf['id'].'"pdf="'.$check.'"payment_detail_id="'.$bean->id.'" onclick="ex_invoice(this);"> <i class="far fa-file-export" style="font-size: 17px;"></i>  '.translate('LBL_EXPORT','J_Payment').'</button>';
                if(checkDataLockDate($bean->payment_date)){
                    $bean->custom_button .= '<button style="width: 70px;height: 46px;margin-left: 5px;" payment_method="'.$bean->payment_method.'" payment_detail_amount="'.format_number($bean->payment_amount,0,0).'" payment_date="'.$timedate->to_display_date($bean->payment_date,true).'" card_type="'.$bean->card_type.'" bank_type="'.$bean->bank_type.'" pmd_bank_account="'.$bean->bank_account.'" pmd_reference_document="'.$bean->reference_document.'" pmd_reference_number="'.$bean->reference_number.'" pmd_unpaid_amount="'.format_number($unpaidAmount).'" pmd_description="'.$description.'" onclick = \'edit_invoice(this)\' payment_detail_id="'.$bean->id.'" pos_code="'.$bean->pos_code.'" inv_code="'.$bean->inv_code.'"><i class="far fa-money-check-edit-alt" style="font-size: 17px;"></i>  '.translate('LBL_EDIT','J_Payment').'</button>';
                    $bean->custom_button .= '<button style="width: 100px;height: 46px;margin-left: 5px;" payment_detail_id="' . $bean->id . '" class="cancel_invoice" onclick = \'cancel_receipt("' . $bean->id . '")\'><i class="far fa-minus-circle" style="font-size: 17px;"></i>  '.translate('LBL_VOID','J_Payment').'</button>';
                }
                $bean->status = '<span class="textbg_green">'.$GLOBALS['app_list_strings']['status_paymentdetail_list'][$bean->status].'</span>';
            }

            $bean->custom_button .= '</div>';

            $bean->discount_amount += $bean->sponsor_amount + $bean->loyalty_amount;
        }
    }

    function handleBeforeSave($bean, $event, $arguments){
        //Create Receipt code
        if(($bean->name == '-none-') || empty($bean->fetched_row)){
            //Get Prefix
            $res        = $GLOBALS['db']->query("SELECT code_prefix FROM teams WHERE id = '{$bean->team_id}'");
            $row        = $GLOBALS['db']->fetchByAssoc($res);
            $code_field = 'name';
            $prefix     = '';
            $year       = date('ym',strtotime(((!empty($bean->expired_date)) ? ($bean->expired_date) : ($bean->printed_date))));
            $table      = $bean->table_name;
            $first_pad  = '0000';
            $padding    = 4;
            $str_code = $prefix.$year;

            $query = "SELECT $code_field FROM $table WHERE ( $code_field <> '' AND $code_field IS NOT NULL) AND id != '{$bean->id}' AND (LEFT($code_field, ".strlen($str_code).") = '".$str_code."') AND deleted=0 ORDER BY RIGHT($code_field, $padding) DESC LIMIT 1";
            $result = $GLOBALS['db']->query($query);

            if($row = $GLOBALS['db']->fetchByAssoc($result))
                $last_code = $row[$code_field];
            else
                //no codes exist, generate default - PREFIX + CURRENT YEAR +  SEPARATOR + FIRST NUM
                $last_code = $str_code. $first_pad;

            $num = substr($last_code, -$padding, $padding);
            $num++;
            $pads = $padding - strlen($num);
            $new_code = $str_code;

            //preform the lead padding 0
            for($i=0; $i < $pads; $i++)
                $new_code .= "0";
            $new_code .= $num;

            //write to database - Logic: Before Save
            $bean->$code_field = $new_code;
        }

        if(($_POST['module'] == $bean->module_name && $_POST['action'] == 'Save') || ($_POST['module'] == 'Import')){
            $_fee = 0;
            if($bean->payment_method == 'Card')
                $_fee  = floatval($GLOBALS['app_list_strings']['card_rate'][$bean->card_type]) * $bean->payment_amount / 100;
            elseif($bean->payment_method == 'Bank Transfer'){
                $_fee  = floatval($GLOBALS['app_list_strings']['bank_rate'][$bean->card_type]) * $bean->payment_amount / 100;
            }
            $bean->payment_method_fee = $_fee;

            //Update Student ID
            if (empty($bean->student_id) || (!empty($bean->fetched_row) && ($bean->fetched_row['payment_id'] != $bean->payment_id))) {
                $payment = BeanFactory::getBean('J_Payment', $bean->payment_id);
                $bean->student_id = $payment->contacts_j_payment_1contacts_ida;
            }

        }
        if($bean->fetched_row['status'] == 'Unpaid' && $bean->status =='Paid' && $bean->payment_amount > 0){
            require_once("custom/clients/mobile/helper/NotificationHelper.php");
            //Push notification
            $notify = new NotificationMobile();
            $notify->pushNotification('Thông tin học phí','Hóa đơn '.$bean->name.' đã thanh toán thành công!', 'J_PaymentDetail', $bean->id, $bean->student_id, 'Student' );
        }
//        if(empty($bean->description)) {
//            $quote = BeanFactory::getBean('Quotes',$bean->quote_id);
//            $bean->description = 'Thanh toán hóa đơn ' . $quote->name;
//        }

    }

    function handleAfterSave($bean, $event, $arguments){
        if(($_POST['module'] == $bean->module_name && $_POST['action'] == 'Save')){
            //Update finish printing - bug edit bằng tay
            $GLOBALS['db']->query("UPDATE j_configinvoiceno SET finish_printing = 1 WHERE deleted = 0 AND pmd_id_printing='{$bean->id}'");
        }

        //Loyalty Point
        if ($bean->status == 'Paid') {
            //delete First
            $GLOBALS['db']->query("UPDATE j_loyalty SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE payment_id='{$bean->payment_id}' AND paymentdetail_id='{$bean->id}' AND deleted=0");
            $q1 = "SELECT DISTINCT
            IFNULL(l1.id, '') payment_id,
            IFNULL(l2.loyalty_points, 0) loyalty_points,
            IFNULL(l4.id, '') student_id,
            IFNULL(l2.description, '') description,
            COUNT(l3.id) count_loyalty,
            COUNT(*) count
            FROM
            j_paymentdetail
            INNER JOIN j_payment l1 ON j_paymentdetail.payment_id = l1.id AND l1.deleted = 0
            INNER JOIN j_sponsor l2 ON l1.id = l2.payment_id AND l2.deleted = 0
            INNER JOIN contacts l4 ON l4.id = l2.student_id AND l4.deleted = 0
            LEFT JOIN j_loyalty l3 ON l1.id = l3.payment_id AND l3.deleted = 0
            WHERE (j_paymentdetail.id = '{$bean->id}')
            AND (IFNULL(l2.type, '') = 'Loyalty')
            AND ((foc_type <> ''))
            AND j_paymentdetail.deleted = 0";
            $rs_loyal = $GLOBALS['db']->query($q1);
            while($r_loyal = $GLOBALS['db']->fetchByAssoc($rs_loyal)){
                if ($r_loyal['loyalty_points'] > 0 && $r_loyal['count_loyalty'] == 0 ) {
                    //Count Loyalty point
                    $loyalty = new J_Loyalty();
                    $loyalty->point = abs($r_loyal['loyalty_points']);
                    $loyalty->type = 'Reward';
                    $loyalty->student_id = $r_loyal['student_id'];
                    $loyalty->payment_id = $bean->payment_id;
                    $loyalty->paymentdetail_id = $bean->id;
                    $loyalty->team_id = $bean->team_id;
                    $loyalty->team_set_id = $bean->team_id;
                    $loyalty->input_date = $bean->payment_date;
                    $loyalty->description = $r_loyal['description'];
                    $loyalty->save();
                }
            }
        } elseif ($bean->status == 'Cancelled') {
            //delete First
            $GLOBALS['db']->query("UPDATE j_loyalty SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE payment_id='{$bean->payment_id}' AND paymentdetail_id='{$bean->id}' AND deleted=0");
        }
        //END: Loyalty Point

        //Add Commision
        if ($bean->status == 'Paid' && $bean->payment_amount > 0) {
            addCommisson($bean);
        }elseif ($bean->status == 'Cancelled'){
            $GLOBALS['db']->query("UPDATE c_commission SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE pmd_id='{$bean->id}' AND deleted=0");
        }


        //Update remain
        $payment = BeanFactory::getBean('J_Payment', $bean->payment_id);
        if(empty($payment->old_student_id))
            getPaymentRemain($bean->payment_id);
        // update student status
        updateStudentStatus($bean->student_id);

        //Update Sale Type
        if($bean->payment_amount > 0 && !empty($bean->payment_id)){
            if ($bean->status == 'Paid' || $bean->status == 'Unpaid'){
                checkSaleType($bean->payment_id);
            }elseif ($bean->status == 'Cancelled'){
                //Tính lại sale của các payment related
                revokeSaleType($bean->payment_id);
            }
        }



    }

    function changeQuote(&$bean, $event, $arguments){

        if($bean->payment_type == 'Normal') {
            $quote = BeanFactory::getBean('Quotes', $bean->quote_id);
            $bean->parent_id = $quote->parent_id;
            $bean->parent_type = $quote->parent_type;
        }
    }

    function updateQuote(&$bean, $event, $arguments){
        if($bean->payment_type == 'Normal') {
            $quote = BeanFactory::getBean('Quotes', $bean->quote_id);
            $paid = $GLOBALS['db']->getOne("SELECT IFNULL(sum(payment_amount),0) FROM j_paymentdetail WHERE deleted = 0 AND status = 'Paid' AND quote_id ='{$quote->id}'");
            $quote->paid_amount = $paid;
            $quote->save();
            $bean->parent_type = $quote->parent_type;
            $bean->parent_id = $quote->parent_id;

            // phân bổ tiền cho balance trong order
            require_once ('custom/modules/J_Payment/balance_function_untils.php');
            amountAllocation($quote->id);

        }
    }

    function afterDeletePaymentDetail(&$bean, $event, $arguments){
        $quote = BeanFactory::getBean('Quotes',$bean->quote_id);
        $quote->paid_amount = $quote->paid_amount - $bean->payment_amount;
        $quote->save();
    }

    function autoMapValues(&$bean, $event, $arguments){
        $bean->status = 'Paid';
    }

    function createBalance(&$bean, $event, $arguments){
        require_once ('custom/modules/J_Payment/balance_function_untils.php');
        if(!$arguments['isUpdate'] && $bean->payment_type == 'Deposit'){
            createBalances('create','Deposit',$bean,'','');
        }
        else {
            if($arguments['isUpdate'] && $bean->status == 'Cancelled')
                createBalances('delete','Deposit',$bean,'','');
        }
    }
    function textCurrency(&$bean, $event, $arguments){
        $bean->status = 'Paid';
    }

}
?>
