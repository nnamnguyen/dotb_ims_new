<?php
class logicQuotes
{

    function beforeSaveQuotes(&$bean, $event, $arguments)
    {
        $bean->unpaid_amount = $bean->total - $bean->paid_amount;
        if($bean->quote_stage == 'Closed won') {
                if ($bean->paid_amount == 0) {
                    if ($bean->total == 0)
                        $bean->status = 'Completed';
                    else
                        $bean->status = 'UnPaid';
                } else {
                    if ($bean->paid_amount == $bean->total || $bean->total == 0)
                        $bean->status = 'Completed';
                    else
                        $bean->status = 'Part Paid';
                }
        }else{
            $bean->status = 'Quotation';
        }

    }

    function beforeDeleteQuotes($bean, $event, $arguments)
    {
        global $timedate;
        if($bean->parent_type != 'Leads'){
            require_once ('custom/modules/J_Payment/balance_function_untils.php');
            //remove balance from quote
            $list_balance = $GLOBALS['db']->fetchArray("SELECT quotes_j_payment_1j_payment_idb balance_id from quotes_j_payment_1_c Where deleted=0 and quotes_j_payment_1quotes_ida ='{$bean->id}'");
            foreach ($list_balance as $balance){
                voidBalanceFromQuote($bean->id,$balance['balance_id']);
            }
            $sql = "UPDATE j_paymentdetail SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE quote_id='{$bean->id}' AND deleted=0";
            $GLOBALS['db']->query($sql);
            $GLOBALS['db']->query("UPDATE j_payment SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE order_id ='{$bean->id}' AND deleted=0");
            $GLOBALS['db']->query("UPDATE j_discount_quotes_1_c SET deleted=1,date_modified='{$timedate->nowDb()}' WHERE j_discount_quotes_1quotes_idb = '{$bean->id}'");
            $GLOBALS['db']->query("UPDATE j_sponsor SET deleted=1,date_modified='{$timedate->nowDb()}',modified_user_id='{$GLOBALS['current_user']->id}' WHERE quote_id = '{$bean->id}'");
            $GLOBALS['db']->query("UPDATE j_loyalty SET deleted=1,date_modified='{$timedate->nowDb()}',modified_user_id='{$GLOBALS['current_user']->id}' WHERE quote_id = '{$bean->id}'");

            // deleted quote line item
            $GLOBALS['db']->query("UPDATE products SET deleted=1,date_modified='{$timedate->nowDb()}',modified_user_id='{$GLOBALS['current_user']->id}' WHERE quote_id = '{$bean->id}'");
        }
    }

    function addCode($bean, $event, $arguments)
    {
        if(empty($bean->name)) {
            $code_field = 'name';
            $bean->is_installment = $_POST['is_installment'];
            $bean->installment_plan = $_POST['installment_plan'];
            if ($bean->payment_type == 'Transfer Out' || $bean->payment_type == 'Moving Out' || $bean->payment_type == 'Refund') {
                $student = BeanFactory::getBean("Contacts", $bean->contacts_j_payment_1contacts_ida);
                $bean->team_id = $student->team_id;
                $bean->team_set_id = $student->team_id;
            }
            if (empty($bean->fetched_row[$code_field]) || strpos($bean->fetched_row[$code_field], $prefix) === false) {
                //Get Prefix
                $res = $GLOBALS['db']->query("SELECT code_prefix FROM teams WHERE id = '{$bean->team_id}'");
                $row = $GLOBALS['db']->fetchByAssoc($res);
                $prefix = $row['code_prefix'];
                $year = date('y', strtotime('+ 7hours' . (!empty($bean->date_entered) ? $bean->date_entered : $bean->fetched_row['date_entered'])));
                $table = $bean->table_name;
                $sep = '-';
                $first_pad = '0000';
                $padding = 4;
                if ($bean->payment_type == 'Enrollment' || $bean->payment_type == 'Corporate' || $bean->payment_type == 'Deposit' || $bean->payment_type == 'Cashholder' || $bean->payment_type == 'Placement Test' || $bean->payment_type == 'Cambridge' || $bean->payment_type == 'Outing Trip' || $bean->payment_type == 'Product')
                    $ext = 'Q';
                else $ext = 'Q';
                $str_code = $ext.$sep.$year;

                $query = "SELECT $code_field FROM $table WHERE ( $code_field <> '' AND $code_field IS NOT NULL) AND id != '{$bean->id}' AND (LEFT($code_field, " . strlen($str_code) . ") = '" . $str_code . "') ORDER BY RIGHT($code_field, $padding) DESC LIMIT 1";
                $result = $GLOBALS['db']->query($query);

                if ($row = $GLOBALS['db']->fetchByAssoc($result))
                    $last_code = $row[$code_field];
                else
                    //no codes exist, generate default - PREFIX + CURRENT YEAR +  SEPARATOR + FIRST NUM
                    $last_code = $str_code . $first_pad;

                $num = substr($last_code, -$padding, $padding);
                $num++;
                $pads = $padding - strlen($num);
                $new_code = $str_code;

                //preform the lead padding 0
                for ($i = 0; $i < $pads; $i++)
                    $new_code .= "0";
                $new_code .= $num;

                //write to database - Logic: Before Save
                $bean->$code_field = $new_code;
            }
        }
    }

    function currentText($bean, $event, $arguments){
        require_once ('custom/include/ConvertMoneyString/convert_number_to_string.php');
        $int = new Integer();
        $bean->current_text = $int->toText($bean->total);
        $bean->hidden_use_free_balance = $bean->use_free_balance;
        if($bean->use_free_balance > 0){
            $bean->visible_list_balance_panel = false;
        }
        else
            $bean->visible_list_balance_panel = true;
        $sql_balance = "SELECT sum(remain_amount) total_balance_parent 
                        FROM j_payment
                        Where j_payment.deleted =0 AND parent_id = '{$bean->parent_id}' AND payment_type IN ('Moving in','Transfer in','Deposit')";
        $bean->total_balance_parent = $GLOBALS['db']->getOne($sql_balance);
        // get parent name
        $bean->parent_name = BeanFactory::getBean($bean->parent_type,$bean->parent_id)->name;
        $detail = json_decode($bean->quote_discount_detail);
        $bean->discount_detail = $detail->discount;
        $bean->sponsor_detail = $detail->sponsor;
        $bean->loyalty_detail = $detail->loyalty;
    }

    function changeLeadStatus($bean, $event, $arguments){
        require_once ('custom/modules/J_Payment/balance_function_untils.php');
        if($bean->parent_type == 'Leads') {
            $lead = BeanFactory::getBean('Leads', $bean->parent_id);
            if($lead->status != 'Converted') {
                $lead->status = 'Quotation';
                $lead->save();
            }
        }
//        if(($arguments['dataChanges']['parent_type']['before'] == 'Leads' && $arguments['dataChanges']['parent_type']['after'] =='Contacts')||!empty($arguments['dataChanges']['total'])){
//            if($arguments['isUpdate'] && !empty($arguments['dataChanges']['total']))
//                $GLOBALS['db']->query("UPDATE j_payment SET deleted =1, modified_user_id ='{$GLOBALS['current_user']->id}',date_modified ='{$GLOBALS['timedate']->nowDB()}' WHERE order_id='{$bean->id}'");
//            $sql = "SELECT id FROM products WHERE quote_id = '{$bean->id}' AND deleted= 0";
//            $result = $GLOBALS['db']->query($sql);
//            while($row = $GLOBALS['db']->fetchByAssoc($result)){
//                createBalances('create','Cashholder',$bean,$row['id'],$bean);
//            }
//        }
        if(!empty($arguments['dataChanges']['deal_tot_discount_percentage'])){
            $product_list = $GLOBALS['db']->fetchArray("SELECT id FROM products where deleted=0 and quote_id ='{$bean->id}'");
            foreach($product_list as $product){
                createBalances('update','Cashholder',$bean,$product['id'],$bean);
            }
        }
        if((!empty($arguments['dataChanges']['use_free_balance'] || !empty($arguments['dataChanges']['total'])) && $bean->parent_type !='Contacts')){
            amountAllocation($bean->id);
        }
        if(!empty($arguments['dataChanges']['quote_stage'])){
            if($bean->quote_stage== 'Closed won')
                $GLOBALS['db']->query("UPDATE j_payment SET status='Available', modified_user_id ='{$GLOBALS['current_user']->id}',date_modified ='{$GLOBALS['timedate']->nowDB()}' Where deleted =0 AND order_id ='{$bean->id}'");
        }
//
//
//            require_once ('custom/modules/J_Payment/balance_function_untils.php');
//            $list_product = $GLOBALS['db']->fetchArray("SELECT id from products where deleted=0 and quote_id='{$bean->id}'");
//            foreach($list_product as $product) {
//                createBalances('create', 'Cashholder', $bean, $product['id'], $bean);
//            }
//            amountAllocation($bean->id);
//        }
    }

    function createBalance($bean, $event, $arguments){
        if($arguments['relationship'] == 'quote_products'&& ($bean->parent_type == 'Contacts' || $bean->parent_type == 'Accounts')){
            require_once ('custom/modules/J_Payment/balance_function_untils.php');
            createBalances('create','Cashholder',new J_PaymentDetail(),$arguments['related_id'],$bean);
        }
    }

    function useBalance($bean, $event, $arguments){
        if((!$arguments['isUpdate']||!empty($arguments['dataChanges']['use_free_balance']))&& !empty($bean->list_balance)){
            $total_use = $bean->use_free_balance;
            $list_balance = explode(',',$bean->list_balance);
            foreach($list_balance as $balance) {
                $balance_bean = BeanFactory::getBean('J_Balance', $balance);
                if($balance_bean->remain_amount <= $total_use)
                {
                    $total_use = $total_use - $balance_bean->remain_amount;
                    $use_amount = $balance_bean->remain_amount;
                    $balance_bean->remain_amount =0;
                    if ($balance_bean->load_relationship('j_balance_quotes_1'))
                        $balance_bean->j_balance_quotes_1->add($bean->id, array(
                            'use_amount' => $use_amount,
                        ));
                    $balance_bean->save();
                }
                else{
                    $use_amount = $total_use;
                    $balance_bean->remain_amount = $balance_bean->remain_amount - $use_amount;
                    if ($balance_bean->load_relationship('j_balance_quotes_1'))
                        $balance_bean->j_balance_quotes_1->add($bean->id, array(
                            'use_amount' => $use_amount,
                        ));
                    $balance_bean->save();
                    break;
                }
            }
            if(!empty($arguments['dataChanges']['use_free_balance'])) {
                require_once ('custom/modules/J_Payment/balance_function_untils.php');
                amountAllocation($bean->id);
            }
            if($bean->unpaid_amount == 0)
                $bean->status = 'Completed';

        }
    }

    function getBalanceRelate($bean, $event, $arguments){
        if($_REQUEST['view'] =='subpanel-for-j_payment-quotes_j_payment_1'){
            if($bean->load_relationship('quotes_j_payment_1')){
                foreach($bean->quotes_j_payment_1->getBeans() as $relate){
                    if(strpos($_REQUEST['__dotb_url'],$relate->id) != false){
                        $sql = "SELECT use_amount FROM quotes_j_payment_1_c WHERE deleted=0 AND  quotes_j_payment_1quotes_ida='{$bean->id}' AND  quotes_j_payment_1j_payment_idb='{$relate->id}'";
                        $result=$GLOBALS['db']->getOne($sql);
                        $bean->use_balance_from_receipt_amount = $result;
                        break;
                    }
                }
            }
        }
    }

    function createReceipt($bean, $event, $arguments){
        if(!$arguments['isUpdate'] && $bean->status != 'Quotation'){
            $bean->list_receipt = json_decode($bean->list_receipt,true);
            if($bean->number_of_payment !='Monthly-plan'){
                for($i =1; $i <= $bean->number_of_payment;$i++){
                    $receipt = BeanFactory::newBean('J_PaymentDetail');
                    $receipt->quote_id = $bean->id;
                    $receipt->payment_type = "Normal";
                    $receipt->parent_id = $bean->parent_id;
                    $receipt->parent_type = $bean->parent_type;
                    $receipt->payment_amount = $bean->list_receipt['receipt_number_'.$i]['amount'];
                    $receipt->payment_date = $bean->list_receipt['receipt_number_'.$i]['date'];
                    $receipt->status = 'Unpaid';
                    $receipt->assigned_user_id = $GLOBALS['current_user']->id;
                    $receipt->description = 'Thu tiền Hóa đơn '.$bean->name;
                    $receipt->no = $i;
                    $receipt->save();
                }
            }
            else{
                for($i =1; $i <= $bean->num_month_pay;$i++){
                    if($i==1)
                        $month = '+1 second';
                    else if($i == 2)
                        $month = '+1 month';
                    else {
                        $num_month = $i-1;
                        $month = "+{$num_month} months";
                        }
                    $receipt = BeanFactory::newBean('J_PaymentDetail');
                    $receipt->quote_id = $bean->id;
                    $receipt->payment_type = "Normal";
                    $receipt->parent_id = $bean->parent_id;
                    $receipt->parent_type = $bean->parent_type;
                    $receipt->payment_amount = $bean->total/$bean->num_month_pay;
                    $receipt->payment_date = date('Y-m-d',strtotime ( $month , strtotime ( $bean->order_date ) ) );
                    $receipt->status = 'Unpaid';
                    $receipt->assigned_user_id = $GLOBALS['current_user']->id;
                    $receipt->description = 'Thu tiền Hóa đơn '.$bean->name;
                    $receipt->no = $i;
                    $receipt->save();
                }
            }
        }
    }

    function handleDiscount($bean, $event, $arguments){
        $detail = json_decode($bean->quote_discount_detail,true);
        global $timedate;
        // Xóa các sponsor/loyalty cũ
        if($arguments['isUpdate']) {
            $voucher_id = $GLOBALS['db']->getOne("SELECT voucher_id FROM j_sponsor WHERE deleted=0 AND type='Sponsor' AND quote_id = '{$bean->id}'");
            $GLOBALS['db']->query("UPDATE j_voucher SET used_time=used_time-1 WHERE id = '{$voucher_id}'");
            $GLOBALS['db']->query("UPDATE j_discount_quotes_1_c SET deleted=1,date_modified='{$timedate->nowDb()}' WHERE j_discount_quotes_1quotes_idb = '{$bean->id}'");
            $GLOBALS['db']->query("UPDATE j_sponsor SET deleted=1,date_modified='{$timedate->nowDb()}',modified_user_id='{$GLOBALS['current_user']->id}' WHERE quote_id = '{$bean->id}'");
            $GLOBALS['db']->query("UPDATE j_loyalty SET deleted=1,date_modified='{$timedate->nowDb()}',modified_user_id='{$GLOBALS['current_user']->id}' WHERE quote_id = '{$bean->id}'");
        }

        $bean->load_relationship('j_discount_quotes_1');
        // add discount;
        foreach($detail['discount'] as $value){
            $bean->j_discount_quotes_1->add($value['id']);
            $spon = new J_Sponsor();
            $spon->name             = $value['name'];
            $spon->quote_id         = $bean->id;
            $spon->discount_id      = $value['id'];
            $spon->amount           = $value['amount'];
            $spon->percent          = $value['percent'];
            $spon->total_down       = $value['total'];
            $spon->type             = 'Discount';
            $spon->team_id          = $bean->team_id;
            $spon->team_set_id      = $bean->team_id;
            $spon->save();
        }
        //Create Sponsor
        foreach($detail['sponsor'] as  $value){
            $spon = new J_Sponsor();
            $spon->name             = $value['name'];
            $spon->quote_id       = $bean->id;
            $spon->voucher_id       = $value['id'];

            $GLOBALS['db']->query("UPDATE j_voucher SET used_time=used_time+1 WHERE id = '{$spon->voucher_id}'");

            $spon->student_id       = $bean->parent_id;

            $spon->sponsor_number   = $value['sponsor_number'];
            $spon->amount           = $value['amount'];
            $spon->percent          = $value['percent'];
            $spon->total_down       = $value['total'];
            $spon->foc_type         = $value['foc_type'];
            $spon->type             = 'Sponsor';
            $spon->description      = $value['description'];
            $spon->team_id          = $bean->team_id;
            $spon->team_set_id      = $bean->team_id;
            if(unformat_number($value['total_down']) > 0 || !empty($spon->voucher_id))
                $spon->save();

        }

        //Add Relationship Payment - Loyalty
        $loyalty_detail = $detail['loyalty'][0];
        $loyalty = new J_Loyalty();
        $loyalty->point          = $loyalty_detail['loyalty_point'];
        $loyalty->discount_amount= $loyalty_detail['loyalty_amount'];
        $loyalty->rate_in_out   = $GLOBALS['app_list_strings']['default_loyalty_rate']['Conversion Rate'];
        $loyalty->type          = 'Redemption';
        $loyalty->parent_id    = $bean->parent_id;
        $loyalty->parent_type    = $bean->parent_type;
        $loyalty->quote_id    = $bean->id;
        $loyalty->target_id     = $loyalty_detail['rate_id'];;
        $loyalty->team_id       = $bean->team_id;
        $loyalty->team_set_id   = $bean->team_id;
        $loyalty->input_date    = $bean->order_date;
        $loyalty->description   = 'Redemption Payments.';
        if($loyalty->point > 0 &&   $loyalty->discount_amount> 0)
            $loyalty->save();
    }

    function addSponsorLoyalty($bean, $event, $arguments){
        $name = $GLOBALS['db']->getOne("SELECT name FROM j_loyalty WHERE deleted=0 and quote_id='{$bean->id}'");
        $detail = json_decode($bean->quote_discount_detail,true);
        $loyalty_detail = $detail['loyalty'][0];

        $spon = new J_Sponsor();
        $spon->name             = $name;
        $spon->quote_id           = $bean->id;
        $spon->amount           = $loyalty_detail['loyalty_amount'];
        $spon->total_down       = $loyalty_detail['loyalty_amount'];
        $spon->type             = 'Loyalty';
        $spon->team_id          = $bean->team_id;
        $spon->team_set_id      = $bean->team_id;
        $spon->loyalty_points   = $loyalty_detail['loyalty_point'];
        if($spon->loyalty_points> 0)
            $spon->save();
    }
}
?>
