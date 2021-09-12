<?php
function get_list_student($team_id = '', $start = '', $end = '', $class_id = '',$koc = '', $level = '', $assigned_user_id = ''){
    $qTeam = "AND t.id = '$team_id' AND ss.team_set_id IN
    (SELECT
    tst.team_set_id
    FROM
    team_sets_teams tst
    INNER JOIN
    team_memberships team_memberships ON tst.team_id = team_memberships.team_id
    AND team_memberships.user_id = '{$GLOBALS['current_user']->id}'
    AND team_memberships.deleted = 0)";
    if ($GLOBALS['current_user']->isAdmin())
        $qTeam = "AND t.id = '$team_id'";

    $ext_class_id = '';
    if(!empty($class_id))
        $ext_class_id = "AND ss.ju_class_id IN ('$class_id')";

    $ext_koc = "";
    $ext_level = "";
    if(!empty($level))  $ext_level = "AND c.level IN ('$level')";
    if(!empty($koc)) $ext_koc = "AND REPLACE(koc.kind_of_course, ' ', '') IN ('$koc') ".$ext_level;

    $ext_user = '';
    if(!empty($assigned_user_id))
        $ext_user = "AND c.assigned_user_id = '$assigned_user_id'";

    $sql_student = "SELECT
    IFNULL(l1.id, '') student_id,
    IFNULL(l1.full_student_name, '') student_name,
    l1.phone_mobile phone_situation,
    l1.guardian_name parent_name,
    fd.first_lesson first_date,
    ss.end_study end_study,
    ss.total_hour,
    ss.ju_class_id,
    ss.description,
    c.name class_name,
    IFNULL(u.full_user_name, '') class_assigned_to,
    ss.payment_id,
    p.payment_date,
    c.kind_of_course,
    c.level,
    ss.team_id,
    t.name center_name,
    t.code_prefix center_code
    FROM j_studentsituations ss
    INNER JOIN j_class c ON c.id = ss.ju_class_id AND c.deleted = 0 AND ss.total_amount > 0 AND c.class_type = 'Normal Class'
    $ext_class_id
    $ext_user
    INNER JOIN contacts l1 ON ss.student_id = l1.id AND l1.deleted = 0
    INNER JOIN teams t on t.id = ss.team_id
    $qTeam
    INNER JOIN j_kindofcourse koc ON koc.id = c.koc_id AND koc.deleted = 0 $ext_koc
    INNER JOIN users u ON u.id = c.assigned_user_id AND u.deleted = 0
    INNER JOIN j_payment p ON p.id = ss.payment_id AND p.deleted = 0
    INNER JOIN (SELECT student_id, MIN(start_study) first_lesson
    FROM j_studentsituations
    WHERE deleted = 0 AND type IN ('Enrolled' , 'Moving in')
    GROUP BY student_id) fd ON fd.student_id = ss.student_id
    WHERE ss.end_study BETWEEN '$start' AND '$end' AND ss.deleted = 0
    AND (ss.type IN ('Enrolled', 'Moving In'))
    GROUP BY student_id, ss.payment_id
    ORDER BY student_id ASC , end_study DESC";

    return $GLOBALS['db']->fetchArray($sql_student);
}

function calculate_cf( $row_payment= '',  $row_collected= '',  $row_cashin= '',  $row_cashout= '',  $row_revenue= '',  $row_settle= '', $start = ''){
    $data = array();
    for($i = 0; $i < count($row_payment); $i++){
        $collected_amount_alloc     = 0;
        $revenue_amount_alloc       = 0;

        $payment_id  = $row_payment[$i]['payment_id'];

        $revenue_this_amount = $row_revenue[$payment_id]['this']['amount'];

        $revenue_till_this_amount = $row_revenue[$payment_id]['before_this']['amount'] + $row_revenue[$payment_id]['this']['amount'];

        $settle_this_amount = $row_settle[$payment_id]['this']['amount'];

        $settle_before_this_amount = $row_settle[$payment_id]['before_this']['amount'];

        $invoice_number = '';

        $before_discount = (float)$row_collected[$payment_id]['this']['before_discount'];

        $discount_amount = (float)$row_collected[$payment_id]['this']['discount_amount'];

        $sponsor_amount = (float)$row_collected[$payment_id]['this']['sponsor_amount'];

        $sponsor_type = $row_payment[$i]['sponsor_type'];

        $collected_amount_this = (float)$row_collected[$payment_id]['this']['payment_amount'];

        $collected_amount_till_this = $collected_amount_this + (float)$row_collected[$payment_id]['before_this']['payment_amount'];

        //delay-cash-in
        $cash_in_this_amount = (float)$row_cashin[$payment_id]['this']['delay_cash_in']['amount'];

        $cash_in_before_this_amount = (float)$row_cashin[$payment_id]['before_this']['delay_cash_in']['amount'];

        $cash_out_this_amount = (float)$row_cashout[$payment_id]['this']['delay_cash_out']['amount'];

        $cash_out_before_this_amount = (float)$row_cashout[$payment_id]['before_this']['delay_cash_out']['amount'];

        $mv_tf_in_this_amount = (float)$row_cashin[$payment_id]['this']['moving_transfer_in']['amount'];

        $mv_tf_in_before_this_amount = (float)$row_cashin[$payment_id]['before_this']['moving_transfer_in']['amount'];

        //moving-transfer-out
        $mv_tf_out_this_amount = (float)$row_cashout[$payment_id]['this']['moving_transfer_out']['amount'];

        $mv_tf_out_before_this_amount = (float)$row_cashout[$payment_id]['before_this']['moving_transfer_out']['amount'];

        //bổ sung transfer In
        $mv_tf = array(
            0 => 'Transfer In',
            1 => 'Moving In');
        if(in_array($row_payment[$i]['payment_type'], $mv_tf)) {
            if(strtotime($start) > strtotime($row_payment[$i]['payment_date']))
                $mv_tf_in_before_this_amount = $row_payment[$i]['payment_amount'];
            else
                $mv_tf_in_this_amount =    $row_payment[$i]['payment_amount'];

            $mv_tf_out_before_this_amount   = $cash_out_before_this_amount;
            $cash_out_before_this_amount    = 0;
            $mv_tf_out_this_amount          = $cash_out_this_amount;
            $cash_out_this_amount           = 0;
        }

        $refund_this_amount = (float)$row_cashout[$payment_id]['this']['refund']['amount'];

        $refund_before_this_amount = (float)$row_cashout[$payment_id]['before_this']['refund']['amount'];

        $beginning_amount = $collected_amount_till_this - $collected_amount_this - $revenue_till_this_amount + $revenue_this_amount + $mv_tf_in_before_this_amount - $mv_tf_out_before_this_amount + $cash_in_before_this_amount - $cash_out_before_this_amount - $refund_before_this_amount - $settle_before_this_amount;

        $carry_amount = $beginning_amount + $collected_amount_this - $revenue_this_amount + $mv_tf_in_this_amount - $mv_tf_out_this_amount + $cash_in_this_amount - $cash_out_this_amount - $refund_this_amount - $settle_this_amount;

        $cr_i = $i;

        //Lam tron so
        if(abs($carry_amount) < 1000){
            $carry_amount = 0;
        }
        if(abs($beginning_amount) < 1000 ){
            $beginning_amount = 0;
        }

        //outstanding amount
        $out_standing     = 0;
        $carry_amount_temp  = $carry_amount;

        if($carry_amount < 0){
            $out_standing = abs($carry_amount);
            $carry_amount_temp = 0;
        }

        if($carry_amount != 0 || $beginning_amount != 0 || $collected_amount_this != 0 || $settle_this_amount != 0 || $revenue_this_amount != 0 ||  $mv_tf_in_this_amount != 0 || $mv_tf_out_this_amount != 0 || $cash_in_this_amount != 0 || $cash_out_this_amount != 0 || $refund_this_amount != 0){
            $count++;
            $data[$row_payment[$i]['student_id']]['carry_amount']  += $carry_amount_temp;
            if($row_payment[$i]['payment_type'] == 'Enrollment' && $carry_amount_temp > 0){
                $data[$row_payment[$i]['student_id']]['Enrollment']  += 1;
            }
        }
    }
    return $data;
}


function get_list_payment($team_id= '', $student_id = '', $start= '', $end= ''){
    global $current_user;
    $ext_student = '';
    if(!empty($student_id)){
        $ext_student = "AND (l1.id IN ('$student_id'))";
    }
    $ext_team_id = '';
    if(!empty($team_id)) $ext_team_id = "AND (l2.id IN ('$team_id'))";


    $ext_team ="AND j_payment.team_set_id IN
    (SELECT
    tst.team_set_id
    FROM
    team_sets_teams tst
    INNER JOIN
    team_memberships team_memberships ON tst.team_id = team_memberships.team_id
    AND team_memberships.user_id = '{$current_user->id}'
    AND team_memberships.deleted = 0)";
    if ($current_user->isAdmin())
        $ext_team = '';

    $q1 = "SELECT DISTINCT
    IFNULL(j_payment.id, '') payment_id,
    IFNULL(j_payment.kind_of_course, '') kind_of_course,
    IFNULL(j_payment.kind_of_course_string, '') kind_of_course_string,
    IFNULL(j_payment.level_string, '') level_string,
    IFNULL(j_payment.class_string, '') class_string,
    IFNULL(l1.id, '') student_id,
    IFNULL(l1.contact_id, '') student_code,
    CONCAT(IFNULL(l1.last_name, ''),
    ' ',
    IFNULL(l1.first_name, '')) student_name,
    j_payment.payment_date,
    IFNULL(j_payment.payment_type, '') payment_type,
    j_payment.tuition_fee tuition_fee,
    j_payment.tuition_hours tuition_hours,
    j_payment.total_hours total_hours,
    j_payment.discount_percent discount_percent,
    j_payment.final_sponsor_percent final_sponsor_percent,
    j_payment.payment_amount payment_amount,
    j_payment.deposit_amount deposit_amount,
    j_payment.paid_amount paid_amount,
    j_payment.paid_hours paid_hours,
    IFNULL(j_payment.remain_amount, 0) remain_amount,
    j_payment.remain_hours remain_hours,
    IFNULL((j_payment.payment_amount + j_payment.deposit_amount) / (j_payment.total_hours),
    (j_payment.payment_amount + j_payment.deposit_amount + j_payment.paid_amount) / (j_payment.tuition_hours)) payment_price,
    IFNULL(l2.id, '') team_id
    FROM
    j_payment
    INNER JOIN
    contacts_j_payment_1_c l1_1 ON j_payment.id = l1_1.contacts_j_payment_1j_payment_idb
    AND (j_payment.payment_date <= '$end' OR CONVERT(DATE_ADD(j_payment.date_entered, INTERVAL 7 HOUR), date) <= '$end')
    AND l1_1.deleted = 0
    INNER JOIN
    contacts l1 ON l1.id = l1_1.contacts_j_payment_1contacts_ida
    AND l1.deleted = 0
    INNER JOIN
    teams l2 ON j_payment.team_id = l2.id
    AND l2.deleted = 0
    WHERE
    ((j_payment.deleted = 0
    $ext_student
    $ext_team_id
    AND j_payment.payment_type IN ('Deposit' , 'Cashholder', 'Enrollment',
    'Delay',
    'Transfer In',
    'Moving In',
    'Placement Test',
    'Schedule Change')
    $ext_team))
    ORDER BY student_id ASC";
    return $GLOBALS['db']->fetchArray($q1);
}

function get_collected($payment_id = '', $start = '', $end = '')  {
    $q1 = "  SELECT
    IFNULL(l2.id, '') payment_id,
    IFNULL(GROUP_CONCAT(j_paymentdetail.invoice_number SEPARATOR ' '), '') invoice_number,
    CASE WHEN j_paymentdetail.payment_date < '$start' THEN 'before_this' ELSE 'this' END AS till_time,
    IFNULL(SUM(j_paymentdetail.before_discount), 0) before_discount,
    IFNULL(SUM(j_paymentdetail.discount_amount), 0) discount_amount,
    IFNULL(SUM(j_paymentdetail.sponsor_amount), 0) sponsor_amount,
    IFNULL(SUM(j_paymentdetail.payment_amount), 0) payment_amount
    FROM j_paymentdetail
    INNER JOIN j_payment l2 ON j_paymentdetail.payment_id = l2.id AND l2.deleted = 0
    INNER JOIN contacts_j_payment_1_c l3_1 ON l2.id = l3_1.contacts_j_payment_1j_payment_idb AND l3_1.deleted = 0
    INNER JOIN contacts l3 ON l3.id = l3_1.contacts_j_payment_1contacts_ida AND l3.deleted = 0
    WHERE j_paymentdetail.payment_id in ('$payment_id')
    AND j_paymentdetail.payment_date <= '$end'
    AND j_paymentdetail.status = 'Paid'
    AND j_paymentdetail.deleted = 0
    GROUP BY payment_id, till_time";
    $rs = $GLOBALS['db']->query($q1);
    $data = array();
    while($row = $GLOBALS['db']->fetchbyAssoc($rs)){
        $data[$row['payment_id']][$row['till_time']]['invoice_number']   = $row['invoice_number'];
        $data[$row['payment_id']][$row['till_time']]['before_discount']   = $row['before_discount'];
        $data[$row['payment_id']][$row['till_time']]['discount_amount']   = $row['discount_amount'];
        $data[$row['payment_id']][$row['till_time']]['sponsor_amount']    = $row['sponsor_amount'];
        $data[$row['payment_id']][$row['till_time']]['payment_amount']    = $row['payment_amount'];
    }
    return $data;
}

function get_cash_in($payment_id = '', $start = '', $end = ''){
    $q1 = "SELECT
    IFNULL(j_payment.id, '') payment_id,
    CASE WHEN j_payment.payment_date < '$start' THEN 'before_this' ELSE 'this' END AS till_time,
    (CASE WHEN l1.payment_type IN ('Transfer In', 'Moving In') THEN 'moving_transfer_in' ELSE 'delay_cash_in' END) as payment_type_group,
    IFNULL(SUM(l1_1.amount), 0) amount
    FROM j_payment
    INNER JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
    INNER JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb AND l1.deleted = 0
    WHERE j_payment.id in ('$payment_id')
    AND j_payment.payment_date <= '$end'
    AND j_payment.deleted = 0
    GROUP BY payment_id, till_time, payment_type_group";
    $rs = $GLOBALS['db']->query($q1);
    $data = array();
    while($row = $GLOBALS['db']->fetchbyAssoc($rs))
        $data[$row['payment_id']][$row['till_time']][$row['payment_type_group']]['amount'] = $row['amount'];

    return $data;

}

function get_cash_out($payment_id = '', $start = '', $end = ''){
    $q1 = "SELECT
    IFNULL(l1.id, '') payment_id_out,
    CASE WHEN j_payment.payment_date < '$start' THEN 'before_this' ELSE 'this' END AS till_time,
    (CASE WHEN j_payment.payment_type IN ('Transfer Out', 'Moving Out') THEN 'moving_transfer_out'
    WHEN j_payment.payment_type IN ('Refund') THEN 'refund' ELSE 'delay_cash_out' END) as payment_type_group,
    IFNULL(SUM(l1_1.amount), 0) amount
    FROM j_payment
    INNER JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
    INNER JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb AND l1.deleted = 0
    WHERE l1.id IN ('$payment_id') AND j_payment.payment_date <= '$end' AND j_payment.deleted = 0
    GROUP BY payment_id_out, till_time, payment_type_group";
    $rs = $GLOBALS['db']->query($q1);
    $data = array();
    while($row = $GLOBALS['db']->fetchbyAssoc($rs))
        $data[$row['payment_id_out']][$row['till_time']][$row['payment_type_group']]['amount'] = $row['amount'];

    return $data;

}

function get_revenue($team_id, $student_id, $payment_id, $start, $end){
    $data =  get_list_revenue_report($team_id, $student_id, $payment_id, "'Enrolled','Moving In','Stopped'", $start, $end);

    //Tinh doanh thu Drop
    $ext_student = '';
    if(!empty($student_id))
        $ext_student = "AND (c_deliveryrevenue.student_id IN ('$student_id'))";

    $ext_team = '';
    if(!empty($team_id))
        $ext_team = "AND (l3.id = '$team_id')";

    $q1 = "SELECT
    IFNULL(l1.id, '') ju_payment_id,
    c_deliveryrevenue.date_input,
    IFNULL(SUM(c_deliveryrevenue.amount), 0) amount
    FROM c_deliveryrevenue
    INNER JOIN j_payment l1 ON c_deliveryrevenue.ju_payment_id = l1.id AND l1.deleted = 0
    INNER JOIN users l2 ON c_deliveryrevenue.created_by = l2.id AND l2.deleted = 0
    INNER JOIN teams l3 ON c_deliveryrevenue.team_id = l3.id AND l3.deleted = 0
    WHERE (c_deliveryrevenue.passed IS NULL OR c_deliveryrevenue.passed = '0')
    AND c_deliveryrevenue.date_input <= '$end')
    $ext_team
    $ext_student
    AND c_deliveryrevenue.deleted = 0
    GROUP BY ju_payment_id, date_input";
    $rs = $GLOBALS['db']->query($q1);
    while($row = $GLOBALS['db']->fetchbyAssoc($rs)){
        if($row['date_input'] < $start){
            $data[$row['ju_payment_id']]['before_this']['amount']  += $row['amount'];
        }else{
            $data[$row['ju_payment_id']]['this']['amount']  += $row['amount'];
        }
    }
    return $data;
}

function get_settle($team_id = '', $student_id = '', $payment_id = '', $start = '', $end = ''){
    //Tính doanh thu Settle
    $data =  get_list_revenue_report($team_id, $student_id, $payment_id, "'Settle'", $start, $end);
    return $data;
}

function get_list_revenue_report($team_id = '', $student_id = '', $payment_id = '', $situation_type = "'Enrolled'" ,$start = '', $end = ''){

    $ext_team = "AND (l5.id = '$team_id')";
    if(empty($team_id))
        $ext_team = "";

    $ext_student = "AND (l1.id IN ('$student_id'))";
    if(empty($student_id))
        $ext_student = "";

    $ext_payment_id  = "AND l4.id IN ('$payment_id')";
    if(empty($payment_id))
        $ext_payment_id = "";

    $ext_situation = "AND l3.type IN($situation_type)";
    if($situation_type == "All" || empty($situation_type))
        $ext_situation = "";

    if(!empty($end)){
        $end_tz     = date('Y-m-d H:i:s',strtotime("-7 hours ".$end." 23:59:59"));
        $ext_end = "AND (meetings.date_end <= '$end_tz')";
    }else $ext_end = '';

    $ext_status = "AND (l2.status <> '$not_status')";
    if(empty($not_status))
        $ext_status = "";

    $select_date = "DATE_ADD(meetings.date_start, INTERVAL 7 HOUR)";
    //Set Revenue Settle
    if($situation_type == "'Settle'"){
        if(!empty($end)){
            $ext_end = "AND (l4.settle_date <= '$end')";
        }else $ext_end = '';
    }

    $q1 = "SELECT DISTINCT
    IFNULL(l4.id, '') ju_payment_id,
    CASE WHEN CONVERT($select_date, DATE) < '$start' THEN 'before_this' ELSE 'this' END AS till_time,
    SUM(IFNULL(meetings.duration_cal, 0)) total_revenue_hours,
    SUM(IFNULL((IFNULL((l3.total_amount/l3.total_hour), 0) * meetings.duration_cal), 0)) total_revenue_amount
    FROM meetings
    INNER JOIN meetings_contacts l1_1 ON meetings.id = l1_1.meeting_id AND l1_1.deleted = 0
    INNER JOIN contacts l1 ON l1.id = l1_1.contact_id AND l1.deleted = 0
    INNER JOIN j_class l2 ON meetings.ju_class_id = l2.id AND l2.deleted = 0
    INNER JOIN j_studentsituations l3 ON l1_1.situation_id = l3.id AND l3.deleted = 0 $ext_situation
    LEFT JOIN j_payment l4 ON l3.payment_id = l4.id AND l4.deleted = 0
    INNER JOIN teams l5 ON meetings.team_id = l5.id AND l5.deleted = 0
    WHERE ((meetings.deleted = 0
    $ext_student
    $ext_payment_id
    $ext_start $ext_end
    $ext_team
    $ext_status
    AND (meetings.session_status <> 'Cancelled')))
    GROUP BY ju_payment_id, till_time";
    $rs = $GLOBALS['db']->query($q1);

    while($row = $GLOBALS['db']->fetchbyAssoc($rs)){
        $data[$row['ju_payment_id']][$row['till_time']]['amount']  = $row['total_revenue_amount'];
    }
    return $data;
}


function get_retention_in_month($student_id= '', $start= '', $end= ''){
    $q1 = "SELECT DISTINCT
    IFNULL(contacts.id, '') student_id,
    IFNULL(l2.id, '') team_id,
    MAX(l1.payment_date) payment_date,
    SUM(IFNULL(l1.remain_amount, 0)) remain_amount
    FROM contacts
    LEFT JOIN contacts_j_payment_1_c l1_1 ON contacts.id = l1_1.contacts_j_payment_1contacts_ida AND l1_1.deleted = 0
    LEFT JOIN j_payment l1 ON l1.id = l1_1.contacts_j_payment_1j_payment_idb AND l1.deleted = 0
    INNER JOIN teams l2 ON l1.team_id = l2.id AND l2.deleted = 0
    WHERE (contacts.id IN('$student_id')) AND contacts.deleted = 0
    GROUP BY contacts.id, l2.id";
    $r1 = $GLOBALS['db']->query($q1);
    $data = array();
    while($row = $GLOBALS['db']->fetchByAssoc($r1)){
        $data[$row['student_id']]['payment_amount'] = $row['remain_amount'];
        $data[$row['student_id']]['payment_date']   = $row['payment_date'];
        $data[$row['student_id']]['team_id']        = $row['team_id'];
    }
    return $data;
}

function check_retention($student_id= '', $end= ''){
    $sql_check = "SELECT
    pd2.student_id, pd2.payment_amount, rtt.return_date
    FROM
    j_paymentdetail pd2
    INNER JOIN
    (SELECT
    cp.contacts_j_payment_1contacts_ida student_id,
    MIN(pd.payment_date)   return_date
    FROM
    contacts_j_payment_1_c cp
    INNER JOIN
    j_payment p ON p.id = cp.contacts_j_payment_1j_payment_idb
    AND cp.deleted = 0
    AND p.deleted = 0
    INNER JOIN
    j_paymentdetail pd ON pd.payment_id = p.id AND pd.deleted = 0
    AND pd.status = 'Paid'
    AND pd.payment_amount > 0
    AND pd.payment_date > '$end'
    AND cp.contacts_j_payment_1contacts_ida IN ('$student_id')
    GROUP BY student_id) rtt ON rtt.student_id = pd2.student_id
    AND pd2.payment_date = rtt.return_date
    AND pd2.deleted = 0
    AND pd2.status = 'Paid' ";
    $rs_reten =  $GLOBALS['db']->query($sql_check);
    $data_reten = array();
    while($row_reten = $GLOBALS['db']->fetchByAssoc($rs_reten)){
        $data_reten[$row_reten['student_id']]['return_date'] = $row_reten['return_date'];
        $data_reten[$row_reten['student_id']]['payment_amount'] += $row_reten['payment_amount'];
    }
    $sql_tf = "SELECT
    cp.contacts_j_payment_1contacts_ida student_id,
    p.id payment_id,
    p.payment_amount,
    p.payment_date,
    p.team_id
    FROM
    contacts_j_payment_1_c cp
    INNER JOIN
    j_payment p ON p.id = cp.contacts_j_payment_1j_payment_idb
    AND p.deleted = 0
    AND cp.deleted = 0
    AND p.payment_date > '$end'
    AND p.payment_type IN ('Transfer In')
    AND cp.contacts_j_payment_1contacts_ida IN ('$student_id')
    ORDER BY p.payment_date";
    $rs_tf = $GLOBALS['db']->fetchArray($sql_tf);
    $std_id = '';
    $total_amount = array();
    foreach ($rs_tf as $key=>$value){
        if($std_id == $value['student_id'] && (float)$total_amount[$std_id] > 100000)
            continue;
        else{
            $std_id = $value['student_id'];
            $total_amount[$std_id] += $value['payment_amount'];
            if($total_amount[$std_id] > 100000 && (empty($data_reten[$std_id]['return_date']) || $data_reten[$std_id]['return_date'] > $value['payment_date']))
                $data_reten[$std_id]['return_date'] = $value['payment_date'];
        }
    }

    return $data_reten;
}

function check_pre_paid($student_id= '', $end= ''){
    $sql_pre_paid = "SELECT
    cp.contacts_j_payment_1contacts_ida student_id,
    p.id payment_id,
    p.payment_amount payment_amount,
    MAX(p.payment_date) payment_date
    FROM
    contacts_j_payment_1_c cp
    INNER JOIN
    j_payment p ON p.id = cp.contacts_j_payment_1j_payment_idb
    AND cp.deleted = 0
    AND p.deleted = 0
    AND p.payment_date < '$end'
    AND cp.contacts_j_payment_1contacts_ida IN ('$student_id')
    INNER JOIN
    j_paymentdetail pd ON pd.payment_id = p.id AND pd.deleted = 0
    AND pd.status = 'Paid'
    AND pd.payment_amount > 100000
    AND ((p.payment_amount + p.paid_amount + p.deposit_amount) = p.remain_amount)
    AND p.remain_amount > 100000
    GROUP BY student_id";
    $rs_pre_paid = $GLOBALS['db']->query($sql_pre_paid);
    $data_pre_paid = array();
    while($row_prepaid = $GLOBALS['db']->fetchByAssoc($rs_pre_paid)){
        $data_pre_paid[$row_prepaid['student_id']]['payment_date'] = $row_prepaid['payment_date'];
        $data_pre_paid[$row_prepaid['student_id']]['payment_id'] = $row_prepaid['payment_id'];
        $data_pre_paid[$row_prepaid['student_id']]['payment_amount'] += $row_prepaid['payment_amount'];
    }
    return $data_pre_paid;
}

function get_list_retake($std_list = '', $end = ''){
    $sql_retake = "SELECT
    cp.contacts_j_payment_1contacts_ida student_id
    FROM j_payment p
    INNER JOIN j_sponsor sp ON sp.payment_id = p.id AND sp.deleted = 0 AND p.deleted = 0
    AND (sp.name = 'Retake' OR sp.percent = 100) AND p.payment_date > DATE_SUB('$end', INTERVAL 1 MONTH)
    INNER JOIN contacts_j_payment_1_c cp ON cp.contacts_j_payment_1j_payment_idb = p.id
    AND cp.deleted = 0 AND cp.contacts_j_payment_1contacts_ida IN ($std_list)";

    return $GLOBALS['db']->fetchArray($sql_retake);
}

function array_orderby(){
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}