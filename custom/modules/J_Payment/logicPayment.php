<?php
class logicPayment{
    function after_delete_payment(&$bean, $event, $arguments){
        //Update status
        if(!empty($bean->contacts_j_payment_1contacts_ida)){
            //update student remain
            updateStudentRemain($bean->contacts_j_payment_1contacts_ida);
            //Update student status
            updateStudentStatus($bean->contacts_j_payment_1contacts_ida);
        }
    }

    //Before delete
    function deletedPayment(&$bean, $event, $arguments){
        require_once("custom/include/_helper/junior_revenue_utils.php");
        require_once("custom/include/_helper/junior_class_utils.php");
        global $current_user, $timedate;
        if(empty($bean->payment_type) || empty($bean->id)){
            echo '
            <script type="text/javascript">
            alert(" Something Wrong, Please, try again !!");
            location.href=\'index.php?module=J_Payment&action=DetailView&record='.$bean->id.'\';
            </script>';
            die();
        }

        if ($event == "before_delete"){
            $sqlPayDtl = "SELECT DISTINCT
            IFNULL(id, '') id,
            IFNULL(payment_no, '') payment_no,
            IFNULL(status, '') status,
            IFNULL(payment_amount, '0') payment_amount
            FROM j_paymentdetail
            WHERE payment_id = '{$bean->id}'
            AND deleted = 0
            AND status <> 'Cancelled' AND payment_amount > 0
            ORDER BY payment_no";
            $resultPayDtl = $GLOBALS['db']->query($sqlPayDtl);
            $countVAT       = 0;
            while($rowPayDtl = $GLOBALS['db']->fetchByAssoc($resultPayDtl)){
                if($rowPayDtl['status'] == 'Paid') $countVAT++;
            }
            $countUsed = $GLOBALS['db']->getOne("SELECT count(id) count FROM j_payment_j_payment_1_c WHERE j_payment_j_payment_1j_payment_idb = '{$bean->id}' AND deleted = 0");
            $arr_Undel = array('Delay', 'Schedule Change', 'Transfer In', 'Transfer Out', 'Moving In', 'Moving Out', 'Refund', 'Product', 'Corporate');
            if( $current_user->isAdmin() || (!in_array($bean->payment_type, $arr_Undel) && ($countVAT == 0) && ($countUsed == 0)) ){
                $resultPayDtl = $GLOBALS['db']->query($sqlPayDtl);
                while($rowPayDtl = $GLOBALS['db']->fetchByAssoc($resultPayDtl)){
                    $sql = "UPDATE j_paymentdetail SET deleted = 1, date_modified='{$timedate->nowDb()}', modified_user_id='{$current_user->id}' WHERE id = '{$rowPayDtl['id']}'";
                    $GLOBALS['db']->query($sql);
                }
                //Delete Invoice
                $j_invID  = $GLOBALS['db']->getOne("SELECT IFNULL(id, '') id FROM j_invoice WHERE payment_id='{$bean->id}' AND deleted = 0");
                if(!empty($j_invID)){
                    $j_inv = BeanFactory::getBean('J_Invoice', $j_invID);
                    $j_inv->deleted = 1;
                    $j_inv->save();
                }
            }else{
                echo '
                <script type="text/javascript">
                alert("This transaction was completed and invoiced. You can not delete !");
                location.href=\'index.php?module=J_Payment&action=DetailView&record='.$bean->id.'\';
                </script>';
                die();
            }
        }

        if($bean->payment_type == 'Enrollment' || $bean->payment_type == 'Cashholder' || $bean->payment_type == 'Moving Out ' || $bean->payment_type == 'Transfer Out '){

            if($bean->payment_type == 'Enrollment'){
                // Remove Student from "Enrolled" Situation
                $q1 = "SELECT DISTINCT id FROM j_studentsituations WHERE payment_id='{$bean->id}' AND deleted = 0";
                $rs1 = $GLOBALS['db']->query($q1);
                while($rowo = $GLOBALS['db']->fetchByAssoc($rs1)){
                    $GLOBALS['db']->query("UPDATE j_studentsituations SET deleted = 1, date_modified='{$timedate->nowDb()}', modified_user_id='{$current_user->id}' WHERE id='{$rowo['id']}'");
                    removeJunFromSession($rowo['id']);
                }
            }

            // Remove Course Fee 2
            $GLOBALS['db']->query("UPDATE j_coursefee_j_payment_2_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_coursefee_j_payment_2j_payment_idb='{$bean->id}'");


            // Remove Discount
            $GLOBALS['db']->query("UPDATE j_payment_j_discount_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_payment_j_discount_1j_payment_ida = '{$bean->id}'");

            // Remove partnership
            $GLOBALS['db']->query("UPDATE j_partnership_j_payment_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_partnership_j_payment_1j_payment_idb = '{$bean->id}'");

            //            // Remove payment book/gift
            //            if($bean->load_relationship('j_payment_j_payment_2')){
            //                $books = $bean->j_payment_j_payment_2->getBeans();
            //                foreach($books as $book_id => $pay_book){
            //                    $pay_book->deleted = 1;
            //                    $pay_book->save();
            //                }
            //            }

            // Restore payments
            $payment_list_json = $GLOBALS['db']->getOne("SELECT payment_list FROM j_payment WHERE id = '{$bean->id}'");
            $old_payments = json_decode(html_entity_decode($payment_list_json),true);
            foreach($old_payments["paid_list"] as $pay_id => $value){
                $rs_rm = $GLOBALS['db']->query("SELECT
                    used_amount,
                    used_hours,
                    remain_amount,
                    remain_hours,
                    payment_date
                    FROM
                    j_payment
                    WHERE id = '$pay_id' AND deleted = 0");
                $row_rm         = $GLOBALS['db']->fetchByAssoc($rs_rm);
                if(!empty($row_rm)){
                    $used_amount    = $row_rm['used_amount'] - $value["used_amount"];
                    $used_hours     = $row_rm['used_hours'] - $value["used_hours"];
                    $remain_amount  = $row_rm['remain_amount'] + $value["used_amount"];
                    $remain_hours   = $row_rm['remain_hours'] + $value["used_hours"];

                    if($remain_amount < 2000)  $remain_amount = 0;
                    if($remain_hours < '0.1')  $remain_hours = 0;

                    $GLOBALS['db']->query("UPDATE j_payment
                        SET
                        used_amount = $used_amount,
                        used_hours = $used_hours,
                        remain_amount = $remain_amount,
                        remain_hours = $remain_hours
                        WHERE id = '$pay_id'");
                }
            }

            foreach($old_payments["deposit_list"] as $pay_id => $value){
                $rs_rm = $GLOBALS['db']->query("SELECT
                    used_amount,
                    remain_amount,
                    payment_date
                    FROM
                    j_payment
                    WHERE id = '$pay_id' AND deleted = 0");
                $row_rm         = $GLOBALS['db']->fetchByAssoc($rs_rm);
                if(!empty($row_rm)){
                    $used_amount    = $row_rm['used_amount'] - $value["used_amount"];
                    $remain_amount  = $row_rm['remain_amount'] + $value["used_amount"];
                    if($remain_amount < 2000)  $remain_amount = 0;


                    $GLOBALS['db']->query("UPDATE j_payment
                        SET
                        used_amount = $used_amount,
                        remain_amount = $remain_amount
                        WHERE
                        id = '$pay_id'");
                }
            }
            //revote new sale
            revokeSaleType($bean->id);
            // Remove Payments
            removeRelatedPayment($bean->id);

        }
        elseif($bean->payment_type == 'Cashholder' || $bean->payment_type == 'Deposit'){
            // Remove Discount
            $GLOBALS['db']->query("UPDATE j_payment_j_discount_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_payment_j_discount_1j_payment_ida = '{$bean->id}'");
            // Remove partnership
            $GLOBALS['db']->query("UPDATE j_partnership_j_payment_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_partnership_j_payment_1j_payment_idb = '{$bean->id}'");
        }elseif($bean->payment_type == 'Delay'){
            $GLOBALS['db']->query("UPDATE j_studentsituations SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE payment_id='{$bean->id}'");
        }
        if($bean->payment_type == 'Product'){
            $bean->kind_of_course = '';
            $q101 = "SELECT DISTINCT
            IFNULL(l1.id, '') l1_id, IFNULL(l1.name, '') l1_name
            FROM
            j_payment
            INNER JOIN
            j_payment_j_inventory_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_inventory_1j_payment_ida
            AND l1_1.deleted = 0
            INNER JOIN
            j_inventory l1 ON l1.id = l1_1.j_payment_j_inventory_1j_inventory_idb
            AND l1.deleted = 0
            WHERE
            (((j_payment.id = '{$bean->id}')))
            AND j_payment.deleted = 0";
            $rs101 = $GLOBALS['db']->query($q101);
            while($row101 = $GLOBALS['db']->fetchByAssoc($rs101)){
                $GLOBALS['db']->query("UPDATE j_inventorydetail SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE inventory_id = '{$row101['l1_id']}'");
                $GLOBALS['db']->query("UPDATE j_payment_j_inventory_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_payment_j_inventory_1j_inventory_idb = '{$row101['l1_id']}'");
                $GLOBALS['db']->query("UPDATE j_inventory SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE id = '{$row101['l1_id']}'");
            }
        }

        // Remove Receipt
        if(($event == 'before_save') && ($_POST['module'] == $bean->module_name) && ($_POST['action'] == 'Save')){
            $GLOBALS['db']->query("UPDATE j_paymentdetail SET deleted=1, date_modified='{$timedate->nowDb()}' WHERE payment_id='{$bean->id}' AND status <> 'Cancelled' AND deleted=0");
            //Delete Invoice
            $j_invID  = $GLOBALS['db']->getOne("SELECT IFNULL(id, '') id FROM j_invoice WHERE payment_id='{$bean->id}' AND deleted = 0");
            if(!empty($j_invID)){
                $j_inv = BeanFactory::getBean('J_Invoice', $j_invID);
                $j_inv->deleted = 1;
                $j_inv->save();
            }
        }

        $GLOBALS['db']->query("UPDATE j_sponsor SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE payment_id = '{$bean->id}' AND deleted = 0");
        $GLOBALS['db']->query("UPDATE j_loyalty SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE payment_id = '{$bean->id}' AND deleted = 0");
        $GLOBALS['db']->query("UPDATE c_commission SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE payment_id = '{$bean->id}' AND deleted = 0");

        // Remove Revenue Drop
        $GLOBALS['db']->query("UPDATE c_deliveryrevenue SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE ju_payment_id = '{$bean->id}' AND deleted = 0 AND passed = 0");
    }
    //before save
    function handleBeforeSave($bean, $event, $arguments) {
        if(($_POST['module'] == $bean->module_name && $_POST['action'] == 'Save') || ($_REQUEST['module'] == 'J_Class' && $_REQUEST['push_action'] == 'ajaxEnrolledStudents')||$_POST['module'] == 'Quotes' || $_POST['module'] == 'J_PaymentDetail'){
            if(empty($bean->payment_type)){
                if(!empty($bean->contacts_j_payment_1contacts_ida)){
                    echo '
                    <script type="text/javascript">
                    alert(" Something Wrong, Please, try again !!");
                    location.href=\'index.php?module=Contacts&action=DetailView&record='.$bean->contacts_j_payment_1contacts_ida.'\';
                    </script>';
                }else{
                    echo '
                    <script type="text/javascript">
                    alert(" Something Wrong, Please, try again !!");
                    location.href=\'index.php?module=Home&action=index\';
                    </script>';
                }
                die();
            }
            require_once('custom/include/_helper/junior_class_utils.php');
            require_once("custom/include/_helper/junior_revenue_utils.php");

            global $timedate, $app_list_strings, $current_user;

            //Delete relationship before edit
            if(!empty($bean->fetched_row)) logicPayment::deletedPayment($bean, $event, $arguments);

            if($bean->payment_type == 'Enrollment' || ($bean->payment_type == 'Cashholder')){
                //Add Relationship Course Fee
                $arrCf = $bean->j_coursefee_j_payment_1j_coursefee_ida;

                if($bean->load_relationship('j_coursefee_j_payment_1'))
                    $bean->j_coursefee_j_payment_1->add($arrCf[0]);

                if($bean->load_relationship('j_coursefee_j_payment_2'))
                    $bean->j_coursefee_j_payment_2->add($arrCf);


                $student = BeanFactory::getBean('Contacts',$bean->contacts_j_payment_1contacts_ida);

                //Check tiền có nằm đúng center của Class hay Payment hay ko
                if(!empty($bean->payment_list)){
                    $json_payment = json_decode(html_entity_decode($bean->payment_list),true);
                    $paymentUsedIds = array();
                    foreach($json_payment["paid_list"] as $pay_id => $value)
                        $paymentUsedIds[] = $pay_id;
                    foreach($json_payment["deposit_list"] as $pay_id => $value)
                        $paymentUsedIds[] = $pay_id;
                    if(!empty($paymentUsedIds)){
                        $resTea = $GLOBALS['db']->query("SELECT DISTINCT team_id FROM j_payment WHERE id IN ('".implode("','",$paymentUsedIds)."')");
                        while($rowt = $GLOBALS['db']->fetchByAssoc($resTea)){
                            if($rowt['team_id'] != $bean->team_id){
                                echo '<script type="text/javascript">
                                alert(" Something Wrong, Please check the Class or Payment using does not match the center of it!!");
                                location.href=\'index.php?module=Contacts&action=DetailView&record='.$bean->contacts_j_payment_1contacts_ida.'\';
                                </script>';
                                die();
                            }
                        }
                    }
                }

                if($bean->payment_type == 'Enrollment'){
                    $classInfoArray = json_decode(html_entity_decode($bean->content),true);
                    //Check Duplicate in Class và die
                    foreach ($classInfoArray as $class_id => $class){
                        if(is_exist_in_class($student->id, $_POST['start_study'], $_POST['end_study'], $class_id, "'Enrolled', 'Moving In'")){
                            $class_name = $GLOBALS['db']->getOne("SELECT name FROM j_class WHERE id = '$class_id'");
                            dotb_die("<b>An error occurred while saving. This student is already exist in class <a href='#bwc/index.php?module=J_Class&action=DetailView&record={$class_id}'>$class_name</a> from {$_POST['start_study']} to {$_POST['end_study']}. Please check the link or <a href='#bwc/index.php?module=J_Payment&action=EditView&return_module=J_Payment&return_action=DetailView&payment_type=Enrollment&student_id={$student->id}'>click here to enroll again !</a></b>");
                        }
                    }
                    $bean->number_class = count($classInfoArray);
                    if(!empty($_REQUEST['settle_date']))
                        addToClass($bean,$_REQUEST['settle_date']);
                    else
                        addToClass($bean);
                }
                if($bean->payment_type == 'Cashholder'){
                    $bean->tuition_fee      = $bean->amount_bef_discount;

                    //Calculate Payment Expire
                    $bean->payment_expired = date('Y-m-d',strtotime("+12 months ".$bean->payment_date));

                }

                //Add Relationship Payment - Payment, save used payments
                if(!empty($bean->payment_list)){
                    $json_payment = json_decode(html_entity_decode($bean->payment_list),true);
                    foreach($json_payment["paid_list"] as $pay_id => $value){
                        $rs_rm = $GLOBALS['db']->query("SELECT
                            used_amount,
                            used_hours,
                            remain_amount,
                            remain_hours,
                            payment_type,
                            delay_situation_id,
                            payment_date
                            FROM
                            j_payment
                            WHERE id = '$pay_id' AND deleted = 0");
                        $row_rm         = $GLOBALS['db']->fetchByAssoc($rs_rm);

                        if($row_rm['payment_type'] = 'Delay')
                            $bean->delay_situation_id =  $row_rm['delay_situation_id'];

                        $used_amount    = $row_rm['used_amount'] + $value["used_amount"];
                        $used_hours     = $row_rm['used_hours'] + $value["used_hours"];
                        $remain_amount  = $row_rm['remain_amount'] - $value["used_amount"];
                        $remain_hours   = $row_rm['remain_hours'] - $value["used_hours"];


                        $GLOBALS['db']->query("UPDATE j_payment
                            SET
                            used_amount = $used_amount,
                            used_hours = $used_hours,
                            remain_amount = $remain_amount,
                            remain_hours = $remain_hours
                            WHERE
                            id = '$pay_id'");

                        addRelatedPayment($bean->id, $pay_id, $value["used_amount"], $value["used_hours"]);
                    }
                    foreach($json_payment["deposit_list"] as $pay_id => $value){
                        $rs_rm = $GLOBALS['db']->query("SELECT
                            used_amount,
                            remain_amount,
                            payment_type,
                            delay_situation_id,
                            payment_date
                            FROM
                            j_payment
                            WHERE id = '$pay_id' AND deleted = 0");
                        $row_rm         = $GLOBALS['db']->fetchByAssoc($rs_rm);

                        if($row_rm['payment_type'] = 'Delay')
                            $bean->delay_situation_id =  $row_rm['delay_situation_id'];

                        $used_amount    = $row_rm['used_amount'] + $value["used_amount"];
                        $remain_amount  = $row_rm['remain_amount'] - $value["used_amount"];


                        $GLOBALS['db']->query("UPDATE j_payment
                            SET
                            used_amount = $used_amount,
                            remain_amount = $remain_amount
                            WHERE id = '$pay_id'");
                        addRelatedPayment($bean->id, $pay_id, $value["used_amount"], 0);
                    }

                }

                //Calculate Payment Expire
                $bean->payment_expired = date('Y-m-d',strtotime("+12 months ".$bean->end_study));
            }
            elseif($bean->payment_type == 'Deposit'){
                if($bean->parent_type == "Leads"){
                    $bean->lead_id = $bean->contacts_j_payment_1contacts_ida;
                    //Update Status Lead ==> Deposit
                    $lead = BeanFactory::getBean('Leads', $bean->lead_id);
                    $lead->status = 'Deposit';
                    $lead->save();
                }

                $bean->use_type         = 'Amount';
                $bean->start_study      = '';
                $bean->end_study        = '';

                //Calculate Payment Expire
                $bean->payment_expired = date('Y-m-d',strtotime("+12 months ".$bean->payment_date));

                $bean->tuition_fee              = $bean->payment_amount;
                $bean->amount_bef_discount      = $bean->payment_amount;
                $bean->total_after_discount     = $bean->payment_amount;
            }elseif($bean->payment_type == 'Placement Test' || $bean->payment_type == 'Delay Fee' || $bean->payment_type == 'Other' || $bean->payment_type == 'Transfer Fee' || $bean->payment_type == 'Tutor Package' || $bean->payment_type == 'Travelling Fee' ){
                $bean->kind_of_course = '';
                $bean->amount_bef_discount      = $bean->payment_amount;
                $bean->total_after_discount     = $bean->payment_amount;
                $bean->payment_expired = $bean->payment_date;
                if($bean->parent_type == "Leads")
                    $bean->lead_id = $bean->contacts_j_payment_1contacts_ida;


                //Vào doanh thu luôn
                ///****
                $delivery = new C_DeliveryRevenue();
                $delivery->name = 'Drop revenue from payment '.$bean->name;
                $delivery->student_id = $bean->contacts_j_payment_1contacts_ida;
                //Get Payment ID
                $delivery->ju_payment_id = $bean->id;
                $delivery->type = 'Junior';
                $delivery->amount = $bean->payment_amount;
                $delivery->duration = 0;
                $delivery->date_input = $bean->payment_expired;
                $delivery->session_id = '1';
                $delivery->passed = 0;
                $delivery->description = ' Dropped Revenue. Payment '.$bean->name.' expired at '.$timedate->to_display_date($bean->payment_expired,false);
                $delivery->team_id = $bean->team_id;
                $delivery->team_set_id = $bean->team_id;
                $delivery->cost_per_hour = 0;
                $delivery->assigned_user_id = $bean->assigned_user_id;
                $delivery->revenue_type = 'Enrolled';
                $delivery->save();  ///#####
            }
            elseif($bean->payment_type == 'Transfer Out') {
                // Load target student
                $target_student = BeanFactory::getBean("Contacts", $_POST["transfer_to_student_id"]);
                // Set some field in transfers out payment
                $ttotal_hour = 0;
                $bean->payment_date = $timedate->convertToDBDate($_POST["moving_tran_out_date"],false);
                // Save relationship to old payments
                $paymentList = json_decode(html_entity_decode($_POST["json_payment_list"]),true);
                foreach($paymentList as $pay_id => $value){

                    $relatedPayment = BeanFactory::getBean('J_Payment',$pay_id);
                    if($used_payment->payment_type = 'Delay'){
                        $bean->delay_situation_id = $relatedPayment->delay_situation_id;
                    }
                    $pay_amount     = unformat_number(format_number($relatedPayment->remain_amount));
                    $total_hours    = unformat_number(format_number($relatedPayment->remain_hours,2,2));
                    $ttotal_hour += $total_hours;
                    //Link payment Corporate
                    $bean->contract_id  = $relatedPayment->contract_id;

                    $bean->team_id      = $relatedPayment->team_id;
                    $bean->team_set_id  = $relatedPayment->team_id;
                    $GLOBALS['db']->query("UPDATE j_payment
                        SET
                        used_amount = used_amount + $pay_amount,
                        used_hours = used_hours + $total_hours,
                        remain_amount =remain_amount - $pay_amount,
                        remain_hours = remain_hours - $total_hours
                        WHERE id = '$pay_id'");
                    addRelatedPayment($bean->id, $pay_id, $pay_amount, $total_hours);
                }
                // Create tranfer in payment
                $pay_in                     = BeanFactory::newBean("J_Payment");
                //Set Use_type
                $bean->total_hours      = $ttotal_hour;
                if($bean->total_hours > 0){
                    $bean->use_type = 'Hour';
                    $pay_in->remain_hours = $bean->total_hours;
                }else{
                    $bean->use_type = 'Amount';
                    $pay_in->remain_hours = 0 ;
                }
                $bean->tuition_hours    = $bean->total_hours;
                $pay_in->payment_type       = 'Transfer In';
                $pay_in->payment_amount     = $bean->payment_amount;
                $pay_in->remain_amount      = $bean->payment_amount;
                $pay_in->use_type           = $bean->use_type;
                $pay_in->description        = $bean->description;
                $pay_in->contract_id        = $bean->contract_id;
                $pay_in->total_hours        = $bean->total_hours;
                $pay_in->payment_date       = $_POST["moving_tran_in_date"];
                $pay_in->assigned_user_id     = $target_student->assigned_user_id;
                $pay_in->team_id             = $target_student->team_id;
                $pay_in->team_set_id         = $target_student->team_id;
                $pay_in->payment_out_id     = $bean->id;
                $pay_in->contacts_j_payment_1contacts_ida = $target_student->id;
                //Calculate Payment Expire
                $pay_in->payment_expired = $timedate->to_display_date(date('Y-m-d',strtotime("+12 months ".$timedate->convertToDBDate($pay_in->payment_date))),false);
                $pay_in->start_study      = '';
                $pay_in->end_study        = '';
                $pay_in->save();
                //add related
                addRelatedPayment($pay_in->id, $pay_in->payment_out_id, $pay_in->remain_amount, $pay_in->tuition_hours);

                //Moving From Center
                $bean->move_from_center_id  = $bean->team_id;
                // To Center
                $bean->move_to_center_id = $target_student->team_id;

                $bean->start_study      = '';
                $bean->end_study        = '';
                $bean->remain_hours     = 0;
            }
            elseif($bean->payment_type == 'Moving Out') {
                // Change team id for student
                $student = BeanFactory::getBean("Contacts", $_POST["contacts_j_payment_1contacts_ida"]);
                $ttotal_hour = 0;
                $student->load_relationship("teams");
                $student->teams->add($bean->move_to_center_id);
                $student->team_id = $bean->move_to_center_id;
                $student->save();
                // Set some field in moving out payment
                $bean->payment_type = 'Moving Out';
                $bean->payment_date = $timedate->convertToDBDate($_POST["moving_tran_out_date"],false);
                // Save relationship to old payments
                $paymentList = json_decode(html_entity_decode($_POST["json_payment_list"]),true);
                foreach($paymentList as $pay_id => $value){

                    $relatedPayment = BeanFactory::getBean('J_Payment',$pay_id);
                    if($used_payment->payment_type = 'Delay')
                        $bean->delay_situation_id = $relatedPayment->delay_situation_id;

                    $pay_amount     = unformat_number(format_number($relatedPayment->remain_amount));
                    $total_hours    = unformat_number(format_number($relatedPayment->remain_hours,2,2));
                    $ttotal_hour += $total_hours;
                    $bean->team_id      = $relatedPayment->team_id;
                    $bean->team_set_id  = $relatedPayment->team_id;

                    //Link payment Corporate
                    $bean->contract_id  = $relatedPayment->contract_id;

                    $GLOBALS['db']->query("UPDATE j_payment
                        SET
                        used_amount = used_amount + $pay_amount,
                        used_hours = used_hours + $total_hours,
                        remain_amount =remain_amount - $pay_amount,
                        remain_hours = remain_hours - $total_hours
                        WHERE
                        id = '$pay_id'");
                    addRelatedPayment($bean->id, $pay_id, $pay_amount, $total_hours);
                }
                // Create moving in payment
                $pay_in = BeanFactory::newBean("J_Payment");
                //Set Use_type
                $bean->total_hours      = $ttotal_hour;
                if($bean->total_hours > 0){
                    $bean->use_type = 'Hour';
                    $pay_in->remain_hours = $bean->total_hours;
                }else{
                    $bean->use_type = 'Amount';
                    $pay_in->remain_hours = 0 ;
                }

                $bean->tuition_hours    = $bean->total_hours;


                $pay_in->payment_type         = 'Moving In';
                $pay_in->tuition_hours         = $bean->total_hours;
                $pay_in->payment_amount        = $bean->payment_amount;
                $pay_in->remain_amount         = $bean->payment_amount;
                $pay_in->use_type           = $bean->use_type;
                $pay_in->description        = $bean->description;
                $pay_in->contract_id         = $bean->contract_id;
                $pay_in->payment_date         = $_POST["moving_tran_in_date"];
                $pay_in->assigned_user_id     = $bean->assigned_user_id;
                $pay_in->team_id             = $bean->move_to_center_id;
                $pay_in->team_set_id         = $bean->move_to_center_id;
                $pay_in->contacts_j_payment_1contacts_ida = $student->id;
                $pay_in->payment_out_id     = $bean->id;
                //Moving From Center
                $bean->move_from_center_id  = $bean->team_id;
                // To Student
                $bean->transfer_to_student_id = $student->id;

                //Calculate Payment Expire
                $pay_in->payment_expired     = $timedate->to_display_date(date('Y-m-d',strtotime("+12 months ".$timedate->convertToDBDate($pay_in->payment_date))),false);
                $pay_in->start_study      = '';
                $pay_in->end_study        = '';
                $pay_in->save();
                //add related
                addRelatedPayment($pay_in->id, $pay_in->payment_out_id, $pay_in->remain_amount, $pay_in->tuition_hours);

                $bean->start_study      = '';
                $bean->end_study        = '';
                $bean->remain_hours     = 0;
            }
            elseif($bean->payment_type == 'Refund') {
                // Load bean of student
                $student = BeanFactory::getBean("Contacts", $_POST["contacts_j_payment_1contacts_ida"]);

                $bean->payment_date     = $timedate->convertToDBDate($_POST["moving_tran_out_date"],false);
                $bean->used_hours         = $bean->total_hours;
                $bean->used_amount         = $bean->payment_amount + $bean->refund_revenue;
                $bean->total_after_discount = $bean->refund_revenue + $bean->payment_amount; // Total Amount
                $bean->start_study      = '';
                $bean->end_study        = '';
                $bean->remain_hours     = 0;
                // Save relationship to old payments
                $old_payments = json_decode(html_entity_decode($_POST["json_payment_list"]),true);
                $refundHours = 0;
                foreach($old_payments as $pay_id => $value){
                    $old_payment = BeanFactory::getBean('J_Payment',$pay_id);
                    if($used_payment->payment_type = 'Delay')
                        $bean->delay_situation_id = $old_payment->delay_situation_id;

                    $rate_reduce    = round($old_payment->remain_amount / ($bean->payment_amount + $bean->refund_revenue),2);
                    $pay_amount     = unformat_number(format_number($old_payment->remain_amount));
                    $total_hours    = $pay_amount / (($old_payment->remain_amount) / ($old_payment->remain_hours));


                    if(empty($total_hours)) $total_hours = 0;
                    $refundHours += $value["used_hours"];

                    $bean->use_type = "Amount";
                    $bean->team_id      = $old_payment->team_id;
                    $bean->team_set_id  = $old_payment->team_id;

                    //Link payment Corporate
                    $bean->contract_id  = $old_payment->contract_id;

                    $GLOBALS['db']->query("UPDATE j_payment
                        SET
                        used_amount = used_amount + $pay_amount,
                        used_hours = used_hours + $total_hours,
                        remain_amount =remain_amount - $pay_amount,
                        remain_hours = remain_hours - $total_hours
                        WHERE
                        id = '{$pay_id}'
                        ");
                    //Cal amount / hour related payment
                    $payrel_amount = ($pay_amount - ($bean->refund_revenue * $rate_reduce) );
                    $payrel_hours  = ($payrel_amount/ ($pay_amount/$total_hours));
                    addRelatedPayment($bean->id, $pay_id, $payrel_amount , $payrel_hours);
                    $payment_drop_id = $pay_id;


                    //Drop revenue
                    $delivery = new C_DeliveryRevenue();
                    $delivery->name = 'Drop revenue from payment refund '.$bean->name;
                    $delivery->student_id = $student->id;
                    //Get Payment ID
                    $delivery->ju_payment_id = $payment_drop_id;
                    $delivery->type = 'Junior';
                    $delivery->amount = format_number($bean->refund_revenue * $rate_reduce,2,2);
                    $delivery->date_input = $timedate->convertToDBDate($_POST["moving_tran_out_date"],false);
                    $delivery->cost_per_hour = 0;
                    $delivery->session_id = '1';
                    $delivery->passed = 0;
                    $delivery->team_id = $bean->team_id;
                    $delivery->team_set_id = $bean->team_set_id;

                    //Refund Casholder
                    if ($refundHours > 0)  {
                        $revenueHours = ($bean->refund_revenue * $rate_reduce) / ($pay_amount/$total_hours);
                        $unit_price = format_number($pay_amount/$total_hours);
                        $delivery->duration = format_number($revenueHours,2,2);
                        $delivery->cost_per_hour = $unit_price;
                    }

                    $delivery->assigned_user_id = $current_user->id;
                    $delivery->created_by = '1';
                    $delivery->modified_user_id = '1';
                    $delivery->revenue_type = 'Enrolled';

                    if($delivery->amount > 0)
                        $delivery->save();
                }
            }
            elseif($bean->payment_type == 'Product'){
                $bean->used_amount = 0;
                $bean->used_hours = 0;


                $student = BeanFactory::getBean('Contacts',$bean->contacts_j_payment_1contacts_ida);
                $inventory = BeanFactory::newBean("J_Inventory");
                $inventory->id = create_guid();
                $inventory->new_with_id = true;

                // ..and create new Inventory
                //$inventory->name        = $bean->name;
                $inventory->status      = "Confirmed";
                $inventory->date_create = $bean->payment_date;
                $inventory->type        = "Expense";
                $inventory->description = $bean->description;


                $inventory->team_id         = $bean->team_id;
                $inventory->team_set_id     = $bean->team_id;
                $inventory->assigned_user_id= $bean->assigned_user_id;
                $inventory->total_amount    = $bean->total_after_discount;

                $inventory_total_quantity = 0;
                // First element is null
                for ($i = 1; $i < count($_POST["book_id"]); $i++) {
                    $bookId         = $_POST["book_id"][$i];
                    $bookQuantity   = $_POST["book_quantity"][$i];
                    $bookPrice      = unformat_number($_POST["book_price"][$i]);
                    $bookAmount     = unformat_number($_POST['book_amount'][$i]);
                    if ($bookId != ""){
                        // Create Inventory Detail
                        $inventoryDetail = BeanFactory::newBean("J_Inventorydetail");
                        $inventoryDetail->book_id       = $bookId;
                        $inventoryDetail->inventory_id  = $inventory->id;
                        $inventoryDetail->quantity      = -1 * abs($bookQuantity);
                        $inventoryDetail->price         = $bookPrice;
                        $inventoryDetail->amount        = $bookAmount;
                        $inventoryDetail->team_id       = $inventory->team_id;
                        $inventoryDetail->team_set_id   = $inventory->team_set_id;
                        $inventoryDetail->assigned_user_id = $inventory->assigned_user_id;
                        $inventory_total_quantity += $inventoryDetail->quantity;
                        $inventoryDetail->save();
                    }
                }
                $inventory->total_quantity  = $inventory_total_quantity;
                $inventory->save();

                //Add relationship Inventory
                $bean->load_relationship('j_payment_j_inventory_1');
                $bean->j_payment_j_inventory_1->add($inventory->id);

                $bean->tuition_fee          = $bean->amount_bef_discount;
            }
            if($bean->payment_type == 'Cashholder' || $bean->payment_type == 'Enrollment' || $bean->payment_type == 'Product'){
                //Add Relationship Payment - Discount
                $json_discount = json_decode(html_entity_decode($_POST['discount_list']),true);
                $bean->load_relationship('j_payment_j_discount_1');
                $bean->load_relationship('j_partnership_j_payment_1');
                foreach($json_discount as $dis_id => $value){
                    $bean->j_payment_j_discount_1->add($dis_id);
                    $extDisName = '';
                    if($value['type'] == "Partnership" && !empty($value["partnership_id"])){
                        $GLOBALS['db']->query("INSERT INTO j_partnership_j_payment_1_c
                            (id, date_modified, deleted, j_partnership_j_payment_1j_partnership_ida, j_partnership_j_payment_1j_payment_idb, discount_id) VALUES
                            ('".create_guid()."','".$timedate->nowDb()."',0, '{$value["partnership_id"]}', '{$bean->id}', '{$dis_id}')");
                        $part = BeanFactory::getBean('J_Partnership', $value["partnership_id"]);
                        $extDisName = ': '.$part->name;
                    }

                    $dis = BeanFactory::getBean('J_Discount',$dis_id);
                    $spon = new J_Sponsor();
                    $spon->name             = $dis->name.$extDisName;
                    $spon->payment_id       = $bean->id;
                    $spon->discount_id      = $dis_id;
                    $spon->amount           = $value['dis_amount'];
                    $spon->percent          = $value['dis_percent'];
                    $spon->total_down       = $value['total_down'];
                    $spon->type             = 'Discount';
                    $spon->team_id          = $bean->team_id;
                    $spon->team_set_id      = $bean->team_id;
                    $spon->save();
                }
                //Create Sponsor
                $json_sponsor = json_decode(html_entity_decode($_POST['sponsor_list']),true);
                foreach($json_sponsor as $key => $value){
                    $spon = new J_Sponsor();
                    $spon->name = $value['foc_type'];
                    $spon->payment_id       = $bean->id;
                    $spon->voucher_id       = $value['voucher_id'];
                    if (empty($bean->fetched_row) && !empty($spon->voucher_id))
                        $GLOBALS['db']->query("UPDATE j_voucher SET used_time=used_time+1 WHERE id = '{$spon->voucher_id}'");

                    $spon->student_id       = $bean->contacts_j_payment_1contacts_ida;
                    if($value['type'] == 'Loyalty' ) $spon->student_id   = $value['voucher_id'];

                    $spon->sponsor_number   = $value['sponsor_number'];
                    $spon->amount           = $value['sponsor_amount'];
                    $spon->percent          = $value['sponsor_percent'];
                    $spon->loyalty_points   = $value['loyalty_points'];
                    $spon->total_down       = $value['total_down'];
                    $spon->foc_type         = $value['foc_type'];
                    $spon->type             = 'Sponsor';
                    $spon->description      = $value['description'];
                    if($spon->loyalty_points > 0)
                        $spon->type             = 'Loyalty';
                    $spon->team_id          = $bean->team_id;
                    $spon->team_set_id      = $bean->team_id;
                    if(unformat_number($value['total_down']) > 0 || !empty($spon->voucher_id))
                        $spon->save();
                    $total_spon = 0;
                    foreach($json_sponsor as $sponsor)
                        $total_spon = $total_spon + (double)$sponsor['sponsor_percent'];

                    if($total_spon >=100)
                        $bean->remain_hours = $bean->total_hours;

                }

                //Add Relationship Payment - Loyalty
                $json_loyalty = json_decode(html_entity_decode($_POST['loyalty_list']),true);

                $loyalty = new J_Loyalty();
                $loyalty->point          = abs(unformat_number($json_loyalty['points_to_spend']));
                $loyalty->discount_amount= $json_loyalty['amount_to_spend'];
                $loyalty->rate_in_out   = $GLOBALS['app_list_strings']['default_loyalty_rate']['Conversion Rate'];
                $loyalty->type          = 'Redemption';
                $loyalty->student_id    = $student->id;
                $loyalty->payment_id    = $bean->id;
                $loyalty->target_id     = $json_loyalty['rate_out_id'];
                $loyalty->team_id       = $bean->team_id;
                $loyalty->team_set_id   = $bean->team_id;
                $loyalty->input_date    = $bean->payment_date;
                $loyalty->description   = 'Redemption Payments.';
                if($loyalty->point > 0 && unformat_number($json_loyalty['amount_to_spend']) > 0)
                    $loyalty->save();

            }
            //Check Company Info
            if($bean->is_corporate){
                $acc = BeanFactory::getBean('Accounts',$bean->account_id);
                if( (($acc->name != $bean->company_name)) || ($acc->billing_address_street != $bean->company_address) || ($acc->tax_code != $bean->tax_code) ){
                    $acc->name                       = $bean->company_name;
                    $acc->billing_address_street     = $bean->company_address;
                    $acc->tax_code                   = $bean->tax_code;
                    $acc->save();
                }
            }
        }
    }

    function afterSavePayment($bean, $event, $arguments){
        require_once("custom/include/_helper/junior_revenue_utils.php");
        require_once("custom/modules/J_Payment/_helper.php");
        if(($_POST['module'] == $bean->module_name && $_POST['action'] == 'Save') || ($_REQUEST['module'] == 'J_Class' && $_REQUEST['type'] == 'ajaxAddStudentUpgrade')){
            global $timedate;

            if($bean->payment_type == 'Enrollment'){
                //Get List Class Of Payment
                $sql_get_class="SELECT DISTINCT
                IFNULL(l2.id, '') l2_id,
                IFNULL(l2.name, '') l2_name,
                IFNULL(l2.class_code, '') class_code,
                IFNULL(l2.level, '') level,
                IFNULL(j_payment.id, '') primaryid,
                l2.kind_of_course kind_of_course
                FROM j_payment
                INNER JOIN j_studentsituations l1 ON j_payment.id = l1.payment_id AND l1.deleted = 0
                INNER JOIN j_class l2 ON l1.ju_class_id = l2.id AND l2.deleted = 0
                WHERE j_payment.id = '{$bean->id}'
                AND j_payment.deleted = 0
                ORDER BY l2.name";
                $result_get_class = $GLOBALS['db']->query($sql_get_class);
                $class              = '';
                $koc_string         = array();
                $level_string       = array();

                while($row = $GLOBALS['db']->fetchByAssoc($result_get_class)){
                    if(empty($class))
                        $class  .= $row['class_code'];
                    else
                        $class  .= ','.$row['class_code'];

                    if(!in_array($row['kind_of_course'],$koc_string)) $koc_string[] = $row['kind_of_course'];
                    if(!in_array($row['level'],$level_string)) $level_string[] = $row['level'];

                    $bean->kind_of_course = $row['kind_of_course'];
                }
                $k_string =  encodeMultienumValue($koc_string);
                $l_string =  encodeMultienumValue($level_string);
                $GLOBALS['db']->query("UPDATE j_payment SET class_string = '$class', kind_of_course_string = '$k_string', level_string = '$l_string', kind_of_course='{$bean->kind_of_course}' WHERE id = '{$bean->id}'");

            }elseif($bean->payment_type == 'Cashholder' || $bean->payment_type == 'Deposit'){
                $k_string =  encodeMultienumValue(array($bean->kind_of_course));
                $GLOBALS['db']->query("UPDATE j_payment SET kind_of_course_string = '$k_string' WHERE id = '{$bean->id}'");
            }

            $not_pa_type = array('Transfer Out','Moving Out','Refund','Transfer In','Moving In','Book/Gift');

            if(!in_array($bean->payment_type,$not_pa_type)) {
                //Add Receipt
//                if($bean->number_of_payment == 'Monthly-plan'){
//                    $count_pmd = (int)$bean->num_month_pay;
//
//                    $total_pmd = $bean->payment_amount;
//
//                    for($i = 0; $i < $count_pmd; $i++){
//                        $pmd = BeanFactory::newBean('J_PaymentDetail');
//                        $index = $i+1;
//                        $pmd->payment_no    = $index;
//                        $pmd->name          = '-none-';
//
//                        $payDtlAmount       = unformat_number($_POST['pay_dtl_amount'][0]);
//
//                        if($i == 0){
//                            $pmd->is_discount       = 1;
//                            $pmd->before_discount   = format_number(round($bean->payment_amount / $count_pmd, -3) + $discount_amount + $final_sponsor + $loyalty_amount);
//                            $pmd->discount_amount   = format_number($discount_amount);
//                            $pmd->sponsor_amount    = format_number($final_sponsor);
//                            $pmd->loyalty_amount    = format_number($loyalty_amount);
//                        }else{
//                            $pmd->before_discount   = format_number(round($bean->payment_amount / $count_pmd, -3));
//                            $pmd->discount_amount   = 0;
//                            $pmd->sponsor_amount    = 0;
//                            $pmd->loyalty_amount    = 0;
//                        }
//
//                        $pmd->status                = "Unpaid";
//
//                        $pmd->expired_date          =  date('Y-m-d',strtotime('+'.$i.' months'. $timedate->convertToDBDate($_POST['pay_dtl_invoice_date'][0],false)));
//                        $pmd->payment_date          =  $pmd->expired_date;
//                        if($payDtlAmount == 0){
//                            $pmd->status                = "Paid";
//                            $pmd->payment_date          = $_POST['pay_dtl_invoice_date'][$i];
//                            $pmd->expired_date          = $_POST['pay_dtl_invoice_date'][$i];
//                            $pmd->payment_method        = 'Other';
//                        }
//                        $pmd->type                  = 'Normal';
//                        $pmd->payment_amount        = format_number(round($bean->payment_amount / $count_pmd, -3));
//                        $pmd->payment_id            = $bean->id;
//                        $pmd->student_id            = $bean->contacts_j_payment_1contacts_ida;
//                        $pmd->assigned_user_id      = '';
//                        $pmd->team_id               = $bean->team_id;
//                        $pmd->team_set_id           = $bean->team_id;
//                        $pmd->kind_of_course        = $k_string;
//                        $pmd->level                 = $l_string;
//                        if($i == $count_pmd-1){
//                            $pmd->payment_amount    =  $total_pmd;
//                            $pmd->before_discount   =  $total_pmd;
//                        }else
//                            $total_pmd -= round($bean->payment_amount / $count_pmd, -3);
//
//                        //Prepare Array
//                        $arr = array(
//                            'expired_date' => $pmd->expired_date,
//                            'payment_type' => $bean->payment_type,
//                            'kind_of_course' => $bean->kind_of_course,
//                            'payment_id' => $bean->id,
//                            'payment_no' => $pmd->payment_no,
//                        );
//                        $pmd->description = generateContent($arr,false);
//
//                        if($pmd->payment_amount != 0 || ($pmd->payment_amount == 0 && unformat_number($pmd->before_discount) == ($discount_amount + $final_sponsor + $loyalty_amount)))
//                            $pmd->save();
//                    }
//                }else{
//                    $count_pmd = (int)$bean->number_of_payment;
//                    if($bean->number_of_payment == 'Monthly-plan')
//                        $count_pmd = 1;
//
//                    $_POST['pay_dtl_invoice_date'][0] = $bean->payment_date;
//                    //Find payment max amount
//                    $payDtlMax          = 1;
//                    $payDtlMaxAmount    = 0;
//                    for($i = 0; $i < $count_pmd; $i++){
//                        //Nếu trả góp - Discount/Sponsor qui vào lần 1
//                        if($bean->is_installment)
//                            $payDtlMax = 1;
//                        else{
//                            $cr_amount = unformat_number($_POST['pay_dtl_amount'][$i]);
//                            if($cr_amount > $payDtlMaxAmount){
//                                $payDtlMaxAmount     = $cr_amount;
//                                $payDtlMax           = $i + 1;
//                            }
//                        }
//                    }
//
//                    $discount_amount        = ($bean->discount_amount);
//                    $final_sponsor          = ($bean->final_sponsor);
//                    $loyalty_amount         = ($bean->loyalty_amount);
//
//
//                    for($i = 0; $i < $count_pmd; $i++){
//                        $pmd = BeanFactory::newBean('J_PaymentDetail');
//                        $index = $i+1;
//                        $pmd->payment_no    = $index;
//                        $pmd->name          = '-none-';
//
//                        $payDtlAmount       = unformat_number($_POST['pay_dtl_amount'][$i]);
//                        if($index == $payDtlMax){
//                            $pmd->is_discount       = 1;
//                            $pmd->before_discount   = format_number($payDtlAmount + $discount_amount + $final_sponsor + $loyalty_amount);
//                            $pmd->discount_amount   = format_number($discount_amount);
//                            $pmd->sponsor_amount    = format_number($final_sponsor);
//                            $pmd->loyalty_amount    = format_number($loyalty_amount);
//                        }else{
//                            $pmd->before_discount   = format_number($payDtlAmount);
//                            $pmd->discount_amount   = 0;
//                            $pmd->sponsor_amount    = 0;
//                            $pmd->loyalty_amount    = 0;
//                        }
//
//                        //Prepare Array
//                        $arr = array(
//                            'expired_date' => $pmd->payment_date,
//                            'payment_type' => $bean->payment_type,
//                            'kind_of_course' => $bean->kind_of_course,
//                            'payment_id' => $bean->id,
//                            'payment_no' => $pmd->payment_no,
//                        );
//                        $pmd->description = generateContent($arr,false);
//
//                        $pmd->status                = "Unpaid";
//                        //$pmd->payment_date          = $_POST['pay_dtl_invoice_date'][$i];
//                        $pmd->expired_date          = $_POST['pay_dtl_invoice_date'][$i];
//                        $pmd->payment_date          =  $pmd->expired_date;
//                        if($payDtlAmount == 0){
//                            $pmd->status                = "Paid";
//                            $pmd->payment_method        = 'Other';
//                        }
//                        $pmd->type                  = 'Normal';
//                        $pmd->payment_amount        = format_number($payDtlAmount);
//                        $pmd->payment_id            = $bean->id;
//                        $pmd->student_id            = $bean->contacts_j_payment_1contacts_ida;
//                        $pmd->assigned_user_id      = '';
//                        $pmd->team_id               = $bean->team_id;
//                        $pmd->team_set_id           = $bean->team_id;
//                        $pmd->kind_of_course        = $k_string;
//                        $pmd->level                 = $l_string;
//                        if($pmd->payment_amount != 0 || ($pmd->payment_amount == 0 && unformat_number($pmd->before_discount) == ($discount_amount + $final_sponsor + $loyalty_amount)))
//                            $pmd->save();
//                    }
//                }
            }elseif($bean->payment_type == 'Book/Gift'){
                $pmd = BeanFactory::newBean('J_PaymentDetail');
                $pmd->type                  = 'Normal';
                $pmd->payment_amount        = format_number($bean->payment_amount);
                $pmd->payment_id            = $bean->id;
                $pmd->payment_date          = $bean->payment_date;
                $pmd->expired_date          = $pmd->payment_date;
                $pmd->student_id            = $bean->contacts_j_payment_1contacts_ida;
                $pmd->assigned_user_id      = '';
                $pmd->team_id               = $bean->team_id;
                $pmd->team_set_id           = $bean->team_id;
                //Prepare Array
                $arr = array(
                    'expired_date' => $pmd->payment_date,
                    'payment_type' => $bean->payment_type,
                    'kind_of_course' => $bean->kind_of_course,
                    'payment_id' => $bean->id,
                    'payment_no' => $pmd->payment_no,
                );
                $pmd->description = generateContent($arr,false);
                if($pmd->payment_amount <= 0){
                    $pmd->status                = "Paid";
                    $pmd->payment_method        = 'Other';
                }
                $pmd->save();
            }


        }
        $not_pa_type = array('Transfer Out','Moving Out','Refund','Transfer In','Moving In','Schedule Change');

        if(!in_array($bean->payment_type,$not_pa_type))
            getPaymentRemain($bean->id);    //Nap so remain
    }

    ///to mau id va status Lap Nguyen
    function listViewColorPayment(&$bean, $event, $arguments){
        global $timedate;
        //Total paid amount of payment detail
        $q1="SELECT DISTINCT
        IFNULL(j_paymentdetail.id, '') primaryid,
        j_paymentdetail.payment_date payment_date,
        j_paymentdetail.status status,
        j_paymentdetail.payment_amount payment_amount
        FROM
        j_paymentdetail
        INNER JOIN
        j_payment l1 ON j_paymentdetail.payment_id = l1.id
        AND l1.deleted = 0
        WHERE
        (((l1.id = '{$bean->id}')
        AND (j_paymentdetail.status <> 'Cancelled')
        ))
        AND j_paymentdetail.deleted = 0";
        $res = $GLOBALS['db']->query($q1);
        $total = 0;
        $htm_pmd = '<table width="100%" class="dataTable"><tbody>';
        $count_pmd = 0;
        $paidAmount     = 0;
        $unpaidAmount   = 0;
        while($row = $GLOBALS['db']->fetchByAssoc($res)) {
            $_class = '';
            if($row['status'] == 'Unpaid'){
                $_class = '';
                $unpaidAmount += $row['payment_amount'];
            }

            if($row['status'] == 'Paid'){
                $paidAmount += $row['payment_amount'];
            }

            if((($row['status'] == 'Paid' && $row['payment_amount'] > 0)) || ($row['status'] == 'Unpaid')){
                $count_pmd++;
                $htm_pmd .= "<tr style='border: none;'>";
                $htm_pmd .= "<td style='width: 20%;'>".$timedate->to_display_date($row['payment_date'],false)."</td>";

                $htm_pmd .= "<td style='width: 20%;'>".format_number($row['payment_amount'])."</td>";
                $htm_pmd .= "<td style='width: 20%;' ".($row['status'] == 'Unpaid' ? "class='error'" : '').">".$row['status']."</td>";
                $htm_pmd .= "</tr>";
            }
        }
        $htm_pmd .= "</tbody></table>";

        //add field Paid/Unpaid
        $bean->paid_amount_import = $paidAmount;
        $bean->unpaid_amount_import = $unpaidAmount;

        if($count_pmd > 0)
            $bean->related_payment_detail = $htm_pmd;
        else $bean->related_payment_detail = '';

        $bean->total_amount = ($bean->paid_amount + $bean->deposit_amount+ $bean->payment_amount);
        $bean->class_string = '';
        if($bean->payment_type == 'Enrollment' || $bean->payment_type == 'Delay'){
            $sql_get_class="SELECT
            DISTINCT IFNULL(l2.id,'') l2_id ,
            IFNULL(l2.name,'') l2_name ,
            IFNULL(l2.class_code,'') class_code ,
            IFNULL(j_payment.id,'') primaryid
            FROM j_payment INNER JOIN j_studentsituations l1 ON j_payment.id=l1.payment_id
            AND l1.deleted=0 INNER JOIN j_class l2 ON l1.ju_class_id=l2.id
            AND l2.deleted=0 WHERE j_payment.id='{$bean->id}'
            AND j_payment.deleted=0
            ORDER BY  l2.name";
            $result_get_class = $GLOBALS['db']->query($sql_get_class);
            //    $bean->class_string = '';
            //style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
            while($row = $GLOBALS['db']->fetchByAssoc($result_get_class))
            //$bean->class_string = $row['l2_name'];
            $bean->class_string .= '<a href="#J_Class/'.$row['l2_id'].'">'.$row['l2_name'].'</a><br>';
        }


        $img_import = '';
        //Student name
        $q10 = "SELECT
        IFNULL(l2.id, l1.id) primary_id,
        IFNULL(l2.id, l1.id) primary_id,
        IFNULL(l2.full_student_name, l1.full_lead_name) student_name,
        IFNULL(l2.phone_mobile, l1.phone_mobile) student_phone,
        (case when IFNULL(LENGTH(l2.id),0) < 1 then  'Leads'  else 'Contacts' end)  parent_type
        FROM j_payment
        LEFT JOIN
        leads l1 ON j_payment.lead_id = l1.id
        AND l1.deleted = 0
        LEFT JOIN
        contacts_j_payment_1_c l2_1 ON j_payment.id = l2_1.contacts_j_payment_1j_payment_idb
        AND l2_1.deleted = 0
        LEFT JOIN contacts l2 ON l2.id = l2_1.contacts_j_payment_1contacts_ida AND l2.deleted = 0
        WHERE (((j_payment.id = '{$bean->id}')))
        AND j_payment.deleted = 0";
        $rs10 = $GLOBALS['db']->query($q10);
        $rowS = $GLOBALS['db']->fetchByAssoc($rs10);
        $bean->contacts_j_payment_1_name = '<a href="#'.$rowS['parent_type'].'/'.$rowS['primary_id'].'">'.$rowS['student_name'].'</a>';
        $bean->phone = '<span>'.$rowS['student_phone'].'</span>';

        //Payment type
        switch ($bean->payment_type) {
            case "Enrollment":
                $colorClass = "textbg_green";
                break;
            case "Deposit":
                $colorClass = "textbg_blue";
                break;
            case "Cashholder":
                $colorClass = "textbg_bluelight";
                if(!empty($bean->old_student_id)){
                    $img_import = '<img src="custom/images/import.png" style="width: 16px;" title="Data Import">';
                }
                break;
            case "Delay":
            case "Schedule Change":
                $colorClass = "textbg_blood";
                break;
            case "Transfer In":
            case "Transfer Out":
            case "Moving In":
            case "Moving Out":
                $colorClass = "textbg_yellow_light";
                break;
            case "Refund":
                $colorClass = "textbg_crimson";
                break;
            case "Corporate":
                $colorClass = "textbg_dream";
                break;
            case "Product":
            case "Placement Test":
            case "Tutor Package":
            case "Travelling Fee":
            case "Delay Fee":
            case "Transfer Fee":
                $colorClass = "textbg_violet";
                break;
        }
        $bean->payment_type = "<span class='full-width visible'><span class='label ellipsis_inline $colorClass' title='{$bean->description}'>". $bean->payment_type ." $img_import</span></span>";

        //Get Payment Related
        $q2 = "SELECT DISTINCT
        IFNULL(l1.id, '') l1_id,
        IFNULL(l1.name, '') l1_name,
        IFNULL(l1.payment_type, '') l1_payment_type,
        l1_1.hours hours,
        l1_1.amount amount
        FROM
        j_payment
        INNER JOIN
        j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida
        AND l1_1.deleted = 0
        INNER JOIN
        j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb
        AND l1.deleted = 0
        WHERE
        (((j_payment.id = '{$bean->id}')))
        AND j_payment.deleted = 0";

        $count_rel = 0;
        $res = $GLOBALS['db']->query($q2);
        $htm_rel = "<table><tbody>";
        while($row = $GLOBALS['db']->fetchByAssoc($res)) {
            $htm_rel .= "<tr class='oddListRowS1' style='border: none;'><td style='width: 40%;'><a title='{$row['l1_payment_type']}' href='#bwc/index.php?module=J_Payment&action=DetailView&record={$row['l1_id']}'>{$row['l1_name']}</a> (".format_number($row['amount']).")</td>";
            $htm_rel .= "</tr>";
            $count_rel++;
        }
        $htm_rel .= "</tbody></table>";
        if($count_rel > 0)
            $bean->related_payment_list = $htm_rel;
    }

    function addCode(&$bean, $event, $arguments){
        if(empty($bean->name)){
            $code_field = 'name';
            $bean->is_installment = $_POST['is_installment'];
            $bean->installment_plan = $_POST['installment_plan'];
            if($bean->payment_type == 'Transfer Out' || $bean->payment_type == 'Moving Out' || $bean->payment_type == 'Refund'){
                $student = BeanFactory::getBean("Contacts", $bean->contacts_j_payment_1contacts_ida);
                $bean->team_id = $student->team_id;
                $bean->team_set_id = $student->team_id;
            }
            if( empty($bean->fetched_row[$code_field]) || strpos($bean->fetched_row[$code_field], $prefix) === false ){
                //Get Prefix
                $res        = $GLOBALS['db']->query("SELECT code_prefix FROM teams WHERE id = '{$bean->team_id}'");
                $row        = $GLOBALS['db']->fetchByAssoc($res);
                $prefix     = $row['code_prefix'];
                $year       = date('y',strtotime('+ 7hours'. (!empty($bean->date_entered) ? $bean->date_entered : $bean->fetched_row['date_entered'])));
                $table      = $bean->table_name;
                $sep        = '-';
                $first_pad  = '00000';
                $padding    = 5;
                if($bean->payment_type == 'Enrollment' || $bean->payment_type == 'Corporate' || $bean->payment_type == 'Deposit' || $bean->payment_type == 'Cashholder' || $bean->payment_type == 'Placement Test' || $bean->payment_type == 'Cambridge' || $bean->payment_type == 'Outing Trip' || $bean->payment_type == 'Product')
                    $ext = 'PAY';
                else $ext = 'REF';
                $str_code = $ext.$prefix.$year.$sep;

                $query = "SELECT $code_field FROM $table WHERE ( $code_field <> '' AND $code_field IS NOT NULL) AND id != '{$bean->id}' AND (LEFT($code_field, ".strlen($str_code).") = '".$str_code."') ORDER BY RIGHT($code_field, $padding) DESC LIMIT 1";
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
        }
    }

    function createdRelationshipBookGift(&$bean, $event, $arguments){
        $url = $_SERVER['HTTP_REFERER'];
        if(strpos($url,'primary_id=')) {
            $id = substr($url, strpos($url, 'primary_id=') + 11, 36);
            $bean->j_payment_j_payment_2_right->add($id);
        }
        if(empty($_POST['primary_id'])){
        }
    }

    function getBalanceRelate(&$bean, $event, $arguments){
        if($_REQUEST['view'] =='subpanel-for-quotes-quotes_j_payment_1'){
            if($bean->load_relationship('quotes_j_payment_1')){
                foreach($bean->quotes_j_payment_1->getBeans() as $relate){
                    if(strpos($_REQUEST['__dotb_url'],$relate->id) != false){
                        $sql = "SELECT use_amount FROM quotes_j_payment_1_c WHERE deleted=0 AND quotes_j_payment_1j_payment_idb ='{$bean->id}' AND  quotes_j_payment_1quotes_ida='{$relate->id}'";
                        $result=$GLOBALS['db']->getOne($sql);
                        $bean->total_amount_relata_balance = $result;
                        break;
                    }
                }
            }
        }
    }
}
?>
