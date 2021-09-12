<?php
/**
* GET LIST: DOANH THU THEO LỚP THEO HỌC VIÊN
* @param start_display    	: Ngày bắt đầu trên hệ CRM
* @param end_display		: Ngày kết thúc trên CRM
* @param class_id   		: ID lớp
* @param student_id       	: ID Học viên
* @param situation_type     : Loại doanh thu cần lấy 'Enrolled', 'Outstanding'
*/
require_once('custom/include/_helper/junior_schedule.php');
function get_list_revenue($student_id = '', $situation_type = "'Enrolled'", $start_display = '', $end_display = '', $class_id = '', $situation_id = '', $team_id = '', $payment_id = '', $is_not_payment = false, $status = ''){
    global $timedate;

    $ext_student = "AND (l1_1.contact_id = '$student_id')";
    if(empty($student_id))
        $ext_student = "";

    $ext_situation = "AND l3.type IN($situation_type)";
    if($situation_type == "All" || empty($situation_type))
        $ext_situation = "";

    if(!empty($start_display)){
        $start_tz 	= date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($start_display)." 00:00:00"));
        $ext_start = "AND (meetings.date_start >= '$start_tz')";
    }else $ext_start = '';

    if(!empty($end_display)){
        $end_tz 	= date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($end_display)." 23:59:59"));
        $ext_end = "AND (meetings.date_end <= '$end_tz')";
    }else $ext_end = '';

    $ext_class = "AND (l2.id = '$class_id')";
    if(empty($class_id))
        $ext_class = "";

    $ext_situation_id = "AND (l3.id = '$situation_id')";
    if(empty($situation_id))
        $ext_situation_id = "";

    $ext_team = "AND (l5.id = '$team_id')";
    if(empty($team_id) && empty($situation_id) && empty($student_id) && empty($class_id) && empty($payment_id)){
        $ext_team = "AND ((meetings.team_set_id IN (SELECT
        tst.team_set_id
        FROM
        team_sets_teams tst
        INNER JOIN
        team_memberships team_memberships ON tst.team_id = team_memberships.team_id
        AND team_memberships.user_id = '{$GLOBALS['current_user']->id}'
        AND team_memberships.deleted = 0)))";
    }else if (!empty($team_id))
        $ext_team = "AND (l5.id = '$team_id')";
        else $ext_team = "";

    if(is_array($payment_id) && !empty($payment_id)){
        $ext_payment = "AND (l4.id IN('".implode("','",$payment_id)."'))";
    }else{
        $ext_payment = "AND (l4.id = '$payment_id')";
        if(empty($payment_id))
            $ext_payment = "";
        if($is_not_payment && !empty($payment_id))
            $ext_payment = "AND (l4.id <> '$payment_id')";
    }

    $ext_status = "AND (l2.status <> '$status')";
    if(empty($status))
        $ext_status = "";

    $q1 = "SELECT DISTINCT
    IFNULL(meetings.id, '') primaryid,
    meetings.date_start date_start,
    meetings.date_end date_end,
    meetings.duration_cal duration_hour,
    meetings.delivery_hour delivery_hour,
    IFNULL(meetings.till_hour, 0) till_hour,
    IFNULL(l3.id, '') situation_id,
    l3.type situation_type,
    IFNULL(l1_1.contact_id, '') student_id,
    IFNULL(l4.id, '') ju_payment_id,
    IFNULL(l4.kind_of_course, '') kind_of_course,
    (CASE
    WHEN (IFNULL(l4.payment_amount, 0) > IFNULL(SUM(l6.payment_amount), 0)) THEN 'Unpaid'
    ELSE 'Paid'
    END) as revenue_status,
    IFNULL(l5.id, '') team_id,
    IFNULL((((l4.paid_amount+l4.deposit_amount+l4.payment_amount)/(l4.paid_hours+l4.total_hours)) * l3.total_hour), 0) total_amount,
    l3.total_hour total_hour,
    IFNULL(((l4.paid_amount+l4.deposit_amount+l4.payment_amount)/(l4.paid_hours+l4.total_hours)), 0) cost_per_hour,
    IFNULL((((l4.paid_amount+l4.deposit_amount+l4.payment_amount)/(l4.paid_hours+l4.total_hours)) * meetings.delivery_hour), 0) delivery_revenue
    FROM
    meetings
    INNER JOIN
    meetings_contacts l1_1 ON meetings.id = l1_1.meeting_id
    AND l1_1.deleted = 0
    $ext_student
    INNER JOIN
    contacts l1 ON l1.id = l1_1.contact_id
    AND l1.deleted = 0
    INNER JOIN
    j_class l2 ON meetings.ju_class_id = l2.id
    $ext_class
    $ext_status
    AND l2.deleted = 0
    INNER JOIN
    j_studentsituations l3 ON l1_1.situation_id = l3.id
    AND l3.deleted = 0 $ext_situation
    $ext_situation_id
    LEFT JOIN
    j_payment l4 ON l3.payment_id = l4.id
    AND l4.deleted = 0
    LEFT JOIN
    j_paymentdetail l6 ON l6.payment_id = l4.id
    AND l6.deleted = 0 AND l6.status = 'Paid'
    INNER JOIN
    teams l5 ON meetings.team_id = l5.id
    AND l5.deleted = 0
    WHERE
    ((meetings.deleted = 0
    $ext_team
    $ext_start
    $ext_end
    $ext_payment
    AND (meetings.session_status <> 'Cancelled')))
    GROUP BY primaryid, situation_id
    ORDER BY date_start ASC";
    return $GLOBALS['db']->fetchArray($q1);
}

/**
* GET LIST: DOANH THU THEO LỚP THEO SITUATION THEO HỌC VIÊN ...
* @param start_display    	: Ngày bắt đầu trên hệ CRM
* @param end_display		: Ngày kết thúc trên CRM
* @param class_id   		: ID lớp
* @param student_id       	: ID Học viên
* @param situation_type     : Loại doanh thu cần lấy 'Enrolled', 'Outstanding'
*/
function get_total_revenue($student_id = '', $situation_type = "'Enrolled'", $start_display = '', $end_display = '', $class_id = '', $situation_id = '', $payment_id = '', $not_status = ''){
    global $timedate;

    $ext_status = '';
    if(!empty($not_status))
        $ext_status = "AND l2.status <> '$not_status'";

    $ext_student = "AND (l1_1.contact_id = '$student_id')";
    if(empty($student_id))
        $ext_student = "";

    $ext_situation = "AND l3.type IN($situation_type)";
    if($situation_type == "All" || empty($situation_type))
        $ext_situation = "";

    if(!empty($start_display)){
        $start_tz 	= date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($start_display,false)." 00:00:00"));
        $ext_start = "AND (meetings.date_start >= '$start_tz')";
    }else $ext_start = '';

    if(!empty($end_display)){
        $end_tz 	= date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($end_display	,false)." 23:59:59"));
        $ext_end = "AND (meetings.date_end <= '$end_tz')";
    }else $ext_end = '';

    $ext_class = "AND (l2.id = '$class_id')";
    if (is_array($class_id) && !empty($class_id))
        $ext_class = "AND (l2.id IN ('" . implode("','", $class_id) . "'))";
    if (empty($class_id))
        $ext_class = "";

    $ext_situation_id = "AND (l3.id = '$situation_id')";
    if(empty($situation_id))
        $ext_situation_id = "";

    $ext_payment_id = "AND (l4.id = '$payment_id')";
    if(empty($payment_id))
        $ext_payment_id = "";

    $q1 = "SELECT DISTINCT
    IFNULL(l2.id, '') class_id,
    IFNULL(l2.class_code, '') class_code,
    IFNULL(l2.name, '') class_name,
    l2.start_date class_start_date,
    l2.end_date class_end_date,
    l2.class_type class_type,
    IFNULL(l3.id, '') situation_id,
    l3.start_study start_study,
    l3.end_study end_study,
    l3.total_hour total_hour_situa,
    ((l4.paid_amount+l4.deposit_amount+l4.payment_amount)/(l4.paid_hours+l4.total_hours) * l3.total_hour) total_amount_situa,
    ((l4.paid_amount+l4.deposit_amount+l4.payment_amount)/(l4.paid_hours+l4.total_hours)) price,
    SUM(((l4.paid_amount+l4.deposit_amount+l4.payment_amount)/(l4.paid_hours+l4.total_hours)) * meetings.delivery_hour) total_revenue,
    IFNULL(SUM(meetings.delivery_hour), 0) total_revenue_hour,
    GROUP_CONCAT(meetings.id) session_list,
    IFNULL(COUNT(meetings.id), 0) count_session
    FROM meetings
    INNER JOIN meetings_contacts l1_1 ON meetings.id = l1_1.meeting_id
    $ext_student AND l1_1.deleted = 0
    INNER JOIN contacts l1 ON l1.id = l1_1.contact_id AND l1.deleted = 0
    INNER JOIN j_class l2 ON meetings.ju_class_id = l2.id AND l2.deleted = 0
    $ext_status
    INNER JOIN j_studentsituations l3 ON l1_1.situation_id = l3.id AND l3.deleted = 0 $ext_situation
    LEFT JOIN j_payment l4 ON l3.payment_id = l4.id AND l4.deleted = 0
    WHERE ((meetings.deleted = 0
    $ext_start $ext_end
    $ext_class
    $ext_situation_id
    $ext_payment_id
    AND (meetings.session_status <> 'Cancelled')))
    GROUP BY situation_id";

    return $GLOBALS['db']->fetchArray($q1);
}

/**
* GET LIST: TỔNG SỐ GIỜ DẠY THEO LỚP
* @param start_display        : Ngày bắt đầu trên hệ CRM
* @param end_display        : Ngày kết thúc trên CRM
* @param class_id           : ID lớp
*/
function get_list_lesson_by_class($class_id = '', $start_display = '', $end_display = '', $arr_type = 'Standard', $not_status = 'Cancelled'){
    global $timedate;

    $ext_start = '';
    if(!empty($start_display)){
        $start_tz     = date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($start_display,false)." 00:00:00"));
        $ext_start = "AND (meetings.date_start >= '$start_tz')";
    }
    $ext_end = '';
    if(!empty($end_display)){
        $end_tz     = date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($end_display    ,false)." 23:59:59"));
        $ext_end = "AND (meetings.date_end <= '$end_tz')";
    }
    $ext_class = "AND (l2.id = '$class_id')";

    $ext_status = "AND (meetings.session_status <> 'Cancelled')";
    if(empty($not_status))
        $ext_status = "";

    $q1 = "SELECT DISTINCT
    IFNULL(l2.id, '') class_id,
    IFNULL(l2.class_code, '') class_code,
    IFNULL(l2.name, '') class_name,
    l2.start_date class_start_date,
    l2.end_date class_end_date,
    l2.hours class_hour,
    IFNULL(meetings.id, '') primaryid,
    meetings.date_start date_start,
    meetings.date_end date_end,
    DATE(CONVERT_TZ(meetings.date_end,'+00:00','+7:00')) date,
    meetings.lesson_number lesson_number,
    IFNULL(meetings.till_hour, 0) till_hour,
    IFNULL(meetings.duration_cal, 0) duration_cal,
    meetings.session_status session_status,
    IFNULL(meetings.delivery_hour, 0) delivery_hour
    FROM
    meetings
    INNER JOIN
    j_class l2 ON meetings.ju_class_id = l2.id
    AND l2.deleted = 0
    WHERE
    ((meetings.deleted = 0
    $ext_class
    $ext_start
    $ext_end
    $ext_status))
    ORDER BY date_start ASC";
    if($arr_type == 'Standard')
        return $GLOBALS['db']->fetchArray($q1);
    elseif($arr_type == 'VIP'){
        $rs1 = $GLOBALS['db']->query($q1);
        $row = array();
        while($ss = $GLOBALS['db']->fetchByAssoc($rs1))
            $row[$ss['primaryid']] = $ss['delivery_hour'];

        return $row;
    }
}
/**
* GET: TỔNG SỐ GIỜ LỚP
* @param start_display    	: Ngày bắt đầu trên hệ CRM
* @param end_display		: Ngày kết thúc trên CRM
* @param class_id   		: ID lớp
*/
function get_total_lesson_by_class($class_id = '', $start_display = '', $end_display = '', $not_status = 'Cancelled'){
    global $timedate;

    $ext_start = '';
    if(!empty($start_display)){
        $start_tz 	= date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($start_display,false)." 00:00:00"));
        $ext_start = "AND (meetings.date_start >= '$start_tz')";
    }
    $ext_end = '';
    if(!empty($end_display)){
        $end_tz 	= date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($end_display	,false)." 23:59:59"));
        $ext_end = "AND (meetings.date_end <= '$end_tz')";
    }
    $ext_class = "AND (l2.id IN ('$class_id'))";

    $ext_status = "AND (meetings.session_status <> 'Cancelled')";
    if(empty($not_status))
        $ext_status = "";

    $q1 = "SELECT DISTINCT
    IFNULL(l2.id, '') class_id,
    IFNULL(l2.name, '') class_name,
    l2.start_date start_date,
    l2.end_date end_date,
    COUNT(meetings.id) count_session,
    SUM(IFNULL(meetings.duration_cal, 0)) sum_hours
    FROM meetings
    INNER JOIN j_class l2 ON meetings.ju_class_id = l2.id AND l2.deleted = 0
    WHERE ((meetings.deleted = 0 $ext_class $ext_start $ext_end $ext_status))
    GROUP BY class_id";
    return $GLOBALS['db']->fetchArray($q1);
}


/**
* KIỂM TRA HỌC VIÊN CÓ TỒN TẠI TRONG KHOẢNG THỜI GIAN CỦA LỚP HAY KO
* @param start_display    	: Ngày bắt đầu trên hệ CRM
* @param end_display		: Ngày kết thúc trên CRM
* @param class_id   		: ID lớp
*/
function is_exist_in_class($student_id = '', $start_display = '', $end_display = '', $class_id = '', $situation_type = 'All'){
    $ses_list = get_list_revenue($student_id, $situation_type, $start_display, $end_display, $class_id);
    if(count($ses_list) > 0)
        return true;
    else return false;
}

/**
* KIỂM TRA LEAD CÓ TỒN TẠI TRONG KHOẢNG THỜI GIAN CỦA LỚP HAY KO
* @param Lead ID    		: Ngày bắt đầu trên hệ CRM
* @param class_id   		: ID lớp
*/
function is_exist_lead_in_class($lead_id = '', $class_id = ''){
    $res = get_lead_in_class($lead_id, $class_id);
    if(count($res) > 0)
        return true;
    else return false;
}

/**
* GET LIST: Lead trong lớp
* @param Lead ID    		: Ngày bắt đầu trên hệ CRM
* @param class_id   		: ID lớp
*/
function get_lead_in_class($lead_id = '', $class_id = ''){
    $ext_lead_id = '';
    if(!empty($lead_id))
        $ext_lead_id = "AND (l1.id = '$lead_id')";

    $ext_class_id = '';
    if(!empty($class_id))
        $ext_class_id = "AND (l2.id = '$class_id')";

    $q1 = "SELECT DISTINCT
    IFNULL(meetings.id, '') primaryid,
    IFNULL(l1_1.id, '') rel_id,
    IFNULL(meetings.name, '') meetings_name,
    meetings.date_start meetings_date_start,
    meetings.date_end meetings_date_end
    FROM meetings
    INNER JOIN
    meetings_leads l1_1 ON meetings.id = l1_1.meeting_id
    AND l1_1.deleted = 0
    INNER JOIN
    leads l1 ON l1.id = l1_1.lead_id AND l1.deleted = 0
    INNER JOIN
    j_class l2 ON meetings.ju_class_id = l2.id
    AND l2.deleted = 0
    WHERE
    ((meetings.deleted = 0
    $ext_lead_id
    $ext_class_id))";
    return $GLOBALS['db']->fetchArray($q1);
}

/**
* GET LIST: Receipt
*/
function get_list_payment_detail($payment_id = '', $team_id = '', $student_id = '',  $start_db = '', $end_db = '', $status = 'Paid', $type = ''){
    $ext_pay = '';
    if(!empty($payment_id))
        $ext_pay = "AND (l1.id = '$payment_id')";

    $ext_team = '';
    if(!empty($team_id))
        $ext_team = "AND (l2.id = '$team_id')";

    $ext_stu = '';
    if(!empty($student_id))
        $ext_stu = "AND (l3.id = '$student_id')";

    $ext_start = '';
    if(!empty($start_db))
        $ext_start = "AND (j_paymentdetail.payment_date >= '$start_db')";

    $ext_end = '';
    if(!empty($end_db))
        $ext_end = "AND (j_paymentdetail.payment_date <= '$end_db')";

    $ext_status = '';
    if(!empty($status))
        $ext_status = "AND (j_paymentdetail.status = '$status')";

    $ext_type = '';

    $q1 = "SELECT DISTINCT
    IFNULL(j_paymentdetail.id, '') primaryid,
    IFNULL(j_paymentdetail.name, '') name,
    j_paymentdetail.payment_no payment_no,
    IFNULL(j_paymentdetail.payment_method, '') payment_method,
    j_paymentdetail.before_discount before_discount,
    j_paymentdetail.discount_amount discount_amount,
    j_paymentdetail.sponsor_amount sponsor_amount,
    j_paymentdetail.payment_amount payment_amount,
    j_paymentdetail.payment_method_fee payment_method_fee,
    j_paymentdetail.payment_date payment_date,
    IFNULL(l1.id, '') payment_id,
    l1.payment_amount payment_payment_amount,
    IFNULL(l2.id, '') team_id,
    IFNULL(l3.id, '') student_id,
    l3.full_student_name student_name
    FROM
    j_paymentdetail
    INNER JOIN
    j_payment l1 ON j_paymentdetail.payment_id = l1.id
    AND l1.deleted = 0
    INNER JOIN
    teams l2 ON j_paymentdetail.team_id = l2.id
    AND l2.deleted = 0
    LEFT JOIN
    contacts_j_payment_1_c l3_1 ON l1.id = l3_1.contacts_j_payment_1j_payment_idb
    AND l3_1.deleted = 0
    LEFT JOIN
    contacts l3 ON l3.id = l3_1.contacts_j_payment_1contacts_ida
    AND l3.deleted = 0
    WHERE
    (((j_paymentdetail.deleted = 0)
    $ext_pay
    $ext_team
    $ext_stu
    $ext_start
    $ext_end
    $ext_status
    $ext_type))";
    return $GLOBALS['db']->fetchArray($q1);
}

/**
* update lesson number for class
* Update Start End Date for class
*
* @param mixed $class_id
*
* @author Lap Nguyen
*/
function updateClassSession($class_id = '') {
    //Update lesson no
    $q1 = "SELECT DISTINCT
    IFNULL(meetings.id, '') primaryid,
    meetings.date_start date_start,
    meetings.date_end date_end,
    meetings.lesson_number lesson_number,
    meetings.delivery_hour delivery_hour
    FROM
    meetings
    WHERE
    ((meetings.deleted = 0
    AND (meetings.session_status <> 'Cancelled')
    AND (meetings.ju_class_id = '$class_id') ))
    ORDER BY date_start ASC";
    $ss_list            = $GLOBALS['db']->fetchArray($q1);
    $till               = 0;
    $week_no = 0;
    for($i = 0; $i < count($ss_list); $i++){
        $current_week_no = (int)date('W',strtotime("+7 hours ".$ss_list[$i]['date_start']));
        if($last_week_no != $current_week_no){
            $week_no++;
            $last_week_no = $current_week_no;
        }

        $lesson = $i+1;
        $ext_lesson = ", lesson_number= '$lesson'";

        //Update till hours
        $till += $ss_list[$i]['delivery_hour'];

        $q2 = "UPDATE meetings SET till_hour = ROUND($till,2), week_no='W$week_no' $ext_lesson WHERE id='{$ss_list[$i]['primaryid']}'";
        $GLOBALS['db']->query($q2);
    }

    //Return DB class start - end date
    $rsClass = array();
    $first = reset($ss_list);
    $start_date = date('Y-m-d',strtotime("+7 hours ".$first['date_start']));

    $last = end($ss_list);
    $end_date = date('Y-m-d',strtotime("+7 hours ".$last['date_start']));

    return array(
        'start_date' => $start_date,
        'end_date'   => $end_date
    );
}

//////////////// CHECK NEW SALE -  BY LAP NGUYEN \\\\\\\\\\\\\\\\\\\\\\\\\
function revokeSaleType($payment_id = ''){
    if (empty($payment_id)) return false;
    //Lọc tất cả Payment liên quan - Check  lại New Sale
    $q1 = "SELECT DISTINCT
    IFNULL(l1.id, '') rel_payment_id
    FROM j_payment
    INNER JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
    INNER JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb AND l1.deleted = 0
    WHERE (j_payment.id = '$payment_id')
    AND (l1.sale_type IN ('Retention', 'New Sale'))
    AND (l1.payment_type IN ('Deposit', 'Cashholder'))
    AND j_payment.deleted = 0";
    $rs1 = $GLOBALS['db']->query($q1);
    while($row = $GLOBALS['db']->fetchByAssoc($rs1))
        checkSaleType($row['rel_payment_id']);
}

function checkSaleType($payment_id = ''){
    if (empty($payment_id)) return false;

    $retention_period = '1 months'; // Thời gian retention đc tính là New Sale
    $new_sale_range   = 45;  //Thời gian chốt sale được tính là New sale -  0: Không xét Chốt, bao lâu tùy ý - ĐVT: Days
    $except_koc       = ['Outing Trip']; // Không xét các chương trình học
    $except_type      = ['Transfer Fee', 'Delay Fee', 'Placement Test', 'Book/Gift','Other'];  // Không xét các loại thanh toán
    $moving_transfer  = 0; // Có/Không TRUE/FALSE xét rule sử dụng Moving/Transfer
    $target_deposit   = 0;  // Tổng số tiền Deposit xét được xét Sale  - 0: Không xét Deposit

    //return 'New Sale';//SET tạm
    $q1 = "SELECT DISTINCT
    IFNULL(j_payment.id, '') payment_id,
    j_payment.tuition_hours tuition_hours,
    j_payment.payment_date payment_date,
    j_payment.payment_amount payment_amount,
    j_payment.paid_amount paid_amount,
    j_payment.deposit_amount deposit_amount,
    (j_payment.deposit_amount + j_payment.paid_amount + j_payment.payment_amount) total_amount,
    IFNULL(j_payment.payment_type, '') payment_type,
    IFNULL(j_payment.sale_type, '') sale_type,
    IFNULL(j_payment.kind_of_course, '') kind_of_course,
    IFNULL(j_payment.date_entered, '') date_entered,
    SUM(IFNULL(l3.payment_amount,0)) total_paid,
    MIN(l3.payment_date) min_payment_date,
    MAX(l3.payment_date) sale_type_date,
    IFNULL(l2.id, '') student_id
    FROM j_payment
    INNER JOIN contacts_j_payment_1_c l2_1 ON j_payment.id = l2_1.contacts_j_payment_1j_payment_idb AND l2_1.deleted = 0
    INNER JOIN contacts l2 ON l2.id = l2_1.contacts_j_payment_1contacts_ida AND l2.deleted = 0
    LEFT JOIN j_paymentdetail l3 ON l3.payment_id = j_payment.id AND l3.deleted = 0 AND l3.status = 'Paid'
    WHERE (j_payment.id = '$payment_id') AND j_payment.deleted = 0
    GROUP BY j_payment.id";
    $row = $GLOBALS['db']->fetchOne($q1);
    $student_id     = $row['student_id'];
    $payment_id     = $row['payment_id'];
    if(empty($row['sale_type_date'])) $row['sale_type_date'] = $row['payment_date'];  // Max receipt date
    if(empty($row['min_payment_date'])) $row['min_payment_date'] = $row['payment_date'];  // min receipt date
    $sale_type_date = $row['sale_type_date'];
    $payment_type   = $row['payment_type'];
    $payment_amount = $row['payment_amount'];

    if ($payment_amount <= 0)
        return false;

    if (empty($student_id) || empty($payment_id) || empty($sale_type_date) )
        return false;

    if (in_array($row['kind_of_course'],$except_koc))
        return false;

    if (in_array($row['payment_type'],$except_type))
        return false;

    //Xet Deposit
    if($payment_type == 'Deposit' && ($payment_amount < $target_deposit || empty($target_deposit)) ){     //Xét đủ số tiền deposit tối thiểu
        $sale_type = 'Not set';
    }elseif($row['total_paid'] < $row['payment_amount'])
        $sale_type =  'Not set';
    else{
        $basic_rule = newsaleBasicRule($row, $retention_period, $moving_transfer);
        //Update các Payment Liên quan
        $basic_rule = newsaleRelPay($row, $basic_rule, $new_sale_range);
        $sale_type = ($basic_rule) ? 'New Sale' : 'Retention';
    }
    // update sale_type
    if($row['sale_type'] != $sale_type){
        $GLOBALS['db']->query("UPDATE j_payment SET sale_type = '$sale_type', sale_type_date='$sale_type_date' WHERE id = '$payment_id'");
    }

    return true;
}

//Rule 1: Học viên không có lesson học trong 6tháng hoặc ko có đóng full phí trong 6 tháng trước
function newsaleBasicRule($payment = '', $duration = 0, $moving_transfer = false){

    //Get last study date: Học viên không có lesson học trong $duration
    if(!empty($duration)){
        $q1 = "SELECT DISTINCT
        IFNULL(contacts.id, '') primaryid,
        MAX(l1.end_study) last_end_study
        FROM contacts
        INNER JOIN j_studentsituations l1 ON contacts.id = l1.student_id AND l1.deleted = 0 AND l1.student_type = 'Contacts'
        WHERE (contacts.id = '{$payment['student_id']}') AND (l1.type = 'Enrolled') AND (l1.payment_id <> '{$payment['payment_id']}')
        AND (l1.date_entered < '{$payment['date_entered']}') AND contacts.deleted = 0
        GROUP BY contacts.id";
        $rule1 = $GLOBALS['db']->fetchOne($q1);
        if(!empty($rule1)){
            $last = date("Y-m-d", strtotime($rule1['last_end_study'] . "+ $duration"));
            if($last > $payment['sale_type_date']) return false;
        }
    }

    if($moving_transfer){
        //Moving/Transfer used: Có sử dụng tiền Moving/Transfer
        $q3 = "SELECT DISTINCT
        COUNT(IFNULL(l1.id, '')) count
        FROM j_payment
        INNER JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
        INNER JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb AND l1.deleted = 0
        WHERE (j_payment.id = '{$payment['payment_id']}')
        AND (l1.payment_type IN ('Transfer In', 'Moving In'))
        AND j_payment.deleted = 0";
        $count = $GLOBALS['db']->getOne($q3);
        if ($count > 0) return false;
    }

    return true;
}

//Rule 2: Xet Payment Relate trong 30 ngay
function newsaleRelPay($payment= '', $basic_rule = true, $new_sale_range = 0){

    $sale_type_date = $payment['sale_type_date'];
    if(!empty($new_sale_range)){

/*        //ko Payment New Sale trong khoang thoi gian $new_sale_range
        if($basic_rule) {
            $q2 = "SELECT DISTINCT
            IFNULL(contacts.id, '') primaryid,
            MAX(l1.sale_type_date) last_sale_date
            FROM contacts
            INNER JOIN contacts_j_payment_1_c l1_1 ON contacts.id = l1_1.contacts_j_payment_1contacts_ida AND l1_1.deleted = 0
            INNER JOIN j_payment l1 ON l1.id = l1_1.contacts_j_payment_1j_payment_idb AND l1.deleted = 0
            WHERE (contacts.id = '{$payment['student_id']}')
            AND (l1.payment_type IN ('Enrollment' , 'Deposit', 'Cashholder'))
            AND (l1.sale_type IN ('New Sale'))
            AND (l1.id <> '{$payment['payment_id']}')
            AND contacts.deleted = 0
            GROUP BY contacts.id";
            $rule2 = $GLOBALS['db']->fetchOne($q2);
            if(!empty($rule2)){
                $last_new_sale = date("Y-m-d", strtotime($rule2['last_sale_date'] . " +$new_sale_range days"));
                if($last_new_sale > $payment['sale_type_date']) $basic_rule = false;
            }
        }    */

        //Lọc tất cả Payment liên quan
        $q1 = "SELECT DISTINCT
        IFNULL(l1.id, '') l1_id,
        IFNULL(l1.name, '') l1_name,
        l1.total_hours l1_total_hours,
        l1.payment_date l1_payment_date,
        l1.sale_type  l1_sale_type,
        l1.sale_type_date  l1_sale_type_date,
        l1.payment_amount l1_payment_amount
        FROM j_payment
        INNER JOIN j_payment_j_payment_1_c l1_1 ON j_payment.id = l1_1.j_payment_j_payment_1j_payment_ida AND l1_1.deleted = 0
        INNER JOIN j_payment l1 ON l1.id = l1_1.j_payment_j_payment_1j_payment_idb AND l1.deleted = 0
        WHERE (j_payment.id = '{$payment['payment_id']}')
        AND (l1.sale_type IN ('Not set'))
        AND (l1.payment_type IN ('Deposit', 'Cashholder'))
        AND j_payment.deleted = 0";
        $rs1 = $GLOBALS['db']->query($q1);
        while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
            $due_date = date("Y-m-d",strtotime("+$new_sale_range days ".$row['l1_sale_type_date']));
            if(empty($new_sale_range) || $sale_type_date <= $due_date){
                $sale_type = ($basic_rule) ? 'New Sale' : 'Retention'; // xet theo basic_rule
            }else{
                $sale_type = 'New Sale'; //Case trước ==> New
                $basic_rule =  false;    // Case hiện tại ==> Retention
            }

            $GLOBALS['db']->query("UPDATE j_payment SET sale_type = '$sale_type', sale_type_date = '$sale_type_date' WHERE id = '{$row['l1_id']}'");
        }
    }

    return $basic_rule;
}
// END CHECK NEW SALE

function get_list_lesson_by_situation($class_id = '', $situation_id= '', $start_display = '', $end_display = '', $join = 'LEFT'){
    global $timedate;

    //    if(is_array($situation_id))
    //        $in_ext =  "IN ('".implode("','",$situation_id)."')";
    //    else $in_ext = "= '$situation_id'";

    $ext_start = '';
    if(!empty($start_display)){
        $start_tz     = date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($start_display,false)." 00:00:00"));
        $ext_start = "AND (meetings.date_start >= '$start_tz')";
    }
    $ext_end = '';
    if(!empty($end_display)){
        $end_tz     = date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($end_display    ,false)." 23:59:59"));
        $ext_end = "AND (meetings.date_end <= '$end_tz')";
    }
    $ext_class = '';
    if(!empty($class_id))
        $ext_class = "AND (l2.id = '$class_id')";

    $q1 = "SELECT DISTINCT
    IFNULL(l2.id, '') class_id,
    IFNULL(l3.id, '') situation_id,
    IFNULL(meetings.id, '') primaryid,
    meetings.lesson_number lesson_number,
    meetings.date_start date_start,
    meetings.date_end date_end,
    meetings.delivery_hour delivery_hour
    FROM
    meetings
    INNER JOIN
    j_class l2 ON meetings.ju_class_id = l2.id
    AND l2.deleted = 0
    $join JOIN
    meetings_contacts l1_1 ON meetings.id = l1_1.meeting_id
    AND l1_1.deleted = 0 AND l1_1.situation_id = '$situation_id'
    $join JOIN
    j_studentsituations l3 ON l1_1.situation_id = l3.id
    AND l3.deleted = 0 AND l3.id = '$situation_id'
    WHERE
    ((meetings.deleted = 0
    $ext_class
    $ext_start
    $ext_end
    AND (meetings.session_status <> 'Cancelled')))
    ORDER BY date_start ASC";

    return $GLOBALS['db']->fetchArray($q1);
}

function getLoyaltyPoint($student_id= '', $not_payment_id='', $payment_date = ''){
    global $timedate;
    if(empty($student_id))
        return 0;

    $ext_not_pm_id = '';
    if(!empty($not_payment_id)){
        $ext_not_pm_id1 = "AND (IFNULL(lt.quote_id,'') <> '$not_payment_id')";
        $ext_not_pm_id2 = "AND (IFNULL(lt.quote_id,'') <> '$not_payment_id')";
    }

    if(!empty($payment_date)){
        $payment_date =  $timedate->convertToDBDate($payment_date, false);
        $ext_payment_date1 = "AND (lt.input_date <= '$payment_date')";

    }

    $loyalty_rank = $GLOBALS['app_list_strings']['loyalty_rank_list'];
    $today = date('Y-m-d');
    $q4 = "SELECT
    lt.parent_id primaryid, SUM(lt.point) points, MAX(lt.exp_date) exp_date
    FROM j_loyalty lt
    WHERE lt.deleted = 0
    AND (lt.parent_id = '$student_id' $ext_not_pm_id2 $ext_payment_date1) GROUP BY lt.parent_id";
    $rs4 = $GLOBALS['db']->query($q4);
    $row4 = $GLOBALS['db']->fetchByAssoc($rs4);
    //result
    $net_amount = 0 + $current_payment['gross_amount'];
    if(!empty($row4))
        $net_amount = $row4['net_amount'] + $current_payment['gross_amount'];

    if($net_amount < $loyalty_rank['Blue']){
        $level        = 'N/A';
        $next_level   = 'Blue';
        $current_rate = format_number((($net_amount - $loyalty_rank[$level]) / ($loyalty_rank[$next_level] - $loyalty_rank[$level])) * 100,0,0);
    }
    if($net_amount >= $loyalty_rank['Blue']){
        $level        = 'Blue';
        $next_level   = 'Gold';
        $current_rate = format_number((($net_amount - $loyalty_rank[$level]) / ($loyalty_rank[$next_level] - $loyalty_rank[$level])) * 100,0,0);
    }
    if($net_amount >= $loyalty_rank['Gold']){
        $level        = 'Gold';
        $next_level   = 'Platinum';
        $current_rate = format_number((($net_amount - $loyalty_rank[$level]) / ($loyalty_rank[$next_level] - $loyalty_rank[$level])) * 100,0,0);
    }
    if($net_amount >= $loyalty_rank['Platinum']){
        $level        = 'Platinum';
        $next_level   = '';
        $current_rate = '100';
    }

    //Get Loyalty Point
//    $getday = date('yy-m-d');
//    $q5 = "SELECT SUM(point) as points FROM j_loyalty WHERE student_id ='$student_id' AND exp_date >'$getday'";
//    $rs5 = $GLOBALS['db']->query($q5);
//    $row5 = $GLOBALS['db']->fetchByAssoc($rs5);

    return array(
        'student_id'=> $row4['primaryid'],
        'level'     => $level,
        'next_level'=> $next_level,
        'current_rate'=> $current_rate,
        'points'    => $row4['points'],
    );
}
function getLoyaltyRateOut($mem_level= '', $team_id = '', $year = ''){
    //    if(empty($team_id))
    //        $team_id = $GLOBALS['current_user']->team_id;
    //    if(empty($year))
    //        $year = date('Y');
    //    $rs_rate     = $GLOBALS['db']->query("SELECT id, value FROM j_targetconfig WHERE team_id='$team_id' AND deleted=0 AND type='Loyalty Redemption Rate ($mem_level)' AND year='$year' AND time_unit='$year' AND frequency='Yearly'");
    //    $redemp_rate= $GLOBALS['db']->fetchByAssoc($rs_rate);
    //    if(empty($redemp_rate))
    $redemp_rate = array('id' => '','value' => $GLOBALS['app_list_strings']['default_loyalty_rate']['Conversion Rate']);
    return $redemp_rate;
}
?>
