<?php
require_once("custom/include/_helper/junior_revenue_utils.php");

switch ($_POST['type']) {
    case 'ajaxGetStudentInfo':
        $result = ajaxGetStudentInfo($_POST['student_id'], $_POST['enrollment_id'], $_POST['payment_type'], $_POST['payment_date'], $_POST['current_team_id']);
        echo $result;
        break;
    case 'ajaxUpdatePaymentDetail':
        $result = ajaxUpdatePaymentDetail($_POST['payment_detail'], $_POST['payment_amount'], $_POST['payment_method'], $_POST['card_type'], $_POST['bank_type'], $_POST['payment_date'], $_POST['method_note'], $_POST['handle_action']);
        echo $result;
        break;
    case 'ajaxUndoPayment':
        $result = ajaxUndoPayment($_POST['payment_id'], $_POST['payment_type']);
        echo $result;
        break;
    case 'finish_printing':
        $result = finish_printing($_POST['printing_id']);
        echo $result;
        break;
    case 'caculateDropPayment':
        $result = caculateDropPayment($_POST['payment_id'], $_POST['dl_date']);
        echo $result;
        break;
    case 'createDropPayment':
        $result = createDropPayment();
        echo $result;
        break;
    case 'ajaxConvertPayment':
        $result = ajaxConvertPayment();
        echo $result;
        break;
    case 'autoGetNextInvoice':
        $result = autoGetNextInvoice($_POST['team_id'], $_POST['payment_id']);
        echo $result;
        break;
        break;
    case 'ajaxCheckVoucherCode':
        $result = ajaxCheckVoucherCode($_POST['voucher_code']);
        echo $result;
        break;
    case 'ajax_payment_detail':
        $result = ajax_payment_detail();
        echo $result;
        break;
    case 'ajaxCancelReceipt':
        $result = ajaxCancelReceipt($_POST['payment_detail'], $_POST['description']);
        echo $result;
        break;
    case 'ajaxSaveInvoice':
        $result = ajaxSaveInvoice();
        echo $result;
        break;
    case 'ajaxCancelInvoice':
        $result = ajaxCancelInvoice($_POST['invoice_id'], $_POST['payment_id'], $_POST['description']);
        echo $result;
        break;
    case 'ajaxGetInvoiceNo':
        $result = ajaxGetInvoiceNo($_POST['payment_id'], $_POST['buyer_legal_type']);
        echo $result;
        break;
    case 'ajaxExportInvoice':
        $result = ajaxExportInvoice($_POST['payment_id']);
        echo $result;
        break;
    case 'addEvatCorporate':
        $result = addEvatCorporate($_POST['payment_id'], $_POST['account_id'], $_POST['action_type']);
        echo $result;
        break;
}

// ----------------------------------------------------------------------------------------------------------\\

function ajaxGetStudentInfo($student_id, $enrollment_id = '', $payment_type = 'Enrollment', $payment_date = '', $current_team_id = ''){
    global $timedate, $current_user;
    if (empty($payment_date))
        $payment_date = $timedate->nowDate();
    if (empty($current_team_id))
        return json_encode(array(
            "success" => "0",
            "messenge" => 'Please select Center',
        ));
    // Get Student Info
    $q1 = "SELECT DISTINCT
    IFNULL(contacts.id, '') student_id,
    CONCAT(IFNULL(contacts.last_name, ''),
    ' ',
    IFNULL(contacts.first_name, '')) student_full_name,
    IFNULL(contacts.contact_id, '') contacts_contact_id,
    IFNULL(contacts.birthdate, '') student_birthdate,
    IFNULL(l1.id, '') l1_id,
    IFNULL(l1.mobile_phone, '') parent_mobile_phone,
    IFNULL(contacts.phone_mobile, '') student_phone_mobile,
    IFNULL(l2.id, '') team_id,
    IFNULL(l2.name, '') team_name,
    IFNULL(l3.id, '') assigned_user_id,
    CONCAT(IFNULL(l3.last_name, ''),
    ' ',
    IFNULL(l3.first_name, '')) assigned_user_name
    FROM
    contacts
    LEFT JOIN
    c_contacts_contacts_1_c l1_1 ON contacts.id = l1_1.c_contacts_contacts_1contacts_idb
    AND l1_1.deleted = 0
    LEFT JOIN
    c_contacts l1 ON l1.id = l1_1.c_contacts_contacts_1c_contacts_ida
    AND l1.deleted = 0
    INNER JOIN
    teams l2 ON contacts.team_id = l2.id
    AND l2.deleted = 0
    LEFT JOIN
    users l3 ON contacts.assigned_user_id = l3.id
    AND l3.deleted = 0

    WHERE
    contacts.id = '$student_id'
    AND contacts.deleted = 0";
    $result         = $GLOBALS['db']->query($q1);
    $info           = array();
    $row            = $GLOBALS['db']->fetchByAssoc($result);
    $student_team_id = $row['team_id'];
    $student_name   = $row['student_full_name'];
    $info['id']     = $row['student_id'];
    $info['student_name']   = $row['student_full_name'];
    $phone                  = $row['parent_mobile_phone'];
    if (empty($phone))
        $phone = $row['student_phone_mobile'];
    $info['phone'] = $phone;

    if (!empty($row['student_birthdate']))
        $birthdate = $timedate->to_display_date($row['student_birthdate']);
    else $birthdate = "";
    $info['birthday'] = $birthdate;
    if(!empty($row['assigned_user_id']) && !empty($row['assigned_user_name'])){
        $info['assigned_user_id']   = $row['assigned_user_id'];
        $info['assigned_user_name'] = $row['assigned_user_name'];
    }else{
        $info['assigned_user_name'] = $current_user->name;
        $info['assigned_user_id']   = $current_user->id;
    }
    $info['team_id'] = $row['team_id'];
    $info['team_name'] = $row['team_name'];



    //Get Class List
    $sql_ex = '';
    $qTeam = "AND l4.id = '{$current_user->team_id}'";
    if ($GLOBALS['current_user']->isAdmin()) {
        $qTeam = "";
    }
    $q2 = "SELECT DISTINCT
    IFNULL(l2.id, '') class_id,
    l2.class_code class_code,
    IFNULL(l2.name, '') class_name,
    IFNULL(j_studentsituations.id, '') situation_id,
    IFNULL(j_studentsituations.total_hour, 0) total_hour,
    IFNULL(j_studentsituations.total_amount, 0) total_amount,
    j_studentsituations.type type,
    j_studentsituations.start_study start_study,
    j_studentsituations.end_study end_study,
    l2.start_date class_start,
    l2.end_date class_end,
    IFNULL(l4.id, '') team_id,
    IFNULL(l4.name, '') team_name
    FROM
    j_studentsituations
    INNER JOIN
    contacts l1 ON j_studentsituations.student_id = l1.id
    AND l1.deleted = 0
    INNER JOIN
    j_class l2 ON j_studentsituations.ju_class_id = l2.id
    AND l2.deleted = 0
    INNER JOIN
    teams l4 ON j_studentsituations.team_id = l4.id
    AND l4.deleted = 0
    WHERE
    (l1.id = '$student_id')
    $qTeam
    AND j_studentsituations.deleted = 0
    ORDER BY type ASC";
    $rs2 = $GLOBALS['db']->query($q2);
    $class_list = array();
    while ($row = $GLOBALS['db']->fetchByAssoc($rs2)) {
        if ($row['type'] == 'OutStanding') {
            $payment_date_db = date('Y-m-d', strtotime("- 1day " . $timedate->convertToDBDate($payment_date, false)));
            $payment_date_1 = $timedate->to_display_date($payment_date_db, false);
            $revenue = get_total_revenue($student_id, "'OutStanding'", '', $payment_date_1, $row['class_id'], $row['situation_id']);
            $class_list[$row['situation_id']]['total_revenue_util_now'] = format_number($revenue[0]['total_revenue_hour'], 2, 2);
        }
        $class_list[$row['situation_id']]['student_name'] = $student_name;
        $class_list[$row['situation_id']]['class_id'] = $row['class_id'];
        $class_list[$row['situation_id']]['class_name'] = $row['class_name'];
        $class_list[$row['situation_id']]['class_code'] = $row['class_code'];
        $class_list[$row['situation_id']]['type'] = $row['type'];
        $class_list[$row['situation_id']]['total_hour'] = format_number($row['total_hour'], 2, 2);
        $class_list[$row['situation_id']]['total_amount'] = format_number($row['total_amount']);
        $class_list[$row['situation_id']]['start_study'] = $row['start_study'];
        $class_list[$row['situation_id']]['end_study'] = $row['end_study'];
        $class_list[$row['situation_id']]['class_start'] = $row['class_start'];
        $class_list[$row['situation_id']]['class_end'] = $row['class_end'];
        $class_list[$row['situation_id']]['team_name'] = $row['team_name'];
    }
    //Get List Payment
    //    $qTeam = "AND l3.id = '{$current_user->team_id}'";
    $qTeam = "AND j_payment.team_set_id IN
    (SELECT
    tst.team_set_id
    FROM
    team_sets_teams tst
    INNER JOIN
    team_memberships team_memberships ON tst.team_id = team_memberships.team_id
    AND team_memberships.user_id = '{$current_user->id}'
    AND team_memberships.deleted = 0)";
    if ($GLOBALS['current_user']->isAdmin()) {
        $qTeam = "";
    }
    //if ($payment_type == 'Enrollment' || $payment_type == 'Cashholder' || $current_user->isAdmin())
    $ext_where = "'Transfer In','Moving In',";
    //else $ext_where = "";      //Moving nhieu lan
    $q3 = "SELECT DISTINCT
    IFNULL(j_payment.id, '') payment_id,
    IFNULL(j_payment.name, '') payment_code,
    IFNULL(j_payment.payment_type, '') payment_type,
    j_payment.payment_date payment_date,
    j_payment.payment_expired payment_expired,
    j_payment.payment_amount payment_amount,
    j_payment.paid_amount paid_amount,
    j_payment.deposit_amount deposit_amount,
    ((j_payment.deposit_amount + j_payment.paid_amount + j_payment.payment_amount) / (j_payment.total_hours)) price,
    j_payment.total_hours total_hours,
    j_payment.remain_amount remain_amount,
    j_payment.remain_hours remain_hours,
    j_payment.use_type use_type,
    j_payment.status status,
    j_payment.start_study start_study,
    j_payment.end_study end_study,
    j_payment.description description,
    IFNULL(l2.id, '') assigned_user_id,
    IFNULL(l2.full_user_name, '') assigned_user_name,
    IFNULL(l7.id, '') closed_sale_user_id,
    IFNULL(l7.full_user_name, '') closed_sale_user_name,
    IFNULL(l8.id, '') pt_demo_user_id,
    IFNULL(l8.full_user_name, '') pt_demo_user_name,
    IFNULL(l3.id, '') team_id,
    IFNULL(l6.id, '') corporate_id,
    IFNULL(l6.name, '') corporate_name,
    IFNULL(l4.id, '') course_fee_id,
    IFNULL(l3.name, '') team_name,
    IFNULL(l4.name, '') course_fee
    FROM
    j_payment
    INNER JOIN
    contacts_j_payment_1_c l1_1 ON j_payment.id = l1_1.contacts_j_payment_1j_payment_idb
    AND l1_1.deleted = 0
    INNER JOIN
    contacts l1 ON l1.id = l1_1.contacts_j_payment_1contacts_ida
    AND l1.deleted = 0
    LEFT JOIN
    users l2 ON j_payment.assigned_user_id = l2.id
    AND l2.deleted = 0

    LEFT JOIN
    users l7 ON j_payment.user_closed_sale_id = l7.id
    AND l7.deleted = 0

    LEFT JOIN
    users l8 ON j_payment.user_pt_demo_id = l8.id
    AND l8.deleted = 0

    INNER JOIN
    teams l3 ON j_payment.team_id = l3.id
    AND l3.deleted = 0
    LEFT JOIN
    j_coursefee_j_payment_1_c l4_1 ON j_payment.id = l4_1.j_coursefee_j_payment_1j_payment_idb
    AND l4_1.deleted = 0
    LEFT JOIN
    j_coursefee l4 ON l4.id = l4_1.j_coursefee_j_payment_1j_coursefee_ida
    AND l1.deleted = 0

    LEFT JOIN
    contracts l5 ON j_payment.contract_id = l5.id
    AND l5.deleted = 0
    LEFT JOIN
    accounts l6 ON l5.account_id = l6.id AND l6.deleted = 0

    WHERE
    (((l1.id = '$student_id')
    AND (j_payment.payment_type IN ('Enrollment' , 'Deposit',
    'Cashholder',
    'Delay',
    'Schedule Change',
    $ext_where
    'Refund',
    'Placement Test',
    'Transfer Fee',
    'Tutor Package',
    'Product'))
    $qTeam))
    AND j_payment.deleted = 0
    ORDER BY payment_date ASC";
    $result = $GLOBALS['db']->query($q3);
    $top_list = array();
    $left_list = array();
    $old_payments = array();

    if ($enrollment_id != '') {
        $enrollment = BeanFactory::getBean('J_Payment', $enrollment_id);
        $old_payments = json_decode(html_entity_decode($enrollment->payment_list), true);
    }

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {

        $ext_info = '';
        if ($current_user->team_id != $row['team_id'])
            $ext_info = "({$row['team_name']})";
        if (!empty($row['description']))
            $ext_info_2 = '<br> --' . $row['description'];

        //get payment in student info
        $left_list[$row['payment_id']] = $row['payment_type'] . ': ' . $row['payment_code'] . '-' . format_number($row['payment_amount']) . $ext_info . $ext_info_2;

        $is_old_payment = false;
        if ($row['payment_type'] == "Deposit" || $row['use_type'] == "Amount") {
            if (!empty($old_payments["deposit_list"][$row['payment_id']])) {
                $row['remain_amount'] = $row['remain_amount'] + $old_payments["deposit_list"][$row['payment_id']]['used_amount'];
                $row['remain_hours'] = $row['remain_hours'] + $old_payments["deposit_list"][$row['payment_id']]['used_hours'];
                $is_old_payment = true;
            }
        } else {
            if (!empty($old_payments["paid_list"][$row['payment_id']])) {
                $row['remain_amount'] = $row['remain_amount'] + $old_payments["paid_list"][$row['payment_id']]['used_amount'];
                $row['remain_hours'] = $row['remain_hours'] + $old_payments["paid_list"][$row['payment_id']]['used_hours'];
                $is_old_payment = true;
            }
        }
        //        // Get used discount list for this payment
        //        $sqlUsedDiscount = "SELECT DISTINCT
        //        IFNULL(j_discount.id, '') primaryid,
        //        j_discount.discount_amount discount_amount,
        //        j_discount.discount_percent discount_percent
        //        FROM
        //        j_discount
        //        INNER JOIN
        //        j_payment_j_discount_1_c l1_1 ON j_discount.id = l1_1.j_payment_j_discount_1j_discount_idb
        //        AND l1_1.deleted = 0
        //        INNER JOIN
        //        j_payment l1 ON l1.id = l1_1.j_payment_j_discount_1j_payment_ida
        //        AND l1.deleted = 0
        //        WHERE
        //        l1.id = '{$row['payment_id']}'
        //        AND j_discount.deleted = 0";
        //        $rsUsedDiscount = $GLOBALS['db']->query($sqlUsedDiscount);
        //        $selectedDiscount = array();
        //        while($rowUsedDiscount = $GLOBALS['db']->fetchByAssoc($rsUsedDiscount) ){
        //            $selectedDiscount[] = $rowUsedDiscount['primaryid'];
        //        }
        //        $selectedDiscount = json_encode($selectedDiscount);
        $selectedDiscount = '';
        // get payment in top list
        if ($enrollment_id != $row['payment_id']){
            if ((($row['remain_amount'] > 0) || ($row['remain_hours'] > 0)) && ($row['status'] != 'Closed') && (!in_array($row['payment_type'], array('Enrollment', 'Refund', 'Placement Test', 'Transfer Fee', 'Delay Fee', 'Other', 'Product'))) && ($current_team_id == $row['team_id'])) {
                if ($payment_type == 'Cashholder' && $row['remain_hours'] > 0 && $row['use_type'] == 'Hour')// Bỏ qua Payment Tính giờ cho Cashholder
                    continue;
                $top_list[$row['payment_id']]['payment_id']     = $row['payment_id'];
                $top_list[$row['payment_id']]['used_discount']  = $selectedDiscount;
                $top_list[$row['payment_id']]['payment_code']   = $row['payment_code'];
                $top_list[$row['payment_id']]['payment_type']   = $row['payment_type'];
                $top_list[$row['payment_id']]['payment_date']   = $timedate->to_display_date($row['payment_date'], true);
                $top_list[$row['payment_id']]['payment_expired']= $timedate->to_display_date($row['payment_expired'], true);

                $top_list[$row['payment_id']]['is_expired'] = false;
                if (!empty($payment_date) && !array_key_exists($row['payment_id'], $old_payments["deposit_list"]) && !array_key_exists($row['payment_id'], $old_payments["paid_list"])) {
                    if ($row['payment_expired'] < $timedate->convertToDBDate($payment_date, false))
                        $top_list[$row['payment_id']]['is_expired'] = true;
                }

                $top_list[$row['payment_id']]['payment_amount'] = $row['payment_amount'];
                $top_list[$row['payment_id']]['total_hours'] = $row['total_hours'];
                $top_list[$row['payment_id']]['remain_amount'] = $row['remain_amount'];
                $top_list[$row['payment_id']]['remain_hours'] = $row['remain_hours'];
                $top_list[$row['payment_id']]['use_type'] = $row['use_type'];
                $top_list[$row['payment_id']]['course_fee'] = $row['course_fee'];
                $top_list[$row['payment_id']]['course_fee_id'] = $row['course_fee_id'];
                $top_list[$row['payment_id']]['assigned_user_id'] = $row['assigned_user_id'];
                $top_list[$row['payment_id']]['assigned_user_name'] = $row['assigned_user_name'];

                $top_list[$row['payment_id']]['closed_sale_user_id'] = $row['closed_sale_user_id'];
                $top_list[$row['payment_id']]['closed_sale_user_name'] = $row['closed_sale_user_name'];

                $top_list[$row['payment_id']]['pt_demo_user_id'] = $row['pt_demo_user_id'];
                $top_list[$row['payment_id']]['pt_demo_user_name'] = $row['pt_demo_user_name'];

                $top_list[$row['payment_id']]['team_id'] = $row['team_id'];
                $top_list[$row['payment_id']]['team_name'] = $row['team_name'];
                $top_list[$row['payment_id']]['checked'] = $is_old_payment ? " checked" : "";
            }
        }


    }

    //Get loyalty Point
    $loyalty    = getLoyaltyPoint($info['id'],$enrollment_id);
    $year       = '';
    if(!empty($payment_date))
        $year   = date('Y',strtotime($timedate->convertToDBDate($payment_date, false)));
    $loyalty_rate = getLoyaltyRateOut($loyalty['level'], $current_team_id, $year);
    $accrual_rate = $GLOBALS['app_list_strings']['default_loyalty_rate']['Accrual Rate ('.$loyalty['level'].')'];
    //END: Get loyalty Point

    $content = json_encode(array(
        'success'                => '1',
        'info'                   => $info,
        'loyalty_points'         => $loyalty['points'],
        'mem_code'               => $loyalty['code'],
        'mem_level'              => $loyalty['level'],
        'net_amount'             => $loyalty['net_amount'],
        'mem_level_html'         => $mem_level_html,
        'accrual_rate_value'     => $accrual_rate,
        'loyalty_rate_out_value' => $loyalty_rate['value'],
        'loyalty_rate_out_id'    => $loyalty_rate['id'],
        'class_list'             => $class_list,
        'left_list'              => $left_list,
        'top_list'               => $top_list,
    ));
    return json_encode(array(
        "success" => "1",
        "content" => $content,
    ));
}


function autoGetNextInvoice($team_id = '', $payment_id='')
{
    $sql = "SELECT id,
    IFNULL(invoice_no_from, 0) invoice_no_from,
    IFNULL(invoice_no_to, 0) invoice_no_to,
    IFNULL(serial_no, '') serial_no,
    IFNULL(type, '') type,
    IFNULL(invoice_no_current, 0) invoice_no_current
    FROM j_configinvoiceno
    WHERE team_id='{$team_id}'
    LIMIT 1";

    $rs = $GLOBALS['db']->query($sql);
    $row = $GLOBALS['db']->fetchByAssoc($rs);

    $serial = '';
    $nextInvoiceNo = '';

    $nextInvoiceNo = intval($row['invoice_no_current']) + 1;
    $toInvNo = intval($row['invoice_no_to']);
    if ($nextInvoiceNo > $toInvNo) $status = '--out of range--';


    if ($status == '--out of range--') $txtInv = $status;
    else {
        $fromInvNo = intval($row['invoice_no_from']);
        $toInvNo = intval($row['invoice_no_to']);
        $serial = $row['serial_no'];

        $nextInvoiceNo = str_pad($nextInvoiceNo, 7, '0', STR_PAD_LEFT);

        $txtInv = $nextInvoiceNo . " (" . (($toInvNo - $nextInvoiceNo) + 1) . ' left)';
    }
    $payment = BeanFactory::getBean('J_Payment',$payment_id);
    $contacts = BeanFactory::getBean('Contacts', $payment->contacts_j_payment_1contacts_ida);

    if($payment->is_corporate){
        $account = BeanFactory::getBean('Accounts', $payment->account_id);
    }
    //lay danh sach item
    $qDescriptionCourseFee = "SELECT
    IFNULL(l1.description, '') l1_description,
    (CASE WHEN IFNULL(l2.ext_invoice_content, '') <> '' THEN IFNULL(l2.ext_invoice_content, '')
    ELSE IFNULL(l1.ext_content_1, '')
    END) as ext_content_1,
    IFNULL(l1.ext_content_2, '') ext_content_2
    FROM j_payment
    INNER JOIN j_coursefee_j_payment_2_c l1_1 ON j_payment.id = l1_1.j_coursefee_j_payment_2j_payment_idb AND l1_1.deleted = 0
    INNER JOIN j_coursefee l1 ON l1.id = l1_1.j_coursefee_j_payment_2j_coursefee_ida AND l1.deleted = 0
    LEFT JOIN j_payment_j_discount_1_c l2_1 ON j_payment.id = l2_1.j_payment_j_discount_1j_payment_ida AND l2_1.deleted = 0
    LEFT JOIN j_discount l2 ON l2.id = l2_1.j_payment_j_discount_1j_discount_idb AND l2.deleted = 0
    WHERE j_payment.id='{$payment_id}' AND j_payment.deleted=0";
    $rowDescriptionCourseFee = $GLOBALS['db']->fetchOne($qDescriptionCourseFee);

    $descriptionCourseFee = $rowDescriptionCourseFee['l1_description'];
    $ext_content_1 = $rowDescriptionCourseFee['ext_content_1'];
    $ext_content_2 = $rowDescriptionCourseFee['ext_content_2'];

    $related_payments = json_decode(html_entity_decode($payment->payment_list),true);
    //get list payment id
    $payId = array();
    $payId[] = $payment->id;
    foreach($related_payments["deposit_list"] as $pay_id => $value)
        $payId[] = $pay_id;

    //Get list Payment Detail
    $q1 = "(SELECT DISTINCT
    IFNULL(pmd.id, '') primaryId,
    IFNULL(pmd.status, '') status,
    IFNULL(pmd.discount_amount + pmd.sponsor_amount + pmd.loyalty_amount,0) discount_amount,
    IFNULL(pmd.payment_amount, '0') payment_amount
    FROM j_paymentdetail pmd
    INNER JOIN j_payment l1 ON pmd.payment_id = l1.id AND l1.deleted = 0
    WHERE pmd.payment_id IN ('".implode("','",$payId)."') AND pmd.deleted = 0 AND pmd.status IN ('Unpaid','Paid')
    AND (pmd.invoice_id = '' OR pmd.invoice_id IS NULL))
    UNION DISTINCT
    (SELECT DISTINCT
    IFNULL(l3.id, '') primaryId,
    IFNULL(l3.status, '') status,
    IFNULL(l3.discount_amount + l3.sponsor_amount + l3.loyalty_amount,0) discount_amount,
    IFNULL(l3.payment_amount, 0) payment_amount
    FROM j_payment
    INNER JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
    INNER JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb AND l1.deleted = 0
    INNER JOIN j_payment_j_payment_1_c l2_1 ON l1.id = l2_1.j_payment_j_payment_1j_payment_ida AND l2_1.deleted = 0
    INNER JOIN j_payment l2 ON l2.id = l2_1.j_payment_j_payment_1j_payment_idb AND l2.deleted = 0
    INNER JOIN j_paymentdetail l3 ON l2.id = l3.payment_id AND l3.deleted = 0
    WHERE (j_payment.id IN ('".implode("','",$payId)."'))
    AND (IFNULL(j_payment.payment_type, '') IN ('Transfer In' , 'Moving In'))
    AND j_payment.deleted = 0
    AND l3.status IN ('Unpaid' , 'Paid')
    AND (l3.invoice_id = ''
    OR l3.invoice_id IS NULL))";
    $rs1 = $GLOBALS['db']->query($q1);
    $totalAmount     = 0;
    while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
        $totalAmount    += $row['payment_amount'];
    }


    if ((strpos($contacts->primary_address_street, $contacts->primary_address_state) !== FALSE)
    && (strpos($contacts->primary_address_street, $contacts->primary_address_city) !== FALSE)) {
        $buyerAddressLine = $contacts->primary_address_street;
    } else {
        $buyerAddressLine = $contacts->primary_address_street . "<br>" . ((!empty($contacts->primary_address_postalcode)) ? ($contacts->primary_address_postalcode . ", ") : "")
        . $contacts->primary_address_state. ", "
        . $contacts->primary_address_city. ", "
        . $contacts->primary_address_country;
    }

    return json_encode(array(
        "success" => "1",
        "txtInv" => $txtInv,
        "nextInvoiceNo" => $nextInvoiceNo,
        "serial" => $serial,
        "status" => $status,
        "fullStudentName" => $contacts->full_student_name,
        "guardianName" => $contacts->guardian_name,
        "guardianName2" => $contacts->guardian_name_2,
        "BuyerDisplayName" => ($payment->is_corporate) ? $account->name : '',
        "buyerAddressLine" => ($payment->is_corporate) ? $account->billing_address_street : $buyerAddressLine,
        "BuyerTaxCode" => ($payment->is_corporate) ? $account->tax_code : '',
        "buyerEmail" => $contacts->email1,
        "is_corporate" => $payment->is_corporate,
        "displayID" => ($payment->is_corporate) ? $account->id : '',
        "buyerID" => $contacts->id,
        "itemName" => $descriptionCourseFee,
        "extContent1" => $ext_content_1,
        "extContent2" => $ext_content_2,
        "totalAmount" => $totalAmount,
    ));
}

function addEvatCorporate($payment_id='', $account_id='', $action= '' ){
    if(!empty($payment_id)){
        $payment = BeanFactory::getBean('J_Payment', $payment_id);
        if($action == 'add'){
            $payment->is_corporate = '1';
            $payment->account_id = $account_id;
            $payment->save();
        }elseif($action == 'delete')  {
            $payment->is_corporate = '0';
            $payment->account_id = '';
            $payment->save();
        }
        return json_encode(array(
            "success" => "1",
        ));
    }else{
        return json_encode(array(
            "success" => "0",
        ));
    }
}

function ajaxUpdatePaymentDetail($payment_detail_id = '', $payment_amount = '', $payment_method = '', $card_type = '', $bank_type = '', $payment_date = '', $method_note = '', $handle_action = '')
{
    global $timedate;
    if(empty($payment_detail_id))
        return json_encode(array(
            "success" => "0",
            "errorLabel" => 'Something went wrong. Please, Try again!!',
        ));
    else
        $pmd = BeanFactory::getBean('J_PaymentDetail',$payment_detail_id);

    if(unformat_number($payment_amount) < 1000){
        return json_encode(array(
            "success" => "0",
            "errorLabel" => 'Invalid Input Grand Total',
        ));
    }
    //TH thay đổi Amount - Xóa tạo lại Unpaid
    if($payment_amount != $pmd->payment_amount){
        $diffAmount = $pmd->payment_amount - $payment_amount;

        $pmd->payment_amount    = $payment_amount;
        $pmd->before_discount   = $payment_amount + $pmd->discount_amount + $pmd->sponsor_amount + $pmd->loyalty_amount;

        //Cộng tiền Difff
        $q2 = "SELECT DISTINCT
        IFNULL(id, '') primaryId,
        IFNULL(payment_amount, '0') payment_amount,
        IFNULL(before_discount, '0') before_discount,
        IFNULL(discount_amount, '0') discount_amount,
        IFNULL(sponsor_amount, '0') sponsor_amount,
        IFNULL(loyalty_amount, '0') loyalty_amount,
        IFNULL(payment_date, '') payment_date,
        IFNULL(serial_no, '') serial_no,
        IFNULL(numeric_vat_no, '0') numeric_vat_no,
        IFNULL(invoice_id, '') invoice_id,
        IFNULL(is_discount, '0') is_discount
        FROM j_paymentdetail
        WHERE payment_id = '{$pmd->payment_id}' AND id <> '$payment_detail_id' AND deleted = 0 AND status = 'Unpaid'
        ORDER BY payment_no";
        $res2 = $GLOBALS['db']->query($q2);

        while ($rowPayDtl = $GLOBALS['db']->fetchByAssoc($res2)){
            $newP = BeanFactory::getBean('J_PaymentDetail',$rowPayDtl['primaryId']);
            $newP->payment_amount += $diffAmount;
            if($newP->payment_amount > 0){
                $newP->before_discount = $newP->payment_amount+ $newP->discount_amount + $newP->sponsor_amount + $newP->loyalty_amount;
                $newP->save();
                $diffAmount = 0;
                break;
            }

            if($newP->payment_amount <= 0){
                $newP->mark_deleted($newP->id);
                $diffAmount = $newP->payment_amount;
            }
        }
        if($diffAmount > 0){ // Create Payment Unpaid
            $res2 = $GLOBALS['db']->query($q2);
            $pmdn = BeanFactory::newBean('J_PaymentDetail');
            foreach ($pmdn->field_defs as $keyField => $aFieldName)
                $pmdn->$keyField = $pmd->$keyField;

            $pmdn->payment_no      = $pmd->payment_no + 1;
            $pmdn->id              = '';
            $pmdn->name            = '-none-';
            $pmdn->payment_date    = $payment_date;
            $pmdn->expired_date    = $pmd->expired_date;
            $pmdn->is_discount     = 0;
            $pmdn->discount_amount = 0;
            $pmdn->sponsor_amount  = 0;
            $pmdn->loyalty_amount  = 0;
            $pmdn->before_discount  = format_number($diffAmount);
            $pmdn->payment_amount   = format_number($diffAmount);
            $pmdn->status           = 'Unpaid';
            $pmdn->type             = 'Normal';

            if(unformat_number($pmdn->payment_amount) > 0)
                $pmdn->save();
        }
    }


    $payment_date       = $timedate->convertToDBDate($payment_date, false);
    $_fee               = 0;
    $m_note             = '';
    if ($payment_method == 'Card'){
        $_fee           = floatval($GLOBALS['app_list_strings']['card_rate'][$card_type]) * $pmd->payment_amount / 100;
        $bank_account   = $_POST['bank_account'];
    }elseif ($payment_method == 'Bank Transfer') {
        $_fee           = floatval($GLOBALS['app_list_strings']['bank_rate'][$bank_type]) * $pmd->payment_amount / 100;
        $card_type      = $bank_type;
        $bank_account   = $_POST['bank_account'];
    } elseif ($payment_method == 'Other')
        $m_note         = $method_note;
    else{
        $bank_account   = '';
        $card_type      = '';
    }
    $pmd->payment_method    = $payment_method;
    $pmd->payment_method_fee= format_number($_fee);
    $pmd->status            = 'Paid';
    $pmd->payment_date      = $payment_date;
    $pmd->card_type         = $card_type;
    $pmd->bank_account      = $bank_account;
    $pmd->inv_code      = strtoupper($_POST['inv_code']);
    if ($payment_method == 'Card')
        $pmd->pos_code      = strtoupper($_POST['pos_code']);
    else
        $pmd->pos_code      = '';


    $pmd->payment_amount    = format_number(unformat_number($payment_amount));
    $pmd->reference_document= $_POST['reference_document'];
    $pmd->reference_number  = $_POST['reference_number'];
    $pmd->method_note       = $m_note;
    $pmd->description       = $_POST['description'];
    $pmd->assigned_user_id  = $GLOBALS['current_user']->id;
    $pmd->save();

    //Tính tổng số tiền đã trả
    $q2 = "SELECT DISTINCT
    IFNULL(id, '') primaryId,
    IFNULL(payment_no, '') payment_no,
    IFNULL(status, '') status,
    IFNULL(payment_amount, '0') payment_amount
    FROM j_paymentdetail
    WHERE payment_id = '{$pmd->payment_id}'
    AND deleted <> 1
    AND status <> 'Cancelled'
    ORDER BY payment_no";
    $res2 = $GLOBALS['db']->query($q2);
    $paidAmount     = 0;
    $unpaidAmount   = 0;
    $countpmd       = 0;
    while ($rowPayDtl = $GLOBALS['db']->fetchByAssoc($res2)) {
        if ($rowPayDtl['status'] == "Unpaid")
            $unpaidAmount += $rowPayDtl['payment_amount'];
        else
            $paidAmount += $rowPayDtl['payment_amount'];
        $countpmd++;
    }

    $GLOBALS['db']->query("UPDATE j_payment SET number_of_payment = $countpmd WHERE id = '{$pmd->payment_id}'");

    //check last pay receipt
    $payment = BeanFactory::getBean('J_Payment', $pmd->payment_id);
    if (!empty($payment->id)) {
        $q1 = "SELECT
        IFNULL(l1.id,'') payment_id,
        IFNULL(l1.sale_type,'') sale_type,
        l1.sale_type_date sale_type_date,
        SUM(pmd.payment_amount) sum_pmd_amount
        FROM j_paymentdetail pmd
        INNER JOIN j_payment l1 ON pmd.payment_id = l1.id AND l1.deleted = 0
        WHERE l1.id = '{$payment->id}'  AND pmd.deleted = 0 AND pmd.status = 'Paid'
        GROUP BY l1.id";
        $rs1 = $GLOBALS['db']->query($q1);
        $rowPay = $GLOBALS['db']->fetchByAssoc($rs1);

        $qCheckConfigEvat = "SELECT COUNT(*) FROM j_configinvoiceno
        WHERE active = 1 AND team_id = '{$payment->team_id}' AND deleted = 0";
        $checkConfigEvat = $GLOBALS['db']->getOne($qCheckConfigEvat);
        $last_pay_receipt = 0;
        if (((int)$checkConfigEvat) > 0 && $payment->payment_type != 'Deposit' && $rowPay['sum_pmd_amount'] == $payment->payment_amount && $payment->payment_amount > 0 && empty($payment->invoice_id)) {
            $last_pay_receipt = 1;
        }

        $sale_type = $rowPay['sale_type'];
        $sale_type_date = $rowPay['sale_type_date'];
    }

    return json_encode(array(
        "success" => "1",
        "paid" => format_number($paidAmount),
        "unpaid" => format_number($unpaidAmount),
        "remain_amount" => format_number($payment->remain_amount),
        "remain_hours" => format_number($payment->remain_hours,2,2),
        "sale_type" => $sale_type,
        "sale_type_date" => $timedate->to_display_date($sale_type_date,false),
        "last_pay_receipt" => $last_pay_receipt,
    ));

}

function ajaxUndoPayment($paymentId = '', $paymentType = '')
{
    require_once('custom/include/_helper/junior_class_utils.php');
    //Get bean of payemtn out & payment in
    if ($paymentType == "Refund") {
        $paymentOutId = $paymentId;
        $paymentOutBean = BeanFactory::getBean("J_Payment", $paymentId);
    } else {
        if (in_array($paymentType, array("Transfer In", "Moving In"))) {
            $paymentInId = $paymentId;
            $paymentInBean = BeanFactory::getBean("J_Payment", $paymentId);
            $paymentOutId = $paymentInBean->payment_out_id;
            $paymentOutBean = BeanFactory::getBean("J_Payment", $paymentOutId);
        } else { //Transfer out, moving out
            $paymentOutId = $paymentId;
            $paymentOutBean = BeanFactory::getBean("J_Payment", $paymentId);
            $paymentOutBean->load_relationship("ju_payment_in");
            $paymentInBean = reset($paymentOutBean->ju_payment_in->getBeans());
            $paymentInId = $paymentInBean->id;
        }
    }

    $fromStudentId = $paymentOutBean->contacts_j_payment_1contacts_ida;

    //TODO - check remain amount of payment in, if remain != payment amount -> die();
    if ($paymentInBean->remain_amount != $paymentInBean->payment_amount) {
        return json_encode(array(
            "success" => "0",
        ));
    }

    //TODO - restore ralated payment
    $sqlRelatedPay = "SELECT
    DISTINCT j_payment_j_payment_1j_payment_idb id,
    amount,
    hours
    FROM j_payment_j_payment_1_c
    WHERE j_payment_j_payment_1j_payment_ida = '{$paymentOutId}'
    AND deleted = 0";
    $resultRealtedPay = $GLOBALS['db']->query($sqlRelatedPay);
    while ($rowRelatedPay = $GLOBALS['db']->fetchByAssoc($resultRealtedPay)) {
        $pay_id = $rowRelatedPay["id"];
        $hours = $rowRelatedPay["hours"];
        $amount = $rowRelatedPay["amount"];

        $payment_drop_id = $pay_id;
        // Cộng giờ và tiền revenue
        if ($paymentType == "Refund") {
            $sqlDelRevenue = "SELECT amount, duration FROM c_deliveryrevenue WHERE ju_payment_id = '$payment_drop_id' AND deleted <> 1";
            $rs_re = $GLOBALS['db']->query($sqlDelRevenue);
            while ($row_re = $GLOBALS['db']->fetchByAssoc($rs_re)) {
                $hours += $row_re['duration'];
                $amount += $row_re['amount'];
            }
        }
        $hours = unformat_number(format_number($hours, 2, 2));
        $amount = unformat_number(format_number($amount));
        $sqlUpdatePay = "UPDATE j_payment
        SET
        used_amount     = used_amount - $amount,
        used_hours      = used_hours - $hours,
        remain_amount   = remain_amount + $amount,
        remain_hours    = remain_hours + $hours
        WHERE id = '$pay_id'
        AND deleted <> 1";

        $GLOBALS['db']->query($sqlUpdatePay);

        //UNDO REFUND: delete revenue record
        if ($paymentType == "Refund") {
            $sqlDelRevenue = "UPDATE c_deliveryrevenue SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}'
            WHERE ju_payment_id = '{$payment_drop_id}'
            AND deleted = 0 AND passed = 0";
            $GLOBALS['db']->query($sqlDelRevenue);
        }
    }


    //Delete relationship payment - related payment record
    removeRelatedPayment($paymentOutId);

    //Delete payment out & payment in  , Remove Relationship Contact - Payment
    $sqlDelPayment = "UPDATE j_payment
    SET deleted = 1
    WHERE id = '{$paymentOutId}'";
    $GLOBALS['db']->query($sqlDelPayment);

    $GLOBALS['db']->query("UPDATE contacts_j_payment_1_c
        SET deleted = 1
        WHERE contacts_j_payment_1j_payment_idb = '{$paymentOutId}'");

    if (!empty($paymentInId)) {
        $sqlDelPayment_2 = "UPDATE j_payment
        SET deleted = 1
        WHERE id = '{$paymentInId}'";
        $GLOBALS['db']->query($sqlDelPayment_2);

        $GLOBALS['db']->query("UPDATE contacts_j_payment_1_c
            SET deleted = 1
            WHERE contacts_j_payment_1j_payment_idb = '{$paymentInId}'");
    }


    //UNDO MOVING: Set primary team for student
    if (in_array($paymentType, array("Moving Out", "Moving In"))) {
        $studentBean = BeanFactory::getBean("Contacts", $fromStudentId);
        $studentBean->team_id = $paymentOutBean->team_id;
        $studentBean->save();
    }

    return json_encode(array(
        "success" => "1",
    ));
}

function finish_printing($printing_id = '')
{
    if (!empty($printing_id)) {
        //Update finish finish printing
        $GLOBALS['db']->query("UPDATE j_configinvoiceno SET finish_printing = 1, pmd_id_printing='' WHERE deleted = 0 AND id= '$printing_id'");

        return json_encode(array(
            "success" => "1",
        ));
    } else
        return json_encode(array(
            "success" => "0",
        ));

}

function caculateDropPayment($payment_id = '', $dl_date = '')
{
    $payment = BeanFactory::getBean('J_Payment', $payment_id);
    // Get Total amount
    $row1 = get_list_payment_detail($payment_id);
    $total_amount = 0;
    for ($i = 0; $i < count($row1); $i++)
        $total_amount += $row1[$i]['payment_amount'];
    if ($payment->payment_type == 'Enrollment')
        $total_amount += $payment->paid_amount + $payment->deposit_amount;

    if ($payment->payment_type == 'Cashholder')
        $total_amount += $payment->paid_amount + $payment->deposit_amount;

    if ($payment->payment_type == 'Delay' || $payment->payment_type == 'Transfer In' || $payment->payment_type == 'Moving In' || $payment->payment_type == 'Deposit' || $payment->payment_type == 'Schedule Change')
        $total_amount = $payment->payment_amount;
    $price = (($payment->payment_amount + $payment->paid_amount + $payment->deposit_amount) / ($payment->total_hours + $payment->paid_hours));

    // Get Used amount
    $row2 = get_total_revenue($payment->contacts_j_payment_1contacts_ida, "'Enrolled', 'Moving In'", '', $dl_date, '', '', $payment_id, 'Planning');
    $used_amount = 0;
    for ($i = 0; $i < count($row2); $i++)
        $used_amount += $row2[$i]['total_revenue'];
    $sql_get_delay = "SELECT
    SUM(pp.amount) amount
    FROM
    j_payment_j_payment_1_c pp
    INNER JOIN
    j_payment p ON p.id = pp.j_payment_j_payment_1j_payment_ida
    AND p.deleted = 0
    AND pp.deleted = 0
    #AND p.payment_type = 'Delay'
    AND pp.j_payment_j_payment_1j_payment_idb = '{$payment->id}'
    GROUP BY pp.j_payment_j_payment_1j_payment_idb";
    $delay_amount = $GLOBALS['db']->getOne($sql_get_delay);
    /*if($payment->payment_type != 'Enrollment')
    $used_amount += $payment->payment_amount - $payment->remain_amount;
    else*/
    $used_amount += $delay_amount;
    return json_encode(array(
        "success" => "1",
        "total_amount" => format_number($total_amount),
        "used_amount" => format_number($used_amount),
        "drop_amount" => format_number($total_amount - $used_amount),
        "drop_hour" => format_number(($total_amount - $used_amount) / $price, 2, 2),
        "drop_amount_raw" => ($total_amount - $used_amount),
        "drop_hour_raw" => unformat_number(format_number(($total_amount - $used_amount) / $price, 2, 2)),
    ));
}

function createDropPayment()
{
    global $current_user, $timedate;
    require_once('custom/include/_helper/junior_class_utils.php');

    $payment = BeanFactory::getBean('J_Payment', $_POST['payment_id']);
    $unit_price = ($payment->payment_amount + $payment->deposit_amount + $payment->paid_amount) / ($payment->total_hours + $payment->paid_hours);
    if ($_POST['drop_amount'] < 0)
        return json_encode(array(
            "success" => "0",
        ));

    if ($_POST['drop_type'] == 'drop_to_delay') {
        //Payment Delay
        $pm_delay = new J_Payment();
        $pm_delay->contacts_j_payment_1contacts_ida = $payment->contacts_j_payment_1contacts_ida;
        $pm_delay->payment_type = 'Delay';
        $pm_delay->use_type = "Amount";

        $pm_delay->payment_date = $_POST['dl_date'];
        $pm_delay->payment_expired = date('Y-m-d', strtotime("+6 months " . $timedate->convertToDBDate($_POST['dl_date'], false)));
        $pm_delay->payment_amount = format_number($_POST['drop_amount']);
        $pm_delay->remain_amount = format_number($_POST['drop_amount']);
        $pm_delay->tuition_hours = format_number($_POST['drop_hour'], 2, 2);
        $pm_delay->total_hours = format_number($_POST['drop_hour'], 2, 2);
        $pm_delay->remain_hours = 0; //fIX SO GIO rEMAIN
        $pm_delay->used_hours = 0;
        $pm_delay->used_amount = 0;
        $pm_delay->description = $_POST['dl_reason'];
        $pm_delay->assigned_user_id = $current_user->id;
        $pm_delay->team_id = $payment->team_id;
        $pm_delay->team_set_id = $payment->team_id;
        $pm_delay->save();

        addRelatedPayment($pm_delay->id, $payment->id, $_POST['drop_amount'], $_POST['drop_hour']);
        //Remove student from Session

    } elseif ($_POST['drop_type'] == 'drop_to_revenue') {
        $delivery = new C_DeliveryRevenue();
        $delivery->name = 'Drop revenue from payment ' . $payment->name;
        $delivery->student_id = $payment->contacts_j_payment_1contacts_ida;
        //Get Payment ID
        $delivery->ju_payment_id = $payment->id;
        $delivery->type = 'Junior';
        $delivery->amount = format_number($_POST['drop_amount']);
        $delivery->duration = format_number($_POST['drop_amount'] / $unit_price, 2, 2);
        $delivery->date_input = $timedate->convertToDBDate($_POST['dl_date'], false);
        $delivery->cost_per_hour = 0;
        $delivery->session_id = '1';
        $delivery->passed = 0;
        $delivery->description = $_POST['dl_reason'];
        $delivery->team_id = $payment->team_id;
        $delivery->team_set_id = $payment->team_id;
        $delivery->cost_per_hour = $unit_price;
        $delivery->assigned_user_id = $current_user->id;
        $delivery->revenue_type = 'Enrolled';
        $delivery->save();
    }
    //    if ($payment->payment_type == 'Enrollment') {
    //        $remove_from_date_db = $timedate->to_display_date(date('Y-m-d', strtotime("+1 day " . $timedate->convertToDBDate($_POST['dl_date'], false))), false);
    //        $row2 = get_list_revenue('', "'Enrolled', 'Moving In'", $remove_from_date_db, '', '', '', '', $_POST['payment_id'], false, 'Planning');
    //        $arr_situation = array();
    //        $remove_date_db = $timedate->convertToDBDate($remove_from_date_db, false);
    //        if (!empty($row2)) {
    //            for ($i = 0; $i < count($row2); $i++) {
    //                removeJunFromSession($row2[$i]['situation_id'], $row2[$i]['primaryid']);
    //                if (!in_array($row2[$i]['situation_id'], $arr_situation))
    //                    $arr_situation[] = $row2[$i]['situation_id'];
    //            }
    //            foreach ($arr_situation as $key => $value) {
    //                $situ = BeanFactory::getBean('J_StudentSituations', $value);
    //                if ($remove_date_db < $situ->end_study && $situ->start_study > $remove_date_db)
    //                    $situ->end_study = $remove_from_date_db;
    //                else $situ->deleted = 1;
    //                $situ->save();
    //            }
    //        }
    //    }
    $GLOBALS['db']->query("UPDATE j_payment SET status='Closed', remain_hours = 0, remain_amount = 0, do_not_drop_revenue=0 WHERE id = '{$payment->id}'");
    return json_encode(array(
        "success" => "1",
    ));
}

function ajaxConvertPayment()
{
    global $timedate, $current_user;
    $tuition_hours      = unformat_number($_POST['tuition_hours']);
    $remain_hours       = unformat_number($_POST['remain_hours']);
    $convert_to_type    = $_POST['convert_to_type'];
    $payment_id         = $_POST['payment_id'];
    $payment = BeanFactory::getBean('J_Payment', $payment_id);
    if (!empty($payment_id) || empty($payment)) {
        $new_payment_type = $payment->payment_type;
        if($convert_to_type == 'To Hour'){
            if($payment->payment_type == 'Deposit')
                $new_payment_type = 'Cashholder';

            $GLOBALS['db']->query("UPDATE j_payment SET tuition_hours=$tuition_hours, total_hours=$tuition_hours, remain_hours=$remain_hours, use_type='Hour', payment_type='$new_payment_type', note='{$payment->payment_type} has been Converted to $new_payment_type - " . $timedate->now() . " by {$current_user->user_name}' WHERE id='$payment_id'");
        }else{
            if($payment->payment_type == 'Cashholder')
                $new_payment_type = 'Deposit';
            if( (($new_payment_type == 'Deposit') && ($payment->payment_amount != $payment->remain_amount)) || $payment->use_type == 'Amount' )
                return json_encode(array(
                    "success" => "0",
                ));
            $GLOBALS['db']->query("UPDATE j_payment SET tuition_hours=$tuition_hours, total_hours=$tuition_hours, remain_hours=$remain_hours, use_type='Amount', payment_type='$new_payment_type', note='{$payment->payment_type} has been Converted to $new_payment_type - (Old Total Hour - Remain Hour : {$payment->tuition_hours} - {$payment->remain_hours}) " . $timedate->now() . " by {$current_user->user_name}' WHERE id='$payment_id'");
        }

        return json_encode(array(
            "success" => "1",
        ));

    }else
        return json_encode(array(
            "success" => "0",
        ));
}

// ------------------------------------NEW--------------------------------------------------\\
function ajaxCheckVoucherCode($code){
    global $timedate, $app_list_strings;
    $today = $timedate->nowDate();

    if (!empty($code)) {
        $q1 = "(SELECT DISTINCT
        IFNULL(j_voucher.id, '') voucher_id,
        IFNULL(j_voucher.name, '') sponsor_number,
        IFNULL(j_voucher.foc_type, '') foc_type,
        IFNULL(j_voucher.status, '') status,
        '' student_name,
        'Sponsor' type,
        IFNULL(j_voucher.use_time, '') use_time,
        j_voucher.used_time voucher_used_time,
        IFNULL(j_voucher.discount_amount, 0) discount_amount,
        IFNULL(j_voucher.discount_percent, 0) discount_percent,
        0 loyalty_points,
        j_voucher.description description,
        j_voucher.start_date start_date,
        j_voucher.end_date end_date,
        COUNT(l2.id) used_time
        FROM j_voucher
        LEFT JOIN  j_sponsor l2 ON j_voucher.id=l2.voucher_id AND l2.deleted=0
        WHERE (j_voucher.name = '$code') AND (j_voucher.end_date >= $today) AND j_voucher.deleted = 0
        GROUP BY j_voucher.id)
        UNION DISTINCT
        ( SELECT DISTINCT
        IFNULL(contacts.id, '') voucher_id,
        IFNULL(contacts.contact_id, '') sponsor_number,
        'Referral' foc_type,
        contacts.referral_status status,
        IFNULL(contacts.full_student_name, '') student_name,
        'Loyalty' type,
        'N' use_time,
        '' voucher_used_time,
        0 discount_amount,
        0 discount_percent,
        500 loyalty_points,
        'Phụ huynh giới thiệu bạn thành công - Tặng 500 điểm tích lũy' description,
        'N/A' start_date,
        'N/A' end_date,
        COUNT(l2.id) used_time
        FROM contacts
        LEFT JOIN  j_sponsor l2 ON contacts.contact_id=l2.sponsor_number AND l2.deleted=0
        WHERE (contacts.contact_id = '$code') AND (contacts.id <> '{$_POST['student_id']}') AND contacts.deleted = 0
        GROUP BY sponsor_number
        )
        ";
        $rs1 = $GLOBALS['db']->query($q1);
        $row = $GLOBALS['db']->fetchByAssoc($rs1);

        if (!empty($row)){

            if(!empty($row['student_name']))
                $row['student_name'] = '<a  href="#bwc/index.php?module=Contacts&action=DetailView&record=' . $row['student_id'] . '">' . $row['student_name'] . '</a>';

            $status = $row['status'];
            if($row['use_time'] != 'N' && $row['used_time'] >= $row['use_time'])
                $status = 'Expired';

            if( ($row['end_date'] != 'N/A') && ($today > $row['end_date']) )
                $status = 'Expired';

            if($status != $row['status'] && $row['type'] == 'Sponsor'){
                $row['status'] = $status;
                $GLOBALS['db']->query("UPDATE j_voucher SET status='$status' WHERE id = '{$row['voucher_id']}'");
            }

            if($row['status'] == 'Expired' || $row['status'] == 'Inactive' ) $color = 'red';
            else $color = 'green';


            //Update Used !
            if ($row['voucher_used_time'] != $row['used_time'] && $row['type'] == 'Sponsor')
                $GLOBALS['db']->query("UPDATE j_voucher SET used_time={$row['used_time']} WHERE id = '{$row['voucher_id']}'");

            return json_encode(array(
                "success" => "1",
                "voucher_id"        => $row['voucher_id'],
                "voucher_code"      => $row['voucher_code'],
                "sponsor_number"    => $row['sponsor_number'],
                "loyalty_points"    => $row['loyalty_points'],
                "foc_type"          => $row['foc_type'],
                "status_color"      => '<br>Status: <b style="color:'.$color.';"> '. $app_list_strings['voucher_status_dom'][$row['status']].'</b>',
                "status"            => $row['status'],
                "type"              => $row['type'],
                "student_name"      => $row['student_name'],
                "used_time"         => $row['used_time'].' / '.$row['use_time'],
                "discount_amount"   => format_number($row['discount_amount']),
                "discount_percent"  => format_number($row['discount_percent'], 2, 2),
                "description"       => $row['description'],
                "start_date"        => $row['start_date'],
                "end_date"          => $row['end_date'],
            ));

        }else return json_encode(array("success" => "0",));

    } else
        return json_encode(array("success" => "0",));

}


function ajax_payment_detail(){
    global $timedate;
    $eid_from   = $timedate->convertToDBDate($_POST['eid_from'],false);
    $eid_to     = $timedate->convertToDBDate($_POST['eid_to'],false);
    $payment_id = $_POST['record_id'];
    $invoice_id = $_POST['invoice_id'];
    $eid_invoice_date = $_POST['eid_invoice_date'];
    $team_id    = $GLOBALS['current_user']->team_id;
    if (!empty($payment_id)) {
        $ext_inv = '';
        if(!empty($invoice_id)) $ext_inv =  " OR (l3.invoice_id = '$invoice_id')"; //Edit case

        $payment = BeanFactory::getBean('J_Payment', $payment_id);
        if($payment->parent_type == 'Leads'){
            $student_id = $payment->lead_id;
            $ext_query = "leads INNER JOIN
            j_payment l2 ON l2.lead_id = leads.id AND (leads.id = '$student_id')
            AND l2.deleted = 0";
        }else{
            $student_id = $payment->contacts_j_payment_1contacts_ida;
            $ext_query = "contacts INNER JOIN
            contacts_j_payment_1_c l2_1 ON contacts.id = l2_1.contacts_j_payment_1contacts_ida
            AND (contacts.id = '$student_id') AND l2_1.deleted = 0
            INNER JOIN
            j_payment l2 ON l2.id = l2_1.contacts_j_payment_1j_payment_idb
            AND l2.deleted = 0";
        }

        $q1 = "SELECT DISTINCT
        IFNULL(l2.id, '') l2_id,
        IFNULL(l2.name, '') l2_name,
        IFNULL(l2.payment_type, '') l2_payment_type,
        IFNULL(l3.id, '') l3_id,
        l3.payment_no l3_payment_no,
        IFNULL(l3.status, '') l3_status,
        IFNULL(l3.invoice_id, '') l3_invoice_id,
        IFNULL(l4.id, '') team_id,
        l3.payment_date l3_payment_date,
        IFNULL(l3.before_discount, 0) l3_before_discount,
        IFNULL(l3.discount_amount, 0) l3_discount_amount,
        IFNULL(l3.sponsor_amount, 0) l3_sponsor_amount,
        IFNULL(l3.loyalty_amount, 0) l3_loyalty_amount,
        IFNULL(l3.payment_amount, 0) l3_payment_amount,
        IFNULL(l3.name, '') l3_name
        FROM
        $ext_query
        INNER JOIN
        j_paymentdetail l3 ON l2.id = l3.payment_id AND l3.deleted = 0
        INNER JOIN
        teams l4 ON l2.team_id = l4.id
        AND l4.deleted = 0
        WHERE
        ((((l2.payment_date >= '$eid_from'
        AND l2.payment_date <= '$eid_to'))
        AND (l3.status IN ('Paid', 'Unpaid'))
        AND ((l3.invoice_id IS NULL
        OR l3.invoice_id = ''))
        $ext_inv))
        ORDER BY CASE WHEN l2.payment_type='Enrollment' THEN 0
        WHEN l2.payment_type='Cashholder' THEN 1
        WHEN l2.payment_type='Deposit' THEN 2
        WHEN l2.payment_type='Placement Test' THEN 10
        WHEN l2.payment_type='Product' THEN 11 ELSE 16 END ASC,
        l2_id, l3_payment_date DESC";
        $rs1 = $GLOBALS['db']->query($q1);
        $html = '';
        $count = 0;

        while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
            $count++;
            $checked = '';
            if(!empty($invoice_id)){
                if($row['l3_invoice_id'] == $invoice_id)
                    $checked = 'checked';
            }elseif($row['l2_id'] == $payment_id) $checked = 'checked';
            $team_id = $row['team_id'];
            $html .= '<tr>';
            $html .= '<td class="center"><input type="checkbox" '.$checked.' style="vertical-align: initial;zoom: 1.2;" id="eid_detail_id'.$count.'" class="eid_detail_id custom_checkbox" module_name="J_PaymentDetail" onclick="handleCheckBox($(this));calculateInvoice();" value="'.$row['l3_id'].'"/>';
            $html .= '<input type="hidden" class="edi_before_discount" value="'.$row['l3_before_discount'].'"/>';
            $html .= '<input type="hidden" class="edi_discount_amount" value="'.($row['l3_discount_amount'] + $row['l3_sponsor_amount'] + $row['l3_loyalty_amount']).'"/>';
            $html .= '<input type="hidden" class="edi_payment_amount" value="'.$row['l3_payment_amount'].'"/>';
            $html .= '</td>';
            $html .= '<td class="center" nowrap >'.$timedate->to_display_date($row['l3_payment_date'],false).'</td>';
            $html .= '<td class="center" nowrap >'.$row['l2_name'].'</td>';
            $html .= '<td class="center" nowrap >'.$row['l2_payment_type'].'</td>';
            $html .= '<td class="center" nowrap >'.format_number($row['l3_before_discount']).'</td>';
            $html .= '<td class="center" nowrap >'.format_number($row['l3_discount_amount'] + $row['l3_sponsor_amount'] + $row['l3_loyalty_amount']).'</td>';
            $html .= '<td class="center" nowrap >'.format_number($row['l3_payment_amount']).'</td>';
            $html .= '<td class="center" nowrap >'.$GLOBALS['app_list_strings']['status_paymentdetail_list'][$row['l3_status']].'</td>';
            $html .= '</tr>';
        }
        if($count == 0){
            $html .= '<td class="center" colspan="8">No Payment Avaiable</td>';
        }
        //Get Invoice No
        if(!empty($invoice_id)){   //Edit case
            $rs2 = $GLOBALS['db']->query("SELECT DISTINCT id, IFNULL(name, '') invoice_no, serial_no, invoice_date FROM j_invoice WHERE id = '$invoice_id'");
            $row2 = $GLOBALS['db']->fetchByAssoc($rs2);
        }else{
            $row2 = array(
                'invoice_date'  => date('Y-m-d'),
                'serial_no'     => '',
                'invoice_no'    => generateInvNo($team_id, date('Y-m-d')));
        }
        return json_encode(array(
            "success"   => "1",
            "html"      => $html,
            "count"     => $count,
            "invoice_id"    => $invoice_id,
            "invoice_date"  => $timedate->to_display_date($row2['invoice_date']),
            "serial_no"     => $row2['serial_no'],
            "invoice_no"    => $row2['invoice_no'],

        ));
    }else return json_encode(array("success" => "0",));

}

function ajaxSaveInvoice(){
    global $timedate;
    $eid_invoice_date    = $timedate->convertToDBDate($_POST['eid_invoice_date'],false);
    $idArray             = explode(",", $_POST['idsChecked']);
    $payment_id          = $_POST['record_id'];
    $invoice_id          = $_POST['invoice_id'];
    $eid_invoice_serial  = strtoupper($_POST['eid_invoice_serial']);
    $eid_invoice_no      = strtoupper($_POST['eid_invoice_no']);

    if(!empty($invoice_id)){  //Delete before Edit
        $GLOBALS['db']->query("UPDATE j_paymentdetail SET invoice_id='' WHERE invoice_id = '$invoice_id' AND deleted = 0");
        $GLOBALS['db']->query("UPDATE j_invoice SET deleted=1 WHERE id='$invoice_id' AND deleted = 0");
    }

    if (!empty($payment_id) && !empty($idArray)){

        $payment = BeanFactory::getBean('J_Payment', $payment_id);
        if($payment->parent_type == 'Leads'){
            $student_id = $payment->lead_id;
            $ext_query = "INNER JOIN
            leads l1 ON j_paymentdetail.student_id = l1.id
            AND l1.deleted = 0";
        }else{
            $student_id = $payment->contacts_j_payment_1contacts_ida;
            $ext_query = "INNER JOIN
            contacts l1 ON j_paymentdetail.student_id = l1.id
            AND l1.deleted = 0";
        }


        $q1 = "SELECT DISTINCT
        IFNULL(l1.id, '') l1_id,
        SUM(IFNULL(j_paymentdetail.before_discount, 0)) before_discount,
        SUM(IFNULL(j_paymentdetail.discount_amount + j_paymentdetail.sponsor_amount + j_paymentdetail.loyalty_amount,0)) discount_amount,
        SUM(IFNULL(j_paymentdetail.payment_amount, 0)) payment_amount,
        COUNT(j_paymentdetail.id) count
        FROM
        j_paymentdetail
        $ext_query
        WHERE (((j_paymentdetail.id IN('".implode("','",$idArray)."'))
        AND (j_paymentdetail.status IN ('Paid', 'Unpaid'))
        AND ((j_paymentdetail.invoice_id IS NULL
        OR j_paymentdetail.invoice_id = ''))))
        AND j_paymentdetail.deleted = 0
        GROUP BY l1.id
        ORDER BY l1_id ASC";
        $rs1 = $GLOBALS['db']->query($q1);
        $row = $GLOBALS['db']->fetchByAssoc($rs1);
        if(($row['before_discount'] == $_POST['eid_total_before_discount']) && ($row['discount_amount'] == $_POST['eid_total_discount_amount']) && ($row['payment_amount'] == $_POST['eid_total_after_discount'])){
            $payment = BeanFactory::getBean('J_Payment',$payment_id);
            $invNew = new J_Invoice();
            $invNew->name                   = $eid_invoice_no;
            $invNew->invoice_date           = $eid_invoice_date;
            $invNew->before_discount        = format_number($row['before_discount']);
            $invNew->total_discount_amount  = format_number($row['discount_amount']);
            $invNew->invoice_amount         = format_number($row['payment_amount']);
            $invNew->serial_no              = $eid_invoice_serial;
            $invNew->payment_id             = $payment_id;
            $invNew->team_id                = $payment->team_id;
            $invNew->team_set_id            = $payment->team_set_id;
            $invNew->assigned_user_id       = $payment->assigned_user_id;
            $invNew->save();
            //Update Receipt
            $GLOBALS['db']->query("UPDATE j_paymentdetail SET invoice_id='{$invNew->id}'  WHERE id IN ('".implode("','",$idArray)."') AND deleted = 0");
            $GLOBALS['db']->query("UPDATE j_payment SET invoice_id='{$invNew->id}'  WHERE id IN ('{$payment->id}') AND deleted = 0");

            return json_encode(array("success" => "1",));
        }else
            return json_encode(array("success" => "0",));

    }else return json_encode(array("success" => "0",));

}


function ajaxCancelInvoice($invoice_id = '', $payment_id = '',  $description = ''){
    require_once("custom/modules/J_Payment/_helper.php");
    $invoice = BeanFactory::getBean('J_Invoice', $invoice_id);
    $payment = BeanFactory::getBean('J_Payment',$payment_id);

    if(empty($invoice->id) || $invoice->status == 'Cancelled'){
        return json_encode(array(
            "success" => "0",
            "errorLabel" => "'Something went wrong. Please refresh and try again!!'",
        ));
    }

    //    //Check Before Cancel
    //    $count_used = $GLOBALS['db']->getOne("SELECT
    //        IFNULL(COUNT(id),0) count_used
    //        FROM j_payment_j_payment_1_c
    //        WHERE j_payment_j_payment_1j_payment_idb = '$payment_id'
    //        AND deleted = 0");
    //
    //    if ($count_used > 0)
    //        return json_encode(array(
    //            "success" => "0",
    //            "errorLabel" => "'This payment has been used for Enrollment. <br>You need to delete Enrollment using this amount then try to cancel again!!'",
    //        ));


    //Send API Delete
    if(!empty($invoice->id)){
        $e_vat_id = $GLOBALS['db']->getOne("SELECT id FROM j_configinvoiceno WHERE team_id = '{$invoice->team_id}' AND deleted = 0");
        if(!empty($e_vat_id)) {
            //Call API
            $evat = BeanFactory::getBean('J_ConfigInvoiceNo', $e_vat_id);
            if($evat->supplier == 'Bkav'){
                // Lay trang thai e-invoice
                $param2 = array(
                    "CmdType" =>801,
                    "CommandObject" => $invoice->invoiceGUID
                );
                $param3 = array(
                    "partnerGUID" => $evat->partnerGUID,
                    "CommandData"=> base64_encode(json_encode($param2)),
                );
                $res = GeneralEinvoice($evat,json_encode($param3));
                if($res['Status'] != 0){
                    $label_error = translate('LBL_EVAT_ERR','J_Payment') . '</br>' ;
                    return json_encode(
                        array(
                            "success"   => "0",
                            "label"     => $label_error,
                        )
                    );
                }
                else {
                    // Xoa HD chua phat hanh hoac huy HD da phat hanh
                    $param2 = array(
                        "CmdType" => 202,
                        "CommandObject" => array(
                            array(
                                "PartnerInvoiceStringID" => $payment->PartnerInvoiceStringID
                            )
                        )
                    );
                    if ($res['Content'] == 11 || $res['Content'] == 2){
                        $param3 = array(
                            "partnerGUID" => $evat->partnerGUID,
                            "CommandData"=> base64_encode(json_encode($param2)),
                        );
                        $res = GeneralEinvoice($evat,json_encode($param3));
                        if($res['Status'] != 0){
                            $label_error = translate('LBL_EVAT_ERR','J_Payment') . '</br>' ;
                            return json_encode(
                                array(
                                    "success"   => "0",
                                    "label"     => $label_error,
                                )
                            );
                        }
                    }

                }
            }
            if($evat->supplier == 'Misa'){
                //Get token
                $res = get_EvatToken($evat);
                if ($res['success']) {
                    $token = $res['token'];
                    $param['TransactionID']     = $invoice->transaction_id;
                    $param['RefDate']           = date('Y-m-d');
                    $param['RefNo']             = $invoice->name;
                    $param['DeletedReason']     = $description;

                    $param = json_encode($param);

                    $result = DeleteInvoice($evat, $param, $token);
                    if ($result['success']) {
                        $license_remove_id = $result['data'];
                    }else
                        return json_encode(
                            array(
                                "success" => "0",
                                "errorLabel" => translate('LBL_EVAT_ERR', 'J_Payment') . "</br>" . $res['errorCode'],
                        ));
                }else {
                    $label_error = translate('LBL_EVAT_ERR','J_Payment') . '</br>' . $res['errorCode'];
                    if(!empty($res['errorCodeDetail'])) $label_error = $label_error .' : '. $res['errorCodeDetail'];
                    return json_encode(
                        array(
                            "success"   => "0",
                            "errorLabel"     => $label_error,
                    ));
                }
            }
        }
        $payment->PartnerInvoiceStringID = $invoice->id;
        $invoice->status = 'Cancelled';
        $invoice->license_remove_id = $license_remove_id;
        $invoice->description = $description;
        $invoice->save();
        $payment->save();

        //remove Invoice ID
        $GLOBALS['db']->query("UPDATE j_paymentdetail SET invoice_id='' WHERE invoice_id = '{$invoice->id}' AND deleted = 0");
        $GLOBALS['db']->query("UPDATE j_payment SET invoice_id='' WHERE invoice_id = '{$invoice->id}' AND deleted = 0");


        return json_encode(array("success" => "1",));
    }else{
        return json_encode(array("success" => "0",));
    }
}

function ajaxCancelReceipt($payment_detail_id = '', $description = ''){
    require_once("custom/modules/J_Payment/_helper.php");

    $pmOld = BeanFactory::getBean('J_PaymentDetail', $payment_detail_id);

    $payment_id = $pmOld->payment_id;

    //check void e-invoice
    if(!empty($pmOld->invoice_id)){
        return json_encode(array(
            "success" => "0",
            "errorLabel" => "Failed to void e-invoice. Please void e-invoice before void receipt!",
        ));
    }

    if(empty($pmOld->id) || $pmOld->status == 'Cancelled'){
        return json_encode(array(
            "success" => "0",
            "errorLabel" => "'Something went wrong. Please refresh and try again!!'",
        ));
    }

    //Check Before Cancel
    $count_used = $GLOBALS['db']->getOne("SELECT
        IFNULL(COUNT(id),0) count_used
        FROM j_payment_j_payment_1_c
        WHERE j_payment_j_payment_1j_payment_idb = '$payment_id'
        AND deleted = 0");

    if ($count_used > 0)
        return json_encode(array(
            "success" => "0",
            "errorLabel" => "'This payment has been used for Enrollment. <br>You need to delete Enrollment using this amount then try to cancel again!!'",
        ));

    //Create New Unpaid
    $pmNew = new J_PaymentDetail();
    foreach ($pmOld->field_defs as $keyField => $aFieldName)
        $pmNew->$keyField = $pmOld->$keyField;

    //Update Old Receipt
    $pmOld->status = "Cancelled";
    $pmOld->description = $description;
    $pmOld->save();

    //update invoice
    $pmNew->id         = '';
    $pmNew->invoice_id = '';
    $pmNew->status = "Unpaid";
    $pmNew->method_note = $pmOld->method_note;
    $pmNew->payment_no = $pmOld->payment_no;
    $pmNew->save();

    //UPDATE Payment - Sale Type
    $GLOBALS['db']->query("UPDATE j_payment SET sale_type = 'Not set' WHERE id = '{$pmNew->payment_id}' AND deleted = 0 AND sale_type = 'New Sale'");

    return json_encode(array(
        "success" => "1",
    ));

}

function generateInvNo($team_id = '', $inv_date = ''){
    //Get Prefix

    // Số hóa đơn thì ko có chữ
    $prefix     = '#';
    $year       = date('ym',strtotime($inv_date));
    $table      = 'j_invoice';
    $code_field = 'name';
    $sep        = '';
    $first_pad  = '0000';
    $padding    = 4;
    $query = "SELECT $code_field FROM $table WHERE ( $code_field <> '' AND $code_field IS NOT NULL) AND id != '{$id}' AND (LEFT($code_field, ".strlen($prefix.$year).") = '".$prefix.$year."') ORDER BY RIGHT($code_field, $padding) DESC LIMIT 1";

    $result = $GLOBALS['db']->query($query);
    if($row = $GLOBALS['db']->fetchByAssoc($result))
        $last_code = $row[$code_field];
    else
        //no codes exist, generate default - PREFIX + CURRENT YEAR +  SEPARATOR + FIRST NUM
        $last_code = $prefix . $year . $sep  . $first_pad;

    $num = substr($last_code, -$padding, $padding);
    $num++;
    $pads = $padding - strlen($num);
    $new_code = $prefix . $year . $sep;

    //preform the lead padding 0
    for($i=0; $i < $pads; $i++)
        $new_code .= "0";
    $new_code .= $num;

    //return
    return $new_code;
}

function ajaxGetInvoiceNo($payment_id='', $buyer_legal_type =''){
    require_once("custom/modules/J_Payment/_helper.php");
    require_once("custom/include/ConvertMoneyString/convert_number_to_string.php");

    $payment = BeanFactory::getBean('J_Payment',$payment_id);

    $related_payments = json_decode(html_entity_decode($payment->payment_list),true);

    //get list payment id
    $payId = array();
    $payId[] = $payment->id;
    foreach($related_payments["deposit_list"] as $pay_id => $value)
        $payId[] = $pay_id;

    //Get list Payment Detail
    $q1 = "(SELECT DISTINCT
    IFNULL(pmd.id, '') primaryId,
    IFNULL(pmd.status, '') status,
    IFNULL(pmd.discount_amount + pmd.sponsor_amount + pmd.loyalty_amount,0) discount_amount,
    IFNULL(pmd.payment_amount, '0') payment_amount
    FROM j_paymentdetail pmd
    INNER JOIN j_payment l1 ON pmd.payment_id = l1.id AND l1.deleted = 0
    WHERE pmd.payment_id IN ('".implode("','",$payId)."') AND pmd.deleted = 0 AND pmd.status IN ('Unpaid','Paid')
    AND (pmd.invoice_id = '' OR pmd.invoice_id IS NULL))
    UNION DISTINCT
    (SELECT DISTINCT
    IFNULL(l3.id, '') primaryId,
    IFNULL(l3.status, '') status,
    IFNULL(l3.discount_amount + l3.sponsor_amount + l3.loyalty_amount,0) discount_amount,
    IFNULL(l3.payment_amount, 0) payment_amount
    FROM j_payment
    INNER JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
    INNER JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb AND l1.deleted = 0
    INNER JOIN j_payment_j_payment_1_c l2_1 ON l1.id = l2_1.j_payment_j_payment_1j_payment_ida AND l2_1.deleted = 0
    INNER JOIN j_payment l2 ON l2.id = l2_1.j_payment_j_payment_1j_payment_idb AND l2.deleted = 0
    INNER JOIN j_paymentdetail l3 ON l2.id = l3.payment_id AND l3.deleted = 0
    WHERE (j_payment.id IN ('".implode("','",$payId)."'))
    AND (IFNULL(j_payment.payment_type, '') IN ('Transfer In' , 'Moving In'))
    AND j_payment.deleted = 0
    AND l3.status IN ('Unpaid' , 'Paid')
    AND (l3.invoice_id = ''
    OR l3.invoice_id IS NULL))";
    $rs1 = $GLOBALS['db']->query($q1);
    $pmdId = array();
    $totalAmount     = 0;
    $discountAmount  = 0;
    while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
        $pmdId[] = $row['primaryId'];
        $totalAmount    += $row['payment_amount'];
        //        $discountAmount += $row['discount_amount'];
    }

    //get Student Info
    $contacts = BeanFactory::getBean('Contacts', $payment->contacts_j_payment_1contacts_ida);
    if($payment->is_corporate){
        $account = BeanFactory::getBean('Accounts', $payment->account_id);
    }


    if (empty($contacts->email1))
        return json_encode(array(
            "success" => "0",
            "label" => translate('LBL_EVAT_ERR_3','J_Payment'),
        ));


    //Get e-vat info
    $e_vat_id = $GLOBALS['db']->getOne("SELECT id FROM j_configinvoiceno WHERE team_id = '{$payment->team_id}' AND deleted = 0");

    if(!empty($e_vat_id)){
        //Call API
        $evat = BeanFactory::getBean('J_ConfigInvoiceNo', $e_vat_id);
        if($evat->supplier == 'Bkav') {
            //prepare total
            $bef_discount   = $totalAmount + $discountAmount;
            //lay danh sach item
            $qDescriptionCourseFee = "SELECT
            IFNULL(l1.description, '') l1_description,
            (CASE WHEN IFNULL(l2.ext_invoice_content, '') <> '' THEN IFNULL(l2.ext_invoice_content, '')
            ELSE IFNULL(l1.ext_content_1, '')
            END) as ext_content_1,
            IFNULL(l1.ext_content_2, '') ext_content_2
            FROM j_payment
            INNER JOIN j_coursefee_j_payment_2_c l1_1 ON j_payment.id = l1_1.j_coursefee_j_payment_2j_payment_idb AND l1_1.deleted = 0
            INNER JOIN j_coursefee l1 ON l1.id = l1_1.j_coursefee_j_payment_2j_coursefee_ida AND l1.deleted = 0
            LEFT JOIN j_payment_j_discount_1_c l2_1 ON j_payment.id = l2_1.j_payment_j_discount_1j_payment_ida AND l2_1.deleted = 0
            LEFT JOIN j_discount l2 ON l2.id = l2_1.j_payment_j_discount_1j_discount_idb AND l2.deleted = 0
            WHERE j_payment.id='{$payment_id}' AND j_payment.deleted=0";
            $rowDescriptionCourseFee = $GLOBALS['db']->fetchOne($qDescriptionCourseFee);
            if (empty($rowDescriptionCourseFee)) {
                return json_encode(
                    array(
                        "success" => "0",
                        "label" => translate('LBL_EVAT_ERR', 'J_Payment'),
                ));
            } else {
                if (!empty($rowDescriptionCourseFee['l1_description'])) {
                    $descriptionCourseFee = $rowDescriptionCourseFee['l1_description'];
                } else
                    return json_encode(
                        array(
                            "success" => "0",
                            "label" => translate('LBL_EVAT_ERR', 'J_Payment'),
                    ));
                $ext_content_1 = $rowDescriptionCourseFee['ext_content_1'];
                $ext_content_2 = $rowDescriptionCourseFee['ext_content_2'];
            }

            if ((strpos($contacts->primary_address_street, $contacts->primary_address_state) !== FALSE)
            && (strpos($contacts->primary_address_street, $contacts->primary_address_city) !== FALSE)) {
                $buyerAddressLine = $contacts->primary_address_street;
            } else {
                $buyerAddressLine = $contacts->primary_address_street . "\n" . ((!empty($contacts->primary_address_postalcode)) ? ($contacts->primary_address_postalcode . ", ") : "")
                . $contacts->primary_address_state . ", "
                . $contacts->primary_address_city . ", "
                . $contacts->primary_address_country;
            }
            $invoice_detail = array(
                "ItemName"=>$descriptionCourseFee,
                "UnitName"=>'Khóa',
                "Qty"=>1.0,
                "Price"=>$bef_discount,
                "Amount"=>$bef_discount,
                "TaxRateID"=>4,
                "TaxRate"=> -1,
                "TaxAmount"=>0,
                "IsDiscount"=>false,
                "IsIncrease"=> null,
                "ItemTypeID"=> 0
            );
            $invoice_detail_1 = array();
            $invoice_detail_2 = array();
            if(!empty($ext_content_1)){
                $invoice_detail_1 = array(
                    'ItemName'          => $ext_content_1,
                );
            }
            if(!empty($ext_content_2)){
                $invoice_detail_2 = array(
                    'ItemName'          => $ext_content_2,
                );
            }
            $data_list = array();
            $data_list['ListInvoiceDetailsWS'][]   = $invoice_detail;
            if($invoice_detail_1 != []){$data_list['ListInvoiceDetailsWS'][]   = $invoice_detail_1;}
            if($invoice_detail_2 != []){$data_list['ListInvoiceDetailsWS'][]   = $invoice_detail_2;}

            if(empty($payment->PartnerInvoiceStringID))
                $payment->PartnerInvoiceStringID = $payment->id;
            //Lap hoa don
            $param2 = array(
                "CmdType"=>112,
                "CommandObject"=> array(
                    array(
                        "Invoice"=> array(
                            "InvoiceTypeID"=>1,
                            "InvoiceDate"=>date('Y-m-d'),
                            "BuyerName"=>mb_strtoupper($contacts->$buyer_legal_type, 'UTF-8'),
                            "BuyerTaxCode"=>($payment->is_corporate) ? $account->tax_code : '',
                            "BuyerUnitName"=>($payment->is_corporate) ? mb_strtoupper($account->name, 'UTF-8') : mb_strtoupper($contacts->$buyer_legal_type, 'UTF-8'),
                            "BuyerAddress"=>($payment->is_corporate) ? $account->billing_address_street : $buyerAddressLine,
                            "BuyerBankAccount"=>"",
                            "PayMethodID"=>3,
                            "ReceiveTypeID"=>3,
                            "ReceiverEmail"=>$contacts->email1,
                            "ReceiverMobile"=>$contacts->phone_mobile,
                            "ReceiverAddress"=>($payment->is_corporate) ? $account->billing_address_street : $buyerAddressLine,
                            "ReceiverName"=>$contacts->full_student_name,
                            "Note"=>$payment->description,
                            "BillCode"=>$payment->id,
                            "CurrencyID"=>"VND",
                            "ExchangeRate"=>1.0,
                            "InvoiceForm"=>"01GTKT0/001",
                            "InvoiceSerial"=>$evat->serial_no,
                            "InvoiceNo"=>0,
                        ),
                        "ListInvoiceDetailsWS"=>$data_list['ListInvoiceDetailsWS'],
                        "PartnerInvoiceStringID"=>$payment->PartnerInvoiceStringID,
                    )
                )
            );
            $param3 = array(
                "partnerGUID" => $evat->partnerGUID,
                "CommandData"=> base64_encode(json_encode($param2)),
            );
            $res = CreateEinvoice($evat,json_encode($param3));
            if($res['Status'] != 0){
                $label_error = translate('LBL_EVAT_ERR','J_Payment') . '</br>' ;
                return json_encode(
                    array(
                        "success"   => "0",
                        "label"     => $label_error,
                    )
                );
            }
            else {
                // tao j_invoice
                $newInvoiceNo = $res['PartnerInvoiceID'];
                $newContent = $res['Content'];
                $newTranID = $res['MTC'];
                //Xu ly lay so hoa don
                $newSerial = $res['InvoiceSerial'];
                $newPattern = $res['InvoiceForm'];

                $invNew = new J_Invoice();
                $invNew->name = $newInvoiceNo;
                $invNew->invoice_date = date('Y-m-d');
                $invNew->before_discount = $bef_discount;
                $invNew->total_discount_amount = $discountAmount;
                $invNew->invoice_amount = $totalAmount;
                $invNew->serial_no = $newSerial;
                $invNew->pattern = $newPattern;
                $invNew->payment_id = $payment->id;
                $invNew->status = 'Paid';
                $invNew->content_vat_invoice = $newContent;
                $invNew->team_id = $payment->team_id;
                $invNew->team_set_id = $payment->team_set_id;
                $invNew->assigned_user_id = $payment->assigned_user_id;
                $invNew->transaction_id = $newTranID;
                $invNew->invoiceGUID = $res['InvoiceGUID'];
                $invNew->save();

                //Update Receipt
                $GLOBALS['db']->query("UPDATE j_paymentdetail SET invoice_id = '{$invNew->id}' WHERE id IN ('" . implode("','", $pmdId) . "') AND deleted = 0");
                $GLOBALS['db']->query("UPDATE j_payment SET invoice_id = '{$invNew->id}' WHERE id IN ('" . implode("','", $payId) . "') AND deleted = 0");

                //Update invoice_no_current for all childs of team
                $GLOBALS['db']->query("UPDATE j_configinvoiceno SET invoice_no_current = '{$newInvoiceNo}' WHERE serial_no = '{$evat->serial_no}' AND pattern = '{$evat->pattern}' AND deleted = 0");

                //Update PartnerInvoiceStringID
                $GLOBALS['db']->query("UPDATE j_payment SET PartnerInvoiceStringID = '{$payment->PartnerInvoiceStringID}' WHERE id = '{$payment->id}' AND deleted = 0");

                return json_encode(
                    array(
                        "success" => "1",
                    )
                );
            }
        }
        //////////////////////////////////////////////////
        if($evat->supplier == 'Misa'){
            //Get Token
            $res = get_EvatToken($evat);
            if($res['success']){
                $token = $res['token'];

                //prepare total
                $bef_discount   = $totalAmount + $discountAmount;

                //Get API phat hanh
                $res = get_IptemplatePublish($evat, $token);
                if($res['success']) {
                    $param1 = $res;
                    unset($param1['success']);

                    //Phat Hanh Hoa don
                    $int = new Integer();
                    $text = $int->toText($totalAmount);

                    //lay danh sach item
                    $qDescriptionCourseFee = "SELECT IFNULL(l1.description,'') l1_description
                    , IFNULL(l1.ext_content_1,'') ext_content_1
                    , IFNULL(l1.ext_content_2,'') ext_content_2
                    FROM j_payment
                    INNER JOIN j_coursefee_j_payment_2_c l1_1
                    ON j_payment.id=l1_1.j_coursefee_j_payment_2j_payment_idb AND l1_1.deleted=0
                    INNER JOIN j_coursefee l1
                    ON l1.id=l1_1.j_coursefee_j_payment_2j_coursefee_ida AND l1.deleted=0
                    WHERE j_payment.id='{$payment_id}' AND j_payment.deleted=0";
                    $rowDescriptionCourseFee = $GLOBALS['db']->fetchOne($qDescriptionCourseFee);
                    if(empty($rowDescriptionCourseFee)){
                        return json_encode(
                            array(
                                "success" => "0",
                                "label" =>translate('LBL_EVAT_ERR','J_Payment'),
                        ));
                    }else{
                        if(!empty($rowDescriptionCourseFee['l1_description'])){
                            $descriptionCourseFee = $rowDescriptionCourseFee['l1_description'];
                        }else
                            return json_encode(
                                array(
                                    "success" => "0",
                                    "label" =>translate('LBL_EVAT_ERR','J_Payment'),
                            ));
                        $ext_content_1 = $rowDescriptionCourseFee['ext_content_1'];
                        $ext_content_2 = $rowDescriptionCourseFee['ext_content_2'];
                    }

                    if ((strpos($contacts->primary_address_street, $contacts->primary_address_state) !== FALSE)
                    && (strpos($contacts->primary_address_street, $contacts->primary_address_city) !== FALSE)) {
                        $buyerAddressLine = $contacts->primary_address_street;
                    } else {
                        $buyerAddressLine = $contacts->primary_address_street . "\n" . ((!empty($contacts->primary_address_postalcode)) ? ($contacts->primary_address_postalcode . ", ") : "")
                        . $contacts->primary_address_state. ", "
                        . $contacts->primary_address_city. ", "
                        . $contacts->primary_address_country;
                    }

                    $pm_method = 'TM/CK';

                    //Lap hoa don
                    $invoice_detail = array(
                        'LineNumber'        => 1,
                        'ItemCode'          => $payment->kind_of_course,
                        'ItemName'          => $descriptionCourseFee,
                        'UnitName'          => 'Khóa',
                        'Quantity'          => 1,
                        'Amount'            => $bef_discount,
                        'VatPercentage'     => -1,
                        'VatAmount'         => 0,
                        'UnitPrice'         => $bef_discount,
                        'Promotion'         => false,
                        'InventoryItemType' => 1,
                    );
                    $invoice_detail_1 = array();
                    $invoice_detail_2 = array();
                    if(!empty($ext_content_1)){
                        $invoice_detail_1 = array(
                            'LineNumber'        => 2,
                            'ItemCode'          => $payment->kind_of_course,
                            'ItemName'          => $ext_content_1,
                            'InventoryItemType' => 3,
                        );
                    }
                    if(!empty($ext_content_2)){
                        $invoice_detail_2 = array(
                            'LineNumber'        => 3,
                            'ItemCode'          => $payment->kind_of_course,
                            'ItemName'          => $ext_content_2,
                            'InventoryItemType' => 3,
                        );
                    }
                    $option_user_defined = array(
                        'MainCurrency'              => 'VND',
                        'AmountDecimalDigits'       => '0',
                        'AmountOCDecimalDigits'     => '2',
                        'UnitPriceOCDecimalDigits'  => '0',
                        'UnitPriceDecimalDigits'    => '1',
                        'QuantityDecimalDigits'     => '2',
                        'CoefficientDecimalDigits'  => '2',
                        'ExchangRateDecimalDigits'  => '0',
                    );
                    $data_list = array(
                        'RefID'                         => $payment->id, //ID hóa đơn
                        'InvoiceType'                   => $evat->invoice_type, //Mã loại hóa đơn
                        'TemplateCode'                  => $evat->pattern, //Mẫu số hóa đơn
                        'InvoiceSeries'                 => $evat->serial_no, //Ký hiệu hóa đơn
                        'InvoiceIssuedDate'             => '',
                        'CurrencyCode'                  => 'VND',
                        'InvoiceNote'                   => $payment->description,
                        'AdjustmentType'                => 1,
                        'PaymentMethodName'             => $pm_method,
                        'SellerTaxCode'                 => explode("-", $evat->account)[0],
                        'SellerLegalName'               => $evat->seller_legal_name,
                        'SellerAddressLine'             => $evat->seller_address_line,
                        'SellerPhoneNumber'             => '',
                        'SellerWebsite'                 => '',
                        'SellerEmail'                   => '',
                        'SellerBankAccount'             => '',
                        'SellerBankName'                => '',
                        'BuyerLegalName'                => ($payment->is_corporate) ? mb_strtoupper($account->name, 'UTF-8') : mb_strtoupper($contacts->$buyer_legal_type, 'UTF-8'),
                        'BuyerDisplayName'              => mb_strtoupper($contacts->$buyer_legal_type, 'UTF-8'),
                        'BuyerTaxCode'                  => ($payment->is_corporate) ? $account->tax_code : '',
                        'BuyerAddressLine'              => ($payment->is_corporate) ? $account->billing_address_street : $buyerAddressLine,
                        'BuyerPhoneNumber'              => $contacts->phone_mobile,
                        'BuyerEmail'                    => $contacts->email1,
                        'BuyerBankAccount'              => '',
                        'BuyerBankName'                 => '',    //$pmd->card_type
                        'ExchangeRate'                  => 1,
                        'VatPercentage'                 => -1,
                        'TotalAmountWithoutVAT'         => $bef_discount,
                        'TotalVATAmount'                => 0,
                        'TotalAmountWithVAT'            => $bef_discount,
                        'TotalAmountWithVATInWords'     => $text,
                        'DiscountAmount'                => $discountAmount,
                        'TotalAmountWithVATFrn'         => $totalAmount,
                        'IsSendEmail'                   => true,
                        'ReceiverName'                  => $contacts->full_student_name,
                        'ReceiverEmail'                 => $contacts->email1,
                        'CustomField1'                 => $evat->seller_legal_name_1,
                        'CustomField2'                 => $evat->seller_address_line_1,
                        'CustomField3'                 => $evat->account,
                    );

                    $data_list['OriginalInvoiceDetail'][]   = $invoice_detail;
                    if($invoice_detail_1 != []){$data_list['OriginalInvoiceDetail'][]   = $invoice_detail_1;}
                    if($invoice_detail_2 != []){$data_list['OriginalInvoiceDetail'][]   = $invoice_detail_2;}
                    $data_list['OptionUserDefined']         = $option_user_defined;

                    $param['InvoiceDataList'][] = $data_list;
                    $param['userName']          = $evat->e_sign_user;
                    $param['passWord']          = $evat->pass_code;

                    $param = json_encode($param, JSON_UNESCAPED_UNICODE);
                    $res = PublishInvoiceHSM($evat, $param, $token);
                    if ($res['success']) {
                        $newInvoiceNo = $res['InvoiceNumber'];
                        $newContent   = $res['Content'];
                        $newTranID    = $res['TransactionID'];
                    } else
                        return json_encode(
                            array(
                                "success" => "0",
                                "label" =>translate('LBL_EVAT_ERR','J_Payment') . "</br>" . $res['errorCode'],
                        ));
                } else
                    return json_encode(
                        array(
                            "success" => "0",
                            "label" => translate('LBL_EVAT_ERR', 'J_Payment') . "</br>" . $res['errorCode'],
                    ));

                //Xu ly lay so hoa don
                $newSerial    = $evat->serial_no;
                $newPattern   = $evat->pattern;

                $invNew = new J_Invoice();
                $invNew->name                   = $newInvoiceNo;
                $invNew->type                   = $evat->type;
                $invNew->invoice_date           = date('Y-m-d');
                $invNew->before_discount        = $bef_discount;
                $invNew->total_discount_amount  = $discountAmount;
                $invNew->invoice_amount         = $totalAmount;
                $invNew->serial_no              = $newSerial;
                $invNew->pattern                = $newPattern;
                $invNew->payment_id             = $payment->id;
                $invNew->status                 = 'Paid';
                $invNew->content_vat_invoice    = $newContent;
                $invNew->team_id                = $payment->team_id;
                $invNew->team_set_id            = $payment->team_set_id;
                $invNew->assigned_user_id       = $payment->assigned_user_id;
                $invNew->transaction_id         = $newTranID;
                $invNew->save();

                //Update Receipt
                $GLOBALS['db']->query("UPDATE j_paymentdetail SET invoice_id = '{$invNew->id}' WHERE id IN ('".implode("','",$pmdId)."') AND deleted = 0");
                $GLOBALS['db']->query("UPDATE j_payment SET invoice_id = '{$invNew->id}' WHERE id IN ('".implode("','",$payId)."') AND deleted = 0");

                //Update invoice_no_current for all childs of team
                $GLOBALS['db']->query("UPDATE j_configinvoiceno SET invoice_no_current = '{$newInvoiceNo}' WHERE serial_no = '{$evat->serial_no}' AND pattern = '{$evat->pattern}' AND deleted = 0");

                return json_encode(
                    array(
                        "success" => "1",
                ));
            }else{
                $label_error = translate('LBL_EVAT_ERR','J_Payment') . '</br>' . $res['errorCode'];
                if(!empty($res['errorCodeDetail'])) $label_error = $label_error .' : '. $res['errorCodeDetail'];
                return json_encode(
                    array(
                        "success"   => "0",
                        "label"     => $label_error,
                ));
            }
        }

    }else
        return json_encode(
            array(
                "success" => "0",
                "label" => translate('LBL_EVAT_ERR','J_Payment'),
        ));


    return json_encode(
        array(
            "success" => "0",
            "label" => $res['errorCode'].' - '.translate('LBL_EVAT_ERR','J_Payment'),
    ));
}

function ajaxExportInvoice($payment_id = '') {
    require_once("custom/modules/J_Payment/_helper.php");

    $payment = BeanFactory::getBean('J_Payment',$payment_id);
    $e_vat_id = $GLOBALS['db']->getOne("SELECT id FROM j_configinvoiceno WHERE team_id = '{$payment->team_id}' AND deleted = 0");
    if(!empty($e_vat_id)) {
        $evat = BeanFactory::getBean('J_ConfigInvoiceNo', $e_vat_id);
        if($evat->supplier == 'Misa') {
            //Get token
            $res = get_EvatToken($evat);
            if ($res['success']) {
                $token = $res['token'];
                $invoice_no = $GLOBALS['db']->getOne("SELECT transaction_id FROM j_invoice WHERE id = '{$payment->invoice_id}' AND deleted = 0");
                $param[] = $invoice_no;
                $param = json_encode($param);
                $result = DownloadInvoice($evat, $param, $token);
                if ($result['success']) {
                    return json_encode(
                        array(
                            "success" => "1",
                            "transactionID" => $result['transactionID'],
                            "data_pdf" => $result['data'],
                    ));
                } else
                    return json_encode(
                        array(
                            "success" => "0",
                            "label" => translate('LBL_EVAT_ERR', 'J_Payment') . "</br>" . $res['errorCode'],
                    ));
            } else {
                $label_error = translate('LBL_EVAT_ERR', 'J_Payment') . '</br>' . $res['errorCode'];
                if (!empty($res['errorCodeDetail'])) $label_error = $label_error . ' : ' . $res['errorCodeDetail'];
                return json_encode(
                    array(
                        "success" => "0",
                        "label" => $label_error,
                ));
            }
        }
    }
    return json_encode(
        array(
            "success"   => "0",
            "label"     => translate('LBL_EVAT_ERR','J_Payment'),
    ));
}
?>
