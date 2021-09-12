<?php
/**
* Thêm Học viên vào các lớp
* Tạo Situation của học viên trong các lớp
* Đưa vào Start Study - End Study tự động thay đổi Start và End theo lịch lớp
*
*/
function addToClass($bean_payment,$settle_date =''){
    global $timedate;
    require_once('custom/include/_helper/junior_revenue_utils.php');

    $student_id = $bean_payment->contacts_j_payment_1contacts_ida;
    $student    = BeanFactory::getBean('Contacts',$student_id);

    $unit_price   = ($bean_payment->payment_amount + $bean_payment->deposit_amount + $bean_payment->paid_amount) / ($bean_payment->total_hours + $bean_payment->paid_hours);

    $classInfoArray = json_decode(html_entity_decode($bean_payment->content),true);

    foreach ($classInfoArray as $class_id => $classInfo){

        //Delete Demo, Outstanding trong lớp trước khi Enroll
        $q1 = "SELECT DISTINCT IFNULL(id, '') situation_id FROM j_studentsituations WHERE (type IN ('Demo', 'OutStanding')) AND (student_id = '$student_id') AND (ju_class_id = '$class_id') AND deleted = 0";
        $rs1 = $GLOBALS['db']->query($q1);
        while($row1= $GLOBALS['db']->fetchByAssoc($rs1)){
            removeJunFromSession($row1['situation_id']);
            $GLOBALS['db']->query("UPDATE j_studentsituations SET deleted=1 WHERE id='{$row1['situation_id']}'");
        }
        $enrollPart = splitEnroll($bean_payment);

        // Chạy từng đoạn để tạo situation hay settle tương ứng
        foreach ($enrollPart as $key => $value) {
            //Kiểm tra số buổi học còn lại
            $sss        = get_list_lesson_by_class($class_id, $value['start_study'], $value['end_study']);

            $total_hour_unfm = 0;
            for($i = 0; $i < count($sss); $i++)
                $total_hour_unfm += $sss[$i]['delivery_hour'];

            $first = reset($sss);
            $date_first = date('Y-m-d',strtotime("+7 hours ".$first['date_start']));

            $last = end($sss);
            $date_last = date('Y-m-d',strtotime("+7 hours ".$last['date_start']));

            $start_hour = format_number($first['till_hour'] - $first['delivery_hour'],2,2);
            if($start_hour <= '0.2') $start_hour = 0;
            if($total_hour_unfm > 0){
                // Tao Situation Enroll
                $stu_si                 = BeanFactory::newBean('J_StudentSituations');
                $stu_si->name           = $student->full_student_name;
                $stu_si->student_type   = 'Contacts';
                $stu_si->student_id     = $student->id;
                $stu_si->ju_class_id    = $class_id;
                $stu_si->payment_id     = $bean_payment->id;
                $stu_si->total_hour     = format_number($total_hour_unfm,2,2);
                $stu_si->total_amount   = format_number($total_hour_unfm * $unit_price);
                $stu_si->start_study    = $timedate->to_display_date($date_first);
                $stu_si->end_study      = $timedate->to_display_date($date_last);
                $stu_si->type2          = $value['type2'];
                $stu_si->type           = $value['type'];
                $stu_si->start_hour     = $start_hour;

                // Nếu edit enrollment thì lấy settle cũ
                if($settle_date != '')
                    $stu_si->settle_date    = $timedate->convertToDBDate($settle_date);
                else
                    $stu_si->settle_date    = $timedate->nowDate();
                //Nếu chưa lock data thì Settle Date = $date_first
                //                if(checkDataLockDate($date_first))
                //                    $stu_si->settle_date    = $stu_si->start_study;

                $stu_si->assigned_user_id   = $bean_payment->assigned_user_id;
                $stu_si->team_id            = $bean_payment->team_id;
                $stu_si->team_set_id        = $bean_payment->team_id;
                $stu_si->save();
                // Add học viên vào lớp
                for($i = 0; $i < count($sss); $i++)
                    addJunToSession($stu_si->id , $sss[$i]['primaryid'] );
            }
        }

    }
}

/*  Split Settle & Enrolled
*/
function splitEnroll($bean){
    //Tạm thời xử lý ko tạo Settle
    $situation_arr = array();
    $json_ost = json_decode(html_entity_decode($bean->outstanding_list),true);
    if($bean->is_outstanding && !empty($json_ost)){
        //
    }

    $json_sponsor = json_decode(html_entity_decode($_POST['sponsor_list']),true);
    $spon_type    = array_column($json_sponsor, 'foc_type');
    $type2 = 'Enrolled';
    if(in_array('Retake',$spon_type)) $type2 = 'Retake';

    $json_payment = json_decode(html_entity_decode($bean->payment_list),true);
    $paymentUsedIds = array();

    foreach($json_payment["paid_list"] as $pay_id => $value) $paymentUsedIds[] = $pay_id;
    foreach($json_payment["deposit_list"] as $pay_id => $value) $paymentUsedIds[] = $pay_id;

    $resDelay = $GLOBALS['db']->getOne("SELECT COUNT(id) count_delay FROM j_payment WHERE id IN ('".implode("','",$paymentUsedIds)."') AND payment_type = 'Delay' AND deleted = 0 AND remain_amount > 0");
    if(!empty($resDelay))
        $type2 = 'Return';

    $situation_arr[] = array(
        'start_study'   => $bean->start_study,
        'end_study'     => $bean->end_study,
        'total_hour'    => $bean->tuition_hours,
        'type2'         => $type2,
        'type'          => 'Enrolled',
    );
    return $situation_arr;
}

/*Function checkSituationInClass() để kiểm tra student bất kỳ có tồn tại situation nào hay không
* Tham số truyền vào:
* id của lớp
* id của student đó
*/
function checkSituationInClass($id_class = '',$id_student = ''){
    $sql_get_situ = "SELECT DISTINCT
    IFNULL(j_studentsituations.id, '') primaryid
    FROM j_studentsituations
    INNER JOIN contacts l1 ON j_studentsituations.student_id = l1.id AND l1.deleted = 0
    INNER JOIN j_class l2 ON j_studentsituations.ju_class_id = l2.id AND l2.deleted = 0
    WHERE l1.id = '$id_student'
    AND l2.id = '$id_class'
    AND j_studentsituations.deleted = 0";

    $result_get = $GLOBALS['db']->query($sql_get_situ);
    $row_get= $GLOBALS['db']->fetchByAssoc($result_get);
    if(empty($row_get)){
        $GLOBALS['db']->query("UPDATE j_class_contacts_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}'
            WHERE j_class_contacts_1contacts_idb ='{$student_id}'
            AND j_class_contacts_1j_class_ida = '{$id_class}'");
    }
}

/**
* add Student To Session
*/
function addJunToSession($situation_id , $ss_id = '' , $student_id = ''){
    if(empty($situation_id))
        die();

    if(empty($student_id))
        $student_id = $GLOBALS['db']->getOne("SELECT student_id FROM j_studentsituations WHERE id='$situation_id'");

    if(empty($student_id))
        return false;

    //Check duplicate
    $q1 = "SELECT id
    FROM meetings_contacts
    WHERE meeting_id = '$ss_id'
    AND contact_id = '$student_id'
    AND situation_id = '$situation_id'
    AND deleted = 0";
    $id = $GLOBALS['db']->getOne($q1);

    if(empty($id)){
        //Them hoc vien vao session
        $q2 = "INSERT INTO meetings_contacts
        (id, meeting_id, contact_id, required, accept_status, date_modified, deleted, situation_id) VALUES
        ('".create_guid()."', '$ss_id', '$student_id', '1', 'none', '".$GLOBALS['timedate']->nowDb()."', '0', '$situation_id')";
        $GLOBALS['db']->query($q2);
    }

    //Add Relationship class
    $classId = $GLOBALS['db']->getOne("SELECT ju_class_id FROM meetings WHERE id = '$ss_id' AND deleted = 0");
    $q3 = "SELECT id
    FROM j_class_contacts_1_c
    WHERE j_class_contacts_1j_class_ida = '$classId'
    AND j_class_contacts_1contacts_idb = '$student_id'
    AND deleted = 0";
    $rel_class_id = $GLOBALS['db']->getOne($q3);
    if(empty($rel_class_id)){
        $q4 = "INSERT INTO j_class_contacts_1_c (id, date_modified, deleted, j_class_contacts_1j_class_ida, j_class_contacts_1contacts_idb) VALUES ('".create_guid()."', '".$GLOBALS['timedate']->nowDb()."', '0', '$classId', '$student_id')";
        $GLOBALS['db']->query($q4);
    }
    // Update attendance
    $qr2 = "UPDATE c_attendance SET deleted = 0, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE meeting_id ='$ss_id' AND student_id = '$student_id'";
    $GLOBALS['db']->query($qr2);
}
//Add Lead To Session
function addLeadToSession($situation_id , $ss_id = '' , $lead_id = ''){
    if(empty($situation_id))
        die();

    if(empty($lead_id))
        $lead_id = $GLOBALS['db']->getOne("SELECT student_id FROM j_studentsituations WHERE id='$situation_id'");

    if(empty($lead_id))
        return false;

    //Check duplicate
    $q1 = "SELECT id
    FROM meetings_leads
    WHERE meeting_id = '$ss_id'
    AND lead_id = '$lead_id'
    AND situation_id = '$situation_id'
    AND deleted = 0";
    $id = $GLOBALS['db']->getOne($q1);

    if(empty($id)){
        //Them hoc vien vao session
        $q2 = "INSERT INTO meetings_leads
        (id, meeting_id, lead_id, required, accept_status, date_modified, deleted, situation_id) VALUES
        ('".create_guid()."', '$ss_id', '$lead_id', '1', 'none', '".$GLOBALS['timedate']->nowDb()."', '0', '$situation_id')";
        $GLOBALS['db']->query($q2);
    }

    //    //Add Relationship class
    //    $classId = $GLOBALS['db']->getOne("SELECT ju_class_id FROM meetings WHERE id = '$ss_id' AND deleted = 0");
    //    $q3 = "SELECT id
    //    FROM j_class_leads_1_c
    //    WHERE j_class_leads_1j_class_ida = '$classId'
    //    AND j_class_leads_1leads_idb = '$lead_id'
    //    AND deleted = 0";
    //    $rel_class_id = $GLOBALS['db']->getOne($q3);
    //    if(empty($rel_class_id)){
    //        $q4 = "INSERT INTO j_class_leads_1_c (id, date_modified, deleted, j_class_leads_1j_class_ida, j_class_leads_1leads_idb) VALUES ('".create_guid()."', '".$GLOBALS['timedate']->nowDb()."', '0', '$classId', '$lead_id')";
    //        $GLOBALS['db']->query($q4);
    //    }
}

/**
* Xóa học viên ra khỏi session
*/
function removeJunFromSession($situation_id, $meeting_id = ''){
    if(empty($situation_id))
        die();
    $arr_meeting_id = array();
    $ext_meeting = '';
    if(!empty($meeting_id)){
        $arr_meeting_id[] = $meeting_id;
        $ext_meeting = "AND meeting_id = '$meeting_id'";
    }else{
        $rs_meeting = $GLOBALS['db']->query("SELECT DISTINCT meeting_id FROM meetings_contacts WHERE situation_id = '$situation_id' AND deleted = 0");
        while($r1 = $GLOBALS['db']->fetchByAssoc($rs_meeting)){
            $arr_meeting_id[] = $r1['meeting_id'];
        }
    }
    $GLOBALS['db']->query("UPDATE meetings_contacts SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE situation_id = '$situation_id' $ext_meeting");

    $rs1        = $GLOBALS['db']->query("SELECT ju_class_id, student_id FROM j_studentsituations WHERE id = '$situation_id'");
    $rel_class  = $GLOBALS['db']->fetchByAssoc($rs1);
    $student_id = $rel_class['student_id'];
    $classId    = $rel_class['ju_class_id'];
    //
    $qr2 = "UPDATE c_attendance SET deleted = 1, date_modified='{$GLOBALS['timedate']->nowDb()}', modified_user_id='{$GLOBALS['current_user']->id}' WHERE meeting_id IN ("."'".implode("','",$arr_meeting_id)."'".") AND student_id = '$student_id' AND deleted=0";
    $GLOBALS['db']->query($qr2);
    //Remove Relationship class
    $q2= "SELECT DISTINCT
    IFNULL(COUNT(meetings.id), 0) meetings__allcount
    FROM
    meetings
    INNER JOIN
    j_class l1 ON meetings.ju_class_id = l1.id
    AND l1.deleted = 0
    INNER JOIN
    meetings_contacts l2_1 ON meetings.id = l2_1.meeting_id
    AND l2_1.deleted = 0
    INNER JOIN
    contacts l2 ON l2.id = l2_1.contact_id
    AND l2.deleted = 0
    WHERE
    (((l1.id = '$classId')
    AND (l2.id = '$student_id')
    AND (meetings.session_status <> 'Cancelled')))
    AND meetings.deleted = 0";
    $countSession = $GLOBALS['db']->getOne($q2);
    if ($countSession == 0){
        $sqlRemoveClass = "UPDATE j_class_contacts_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}'
        WHERE deleted <> 1
        AND j_class_contacts_1j_class_ida = '$classId'
        AND j_class_contacts_1contacts_idb = '$student_id'";
        $result = $GLOBALS['db']->query($sqlRemoveClass);
    }
}

//Remove Lead From Session
function removeLeadFromSession($situation_id, $meeting_id = ''){
    if(empty($situation_id))
        die();

    $ext_meeting = '';
    if(!empty($meeting_id))
        $ext_meeting = "AND meeting_id = '$meeting_id'";
    $GLOBALS['db']->query("UPDATE meetings_leads SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE situation_id = '$situation_id' $ext_meeting");
}



/**
* Kiểm tra nếu học viên không còn session trong lớp thì deleted quan hệ học viên với lớp
*/
function deleteRelStudentClass($class_id = '' , $student_id = '' ){
    $q1 = "SELECT DISTINCT
    COUNT(IFNULL(meetings.id,'')) count_ss
    FROM meetings
    INNER JOIN  j_class l1 ON meetings.ju_class_id=l1.id AND l1.deleted=0
    INNER JOIN  meetings_contacts l2_1 ON meetings.id = l2_1.meeting_id AND l2_1.deleted=0
    INNER JOIN  contacts l2 ON l2.id=l2_1.contact_id AND l2.deleted=0
    WHERE ((l2.id = '$student_id'
    AND (l1.id='$class_id')))
    AND  meetings.deleted=0 ";
    $count_ss = $GLOBALS['db']->getOne($q1);
    if($count_ss == 0)
        $GLOBALS['db']->query("UPDATE j_class_contacts_1_c SET deleted = 1 WHERE j_class_contacts_1j_class_ida='$class_id' AND j_class_contacts_1contacts_idb='$student_id' AND deleted = 0");
    else return false;
    return true;
}

/* functiond Lấy danh sách student kèm thông tin giờ học trong khoảng thời gian
*/
function GetStudentsProcessInClass($class_id, $start_change = ''){
    require_once("custom/include/_helper/junior_revenue_utils.php");
    global $timedate;
    //Lấy tất cả Situation có liên quan đến change lịch
    if(!empty($start_change))
        $ext_start_change = "AND (j_studentsituations.end_study >= '{$timedate->convertToDBDate($start_change,false)}')";

    $q1 = "SELECT DISTINCT
    IFNULL(j_studentsituations.id, '') situation_id,
    IFNULL(j_studentsituations.student_id, '') student_id,
    IFNULL(j_studentsituations.name, '') student_name,
    j_studentsituations.start_study start_study,
    j_studentsituations.end_study end_study,
    IFNULL(j_studentsituations.start_hour, 0) start_hour,
    IFNULL(j_studentsituations.total_hour, 0) total_hour,
    IFNULL(j_studentsituations.payment_id, '') payment_id,
    IFNULL(l2.status, '') payment_status,
    j_studentsituations.type type
    FROM j_studentsituations
    INNER JOIN
    j_class l1 ON j_studentsituations.ju_class_id = l1.id
    AND l1.deleted = 0
    LEFT JOIN
    j_payment l2 ON j_studentsituations.payment_id = l2.id
    AND l2.deleted = 0
    WHERE
    (((l1.id = '$class_id')
    AND (j_studentsituations.type IN ('Enrolled', 'OutStanding', 'Moving In'))
    $ext_start_change))
    AND j_studentsituations.deleted = 0
    ORDER BY student_id, start_hour ASC";
    $rs1 = $GLOBALS['db']->query($q1);

    $res = array();
    while($st = $GLOBALS['db']->fetchByAssoc($rs1)){
        $res[$st['situation_id']]['start_hour']     = $st['start_hour'];
        $res[$st['situation_id']]['total_hour']     = $st['total_hour'];
        $res[$st['situation_id']]['situa_type']     = $st['type'];
        $res[$st['situation_id']]['start_study']    = $st['start_study'];
        $res[$st['situation_id']]['end_study']      = $st['end_study'];
        $res[$st['situation_id']]['student_id']     = $st['student_id'];
        $res[$st['situation_id']]['student_name']   = $st['student_name'];
        $res[$st['situation_id']]['payment_id']     = $st['payment_id'];
        $res[$st['situation_id']]['payment_status'] = $st['payment_status'];

    }
    return $res;
}

function addStudentToNewSessions($situationArr = '', $class_id = '', $start_change = '', $reset_situation = false){
    require_once("custom/include/_helper/junior_revenue_utils.php");
    global $timedate;
    $ext_start_change = '';
    if(!empty($start_change)){
        $start_tz     = date('Y-m-d H:i:s',strtotime("-7 hours ".$timedate->convertToDBDate($start_change,false)." 00:00:00"));
        $ext_start_change = "AND (l1.date_start >= '$start_tz')";
    }
    //Remove tất cả học viên từ ngày change
    $q1 = "SELECT DISTINCT
    IFNULL(meetings_contacts.id, '') primaryid
    FROM
    meetings_contacts
    INNER JOIN
    meetings l1 ON l1.id = meetings_contacts.meeting_id
    AND l1.deleted = 0
    INNER JOIN
    j_studentsituations l2 ON meetings_contacts.situation_id = l2.id
    AND l2.deleted = 0 AND l2.id IN ('".implode("','",array_keys($situationArr))."')
    INNER JOIN
    j_class l3 ON l2.ju_class_id = l3.id
    AND l3.deleted = 0 AND l3.id = '$class_id'
    WHERE
    ((meetings_contacts.deleted = 0
    $ext_start_change))
    ORDER BY date_start ASC";
    $removeArray = $GLOBALS['db']->fetchArray($q1);
    $class = BeanFactory::getBean("J_Class", $class_id);
    if(!empty($removeArray))
        $GLOBALS['db']->query("UPDATE meetings_contacts SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE id IN ('".implode("','",array_column($removeArray,'primaryid'))."')");
    //Get list New Session by Class
    $ss = get_list_lesson_by_class($class_id);
    $paidSituationType = array('Enrolled','Moving In');
    //render session by date
    $sessions_date = array();
    foreach($ss as $ind=>$value){
        $sessions_date[$value['date']]['primaryid'][]   =  $value['primaryid'];
        $sessions_date[$value['date']]['date']          =  $value['date'];
        $sessions_date[$value['date']]['till_hour']     =  $value['till_hour'];
        $sessions_date[$value['date']]['delivery_hour'] +=  $value['delivery_hour'];
        $sessions_date[$value['date']]['date_start']    =  $value['date_start'];
        $sessions_date[$value['date']]['date_end']      =  $value['date_end'];
    }
    foreach($situationArr as $si_id => $si_value){
        $date_first  = '';
        $date_last   = '';
        foreach($sessions_date as $ss_date => $ss_value){
            $ss_start_till = $ss_value['till_hour'] - $ss_value['delivery_hour'];
            if( ($si_value['total_hour']  >= 0 ) &&  ($si_value['start_hour'] <= $ss_start_till)){
                //Caculate First - Last Session
                $si_value['total_hour'] -= $ss_value['delivery_hour'];
                if($si_value['total_hour'] >= 0) {
                    if(empty($date_first))
                        $date_first = $ss_value['date'];
                    $date_last = $ss_value['date'];
                    foreach($ss_value['primaryid'] as $key => $ss_id )
                        addJunToSession($si_id , $ss_id);
                }
                //Apply viec change Schedule
                else{
                    $delay_hour = $si_value['total_hour'] + $ss_value['delivery_hour'];
                    if($_POST['accept_schedule_change'] == '1' && $delay_hour > 0 && $si_value['payment_status'] != 'Closed'){

                        $situa = BeanFactory::getBean("J_StudentSituations", $si_id);
                        $delay_amount = ($situa->total_amount / $situa->total_hour) * $delay_hour;
                        if(in_array($situa->type, $paidSituationType)){ // Tao payment Change Schedule
                            $pm_delay                                   = new J_Payment();
                            $pm_delay->delay_situation_id               = $si_id;
                            $pm_delay->contacts_j_payment_1contacts_ida = $situa->student_id;
                            $pm_delay->payment_type         = 'Schedule Change';
                            $pm_delay->payment_date         = date('Y-m-d');
                            $pm_delay->payment_expired      = date('Y-m-d',strtotime("+6 months ".$pm_delay->payment_date));
                            $pm_delay->payment_amount       = $delay_amount;
                            $pm_delay->remain_amount        = $delay_amount;
                            $pm_delay->tuition_hours        = $delay_hour;
                            $pm_delay->total_hours          = $delay_hour;
                            $pm_delay->remain_hours         = $delay_hour;
                            $pm_delay->used_hours           = 0;
                            $pm_delay->used_amount          = 0;
                            $pm_delay->note                 = "Auto-Generate when changed schedule.";
                            $pm_delay->assigned_user_id     = $GLOBALS['current_user']->id;
                            $pm_delay->team_id              = $situa->team_id;
                            $pm_delay->team_set_id          = $situa->team_id;
                            $pm_delay->save();
                            addRelatedPayment($pm_delay->id, $situa->payment_id, $delay_amount, $delay_hour);
                        }
                        $new_hour          = $situa->total_hour - $delay_hour;
                        $new_amount        = $situa->total_amount - $delay_amount;
                        if($new_hour == 0 && $new_amount == 0)
                            $GLOBALS['db']->query("UPDATE j_studentsituations SET deleted = 1 WHERE id = '{$situa->id}'");

                        $GLOBALS['db']->query("UPDATE j_studentsituations SET total_amount = $new_amount, total_hour = $new_hour WHERE id = '{$situa->id}'");
                    }
                }

            }
        }

        if(!empty($date_first) && !empty($date_last)){
            //Update Situation Time
            $q3 = "UPDATE j_studentsituations SET start_study = '$date_first', end_study = '$date_last' WHERE id='$si_id'";
            $GLOBALS['db']->query($q3);
        }
    }
}

/**
* ham lay ngay ke tiep buoi cuoi cung cua lop hoc khi cancel sesion
*
* @param mixed $class_id
*/
function getEndNextTimeSession($class_id = '', $duration = '') {
    require_once("custom/include/_helper/junior_schedule.php");

    $rs1 = $GLOBALS['db']->query("SELECT j_class.content content
        FROM
        j_class
        INNER JOIN
        teams l1 ON j_class.team_id = l1.id
        AND l1.deleted = 0
        WHERE
        j_class.id = '$class_id'");
    $class          = $GLOBALS['db']->fetchByAssoc($rs1);
    $run_datetime   = $GLOBALS['db']->getOne("SELECT CONVERT_TZ(MAX(date_start),'+00:00','+7:00') date_start FROM meetings WHERE ju_class_id = '$class_id' AND deleted = 0 AND session_status <> 'Cancelled'");
    $run_begin_date = date('Y-m-d',strtotime($run_datetime));
    $run_date       = $run_begin_date;
    $run_time       = date('H:i:s',strtotime($run_datetime));
    $run_date_display = $GLOBALS['timedate']->to_display_date($run_date,false);
    $holiday_list   = getPublicHolidays($run_date_display,'');

    $json           = json_decode(html_entity_decode($class['content']),true);
    $schedule       = $json['schedule'];
    $count_while = 0;
    if(!empty($schedule)){
        while($duration > 0){
            $count_while++;
            if($count_while > 1000){
                die();
            }
            $chck_day   = date('D',strtotime($run_date));
            if (array_key_exists($chck_day, $schedule) && !array_key_exists($run_date, $holiday_list)){
                foreach($schedule[$chck_day] as $key => $sche){
                    if(($run_date == $run_begin_date)){
                        if($sche['start_time'] > $run_time){
                            $run_time = $sche['start_time'];
                            $duration = 0;
                            break;
                        }elseif($key == (count($schedule[$chck_day]) - 1))
                            $run_date   = date('Y-m-d',strtotime('+1 day'. $run_date));
                    }else{
                        $run_time = $sche['start_time'];
                        $duration = 0;
                        break;
                    }
                }
            }else
                $run_date   = date('Y-m-d',strtotime('+1 day'. $run_date));
        }
    }

    return $run_date.' '.$run_time;
}

function addRelatedPayment($payment_id = '', $get_from_payment_id = '', $amount = '', $hour = ''){
    $sql = "UPDATE j_payment_j_payment_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_payment_j_payment_1j_payment_ida='$payment_id' AND j_payment_j_payment_1j_payment_idb='$get_from_payment_id' AND deleted = 0";
    $GLOBALS['db']->query($sql);
    if(empty($amount)) $amount = 0;
    if(empty($hour)) $hour = 0;

    $sql2 = "INSERT INTO j_payment_j_payment_1_c
    (id, date_modified, deleted, j_payment_j_payment_1j_payment_ida, j_payment_j_payment_1j_payment_idb, hours, amount) VALUES
    ('".create_guid()."','".$GLOBALS['timedate']->nowDb()."',0, '$payment_id', '$get_from_payment_id', $hour, $amount)";
    $GLOBALS['db']->query($sql2);
}

function removeRelatedPayment($payment_id, $get_from_payment_id = ''){
    if(!empty($get_from_payment_id)){
        $sql = "UPDATE j_payment_j_payment_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_payment_j_payment_1j_payment_ida='$payment_id' AND j_payment_j_payment_1j_payment_idb='$get_from_payment_id' AND deleted = 0";
        $GLOBALS['db']->query($sql);
    }else{
        $sql = "UPDATE j_payment_j_payment_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_payment_j_payment_1j_payment_ida='$payment_id' AND deleted = 0";
        $GLOBALS['db']->query($sql);

        $sql = "UPDATE j_payment_j_payment_1_c SET deleted=1, date_modified='{$GLOBALS['timedate']->nowDb()}' WHERE j_payment_j_payment_1j_payment_idb='$payment_id' AND deleted = 0";
        $GLOBALS['db']->query($sql);
    }
}

function getListIssue($class_id = ''){
    require_once('custom/include/_helper/junior_revenue_utils.php');
    global $timedate;

    $q1 = "SELECT DISTINCT
    IFNULL(j_studentsituations.id, '') situation_id,
    IFNULL(l1.id, '') class_id,
    IFNULL(j_studentsituations.student_id, '') student_id,
    IFNULL(j_studentsituations.name, '') situation_name,
    j_studentsituations.start_study start_study,
    j_studentsituations.end_study end_study,
    j_studentsituations.total_amount total_amount,
    j_studentsituations.total_hour total_hour,
    l1.hours class_hour
    FROM
    j_studentsituations
    INNER JOIN
    j_class l1 ON j_studentsituations.ju_class_id = l1.id
    AND l1.deleted = 0 AND l1.class_type = 'Normal Class'
    INNER JOIN
    j_payment l2 ON j_studentsituations.payment_id = l2.id
    AND l2.deleted = 0
    WHERE
    (( (j_studentsituations.type IN ('Enrolled' , 'OutStanding','Moving In'))
    AND (l2.status <> 'Closed')
    AND (l1.id = '$class_id')))
    AND j_studentsituations.deleted = 0";

    $rs1 = $GLOBALS['db']->query($q1);
    $count = 0;
    $count_2 = 0;
    $html1 = '';
    $html2 = '';

    while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
        $ses = get_list_lesson_by_situation($row['class_id'], $row['situation_id'], '', '', 'INNER');
        $cr_ss = '***';
        $cr_hour = 0;
        $cr_lesson = $ses[0]['lesson_number'];
        $flag_lesson = true;
        $cr_lesson_wrong = array();
        for($i = 0; $i < count($ses); $i++){
            $cr_ss = $ses[$i]['situation_id'];
            if(!empty($cr_ss))
                $cr_hour += $ses[$i]['delivery_hour'];

            if($cr_lesson != $ses[$i]['lesson_number']){
                $flag_lesson = false;
                $cr_lesson_wrong[] = $ses[$i]['lesson_number'];
            }
            $cr_lesson++;
        }

        //Dinh dang truong hop
        if( $row['total_hour'] != $cr_hour ){
            $count++;
            $html1.= "<a href='#bwc/index.php?module=Contacts&action=DetailView&record={$row['student_id']}'>  {$row['situation_name']} </a>  <br>Totall Enroll Hours: {$row['total_hour']} <br>Revenue Hour: = $cr_hour </b><br><br>";
        }
        if(!$flag_lesson){
            $first = reset($ses);
            $date_first = $timedate->to_display_date(date('Y-m-d',strtotime("+7 hours ".$first['date_start'])), false);

            $html2 .=  "<a href='#bwc/index.php?module=Contacts&action=DetailView&record={$row['student_id']}'>  {$row['situation_name']} </a> Từ ngày: $date_first. Thứ tự bị add sai từ Session thứ {$cr_lesson_wrong[0]}<br>";
            $count_2++;
        }
    }
}

function generateSmartSchedule($class_id = ''){
    require_once('custom/include/_helper/junior_revenue_utils.php');
    global $timedate;

    $sss = get_list_lesson_by_class($class_id);
    $schedule   = array();
    for($i = 0; $i < count($sss); $i++){

        $this_start = strtotime('+ 7hour '.$sss[$i]['date_start']);
        $this_end   = strtotime('+ 7hour '.$sss[$i]['date_end']);

        $this_date  = date('d/m/Y',$this_start);
        $week_date  = date('D',$this_start);
        $time       = date('g:i',$this_start).' - '.date('g:ia',$this_end);

        $schedule[$week_date.' '.$time][] = $this_date;
    }
    foreach($schedule as $key => $value){
        $first  = reset($value);
        $last   = end($value);
        $schedule_obj[$key]       = "$first &#x279c; $last";
    }
    return json_encode($schedule_obj);
}

function getUnpaidPaymentByClass($class_id){
    $q1 = "SELECT DISTINCT
    IFNULL(l2.id, '') l2_id
    FROM
    j_studentsituations
    INNER JOIN
    j_class l1 ON j_studentsituations.ju_class_id = l1.id
    AND l1.deleted = 0
    INNER JOIN
    j_payment l2 ON j_studentsituations.payment_id = l2.id
    AND l2.deleted = 0
    INNER JOIN
    j_paymentdetail l3 ON l2.id = l3.payment_id AND l3.deleted = 0
    WHERE
    (((l1.id = '$class_id')
    AND (l3.status = 'Unpaid')
    AND (j_studentsituations.type IN ('Enrolled' , 'Moving In'))))
    AND j_studentsituations.deleted = 0";
    $rs1 = $GLOBALS['db']->query($q1);
    $unpaidList = array();
    while($row= $GLOBALS['db']->fetchByAssoc($rs1))
        $unpaidList[] = $row['l2_id'];
    return $unpaidList;
}

function getListAttendanceStudent($classId = '', $lessonDate = ''){
    global $timedate, $current_user;
    $lessonDateDb = $timedate->convertToDBDate($lessonDate, false);

    //check session in date
    $sqlCheckSes = "SELECT id, description, duration_cal FROM meetings
    WHERE ju_class_id = '{$classId}'
    AND deleted = 0
    AND DATE(CONVERT_TZ(meetings.date_start,'+00:00','+7:00')) = '{$lessonDateDb}'
    LIMIT 1";
    $result = $GLOBALS['db']->query($sqlCheckSes);
    $rowSession = $GLOBALS['db']->fetchByAssoc($result);
    $sessionId = $rowSession['id'];
    $description = $rowSession['description'];
    $duration = floor($rowSession['duration_cal']);
    // $sessionId = $GLOBALS['db']->getOne($sqlCheckSes);

    $session = BeanFactory::getBean('Meetings', $sessionId,array('disable_row_level_security' => true));
    $class = BeanFactory::getBean("J_Class",$session->ju_class_id,array('disable_row_level_security' => true));

    if (empty($session->id) || empty($class->id)) {
        return json_encode(
            array(
                "success" => "0",
                "session_id" => $session->id,
            )
        );
    }

    //Get All student have relationship with this class
    $sqlAllStudent = "SELECT rss.* FROM ((SELECT DISTINCT
    IFNULL(c.id, '') student_id,
    IFNULL(c.full_student_name, '') student_name,
    IFNULL(c.picture, '') picture,
    IFNULL(c.contact_id, '') portal_id,
    IFNULL(c.phone_mobile, '') student_phone,
    'Contacts' student_type,
    c.birthdate birthdate,
    IFNULL(c.nick_name, '') nick_name,
    c.guardian_name parent_name,
    mc.meeting_id session_id,
    IFNULL(ss.type, '') situation_type,
    IFNULL(a.id, '') atd_id,
    IFNULL(a.attended, 0) attended,
    IFNULL(a.attendance_type, '') attendance_type,
    IFNULL(a.homework, 0) homework,
    IFNULL(a.homework_comment, '') homework_comment,
    IFNULL(a.care_comment, '') care_comment,
    IFNULL(a.homework_score, '') homework_score,
    IFNULL(a.absent_for_hour, 0) absent_for_hour,
    a.description description,
    b.point loyalty_point
    FROM contacts c
    INNER JOIN j_class_contacts_1_c cc ON cc.j_class_contacts_1contacts_idb = c.id AND c.deleted = 0 AND cc.deleted = 0 AND cc.j_class_contacts_1j_class_ida = '$classId'
    LEFT JOIN meetings_contacts mc ON mc.contact_id = c.id AND mc.deleted = 0 AND mc.meeting_id = '$sessionId'
    INNER JOIN j_studentsituations ss ON mc.situation_id = ss.id AND ss.deleted=0
    LEFT JOIN c_attendance a ON a.student_id = c.id AND a.meeting_id = '$sessionId' AND a.deleted = 0
    LEFT JOIN j_loyalty b ON b.student_id = c.id AND b.meeting_id = '$sessionId' AND b.deleted = 0)
    UNION ALL
    (SELECT DISTINCT
    IFNULL(c.id, '') student_id,
    IFNULL(c.full_lead_name, '') student_name,
    IFNULL(c.picture, '') picture,
    IFNULL(c.contact_id, '') portal_id,
    IFNULL(c.phone_mobile, '') student_phone,
    'Leads' student_type,
    c.birthdate birthdate,
    IFNULL(c.nick_name, '') nick_name,
    c.guardian_name parent_name,
    mc.meeting_id session_id,
    IFNULL(ss.type, '') situation_type,
    IFNULL(a.id, '') atd_id,
    IFNULL(a.attended, 0) attended,
    IFNULL(a.attendance_type, '') attendance_type,
    IFNULL(a.homework, 0) homework,
    IFNULL(a.homework_comment, '') homework_comment,
    IFNULL(a.care_comment, '') care_comment,
    IFNULL(a.homework_score, '') homework_score,
    IFNULL(a.absent_for_hour, 0) absent_for_hour,
    a.description description,
    b.point loyalty_point
    FROM leads c
    INNER JOIN j_studentsituations ss ON c.id = ss.student_id AND ss.type = 'Demo' AND ss.ju_class_id ='$classId'
    LEFT JOIN meetings_leads mc ON mc.lead_id = c.id AND mc.deleted = 0 AND mc.meeting_id = '$sessionId'
    LEFT JOIN c_attendance a ON a.student_id = c.id AND a.meeting_id = '$sessionId' AND a.deleted = 0
    LEFT JOIN j_loyalty b ON b.student_id = c.id AND b.meeting_id = '$sessionId' AND b.deleted = 0)) rss ORDER BY rss.session_id DESC ,rss.student_id ASC";
    $rsAllStudent = $GLOBALS['db']->query($sqlAllStudent);

    $runStudentId   = '###';
    $count_dup      = 0;
    $count_error    = 0;

    $count = 1;
    $array_student = array();
    while ($row = $GLOBALS['db']->fetchByAssoc($rsAllStudent)) {
        if (empty($row['atd_id']) && !empty($row['session_id'])) {
            $attendanceBean = new C_Attendance();
            $attendanceBean->student_id = $row["student_id"];
            $attendanceBean->student_type = $row["student_type"];
            $attendanceBean->meeting_id = $session->id;
            $attendanceBean->class_id   = $class->id;
            $attendanceBean->date_input = $timedate->to_display_date($session->date_start);
            $attendanceBean->team_id = $class->team_id;
            $attendanceBean->team_set_id = $attendanceBean->team_id;
            $attendanceBean->save();
            $attend_id = $attendanceBean->id;
        } else $attend_id = $row['atd_id'];

        //Fix loi duplicate Student
        if($runStudentId == $row["student_id"]) $count_dup++;
        else $count_dup = 0;

        if($count_dup > 0){
            //Delete Duplicated
            $GLOBALS['db']->query("DELETE FROM c_attendance WHERE id = '$attend_id'");
            $count_error++;
            continue;
        }

        $array_student[$count]['session_id'] = $row['session_id'];
        $array_student[$count]['student_id'] = $row['student_id'];
        $array_student[$count]['portal_id'] = $row['portal_id'];
        $array_student[$count]['student_name'] = $row['student_name'];
        $array_student[$count]['picture'] = $row['picture'];
        $array_student[$count]['student_type'] = $row['student_type'];
        $array_student[$count]['situation_type'] = $row['situation_type'];
        $array_student[$count]['student_phone'] = $row['student_phone'];
        $array_student[$count]['birthdate'] = $row['birthdate'];
        $array_student[$count]['nick_name'] = $row['nick_name'];
        $array_student[$count]['attend_id'] = $attend_id;
        $array_student[$count]['attendance_type'] = $row['attendance_type'];
        $array_student[$count]['homework_score'] = $row['homework_score'];
        $array_student[$count]['care_comment'] = $row['care_comment'];
        $array_student[$count]['homework_comment'] = $row['homework_comment'];
        $array_student[$count]['description'] = $row['description'];
        $array_student[$count]['parent_name'] = $row['parent_name'];
        $array_student[$count]['attended'] = $row['attended'];
        $array_student[$count]['homework'] = $row['homework'];
        $array_student[$count]['loyalty_point'] = $row['loyalty_point'];
        $count++;
        $runStudentId = $row['student_id'];
    }
    //        if($count_error > 0)
    //            return json_encode(array(
    //            "success" => "0",
    //            "content" => "<tr><td colspan='100%' style='text-align:center;color:red;font-weight:bold;'>".translate('LBL_ERROR_ATTENDANCE','J_Class')."</td></tr>",
    //            ));

    return json_encode(
        array(
            "success"               => "1",
            "session_id"            => $sessionId,
            "session_description"   => $description,
            "array_student"         => $array_student,
        )
    );
}

function saveAttendanceUtils($data = ''){

    global $timedate;

    if(!empty($data['session_id']) && !empty($data['class_id'])){
        $s1 =  $GLOBALS['db']->query("SELECT id, duration_cal, ju_class_id, team_id, date_start FROM meetings WHERE deleted = 0 AND id = '{$data['session_id']}' AND ju_class_id = '{$data['class_id']}' AND session_status <> 'Cancelled'");
        $session = $GLOBALS['db']->fetchByAssoc($s1);
    }else return json_encode(array( "success" => "0"));

    $field_name =  $data['savePos'];
    $field_val  =  $data['saveVal'];

    if(!empty($data['attend_id']) && !empty($field_name)){
        $params = array('disable_row_level_security' => true);
        $att = BeanFactory::getBean('C_Attendance',$data['attend_id'],$params);
        if(empty($att->id)) return json_encode(array( "success" => "0"));

        //Save Attendance Type
        if($field_name == 'attendance_type')    {
            switch ($field_val) {
                case 'P':
                    $absent_for_hour =  $session['duration_cal'];
                    break;
                case 'L':
                    $absent_for_hour =  $session['duration_cal'] * '0.5';
                    break;
                case 'A':
                case 'E':
                    $absent_for_hour =  0;
                    break;
            }

            $att->attendance_type = $field_val;
            $att->absent_for_hour = $absent_for_hour;

            //Change status of lead from Ready PT/Demo to PT/Demo
            $leadbean = BeanFactory::getBean('Leads', $data['student_id']);
            if(!empty($leadbean->id)) {
                if ($field_val == 'P' || $field_val == 'L')
                    $leadbean->status = 'PT/Demo';
                else
                    $leadbean->status = 'Ready to Demo';
                $leadbean->save();
            }
        }else //Save another fields
            $att->$field_name = $field_val;

        $att->meeting_id  = $session['id'];
        $att->team_id     = $session['team_id'];
        $att->class_id    = $session['ju_class_id'];
        $att->date_input  = $timedate->to_display_date($session['date_start']);
        $att->save();

        //New loyalty
        $result = $GLOBALS['db']->query("SELECT COUNT(id) _count FROM j_loyalty WHERE meeting_id ='{$session['id']}'
            AND student_id ='{$att->student_id}'");
        $check = $GLOBALS['db']->fetchByAssoc($result);

        if ($field_name == 'loyalty_point') {
            if(!empty($field_val) && $field_val >= '0' && $field_val <= '10') {
                //delete old loyalty
                if ($check['_count'] == "1")
                    $GLOBALS['db']->query("DELETE FROM j_loyalty WHERE meeting_id ='{$session['id']}'
                        AND student_id ='{$att->student_id}' ");

                // Create new loyalty
                $loyaltybean = BeanFactory::newBean('J_Loyalty');
                $loyaltybean->meeting_id = $att->meeting_id;
                $loyaltybean->point = $field_val;
                $loyaltybean->team_set_id = $session['team_id'];
                $loyaltybean->team_id = $session['team_id'];
                $loyaltybean->rate_in_out = '1000';
                $loyaltybean->type = 'Reward';
                $loyaltybean->student_id = $att->student_id;
                $loyaltybean->input_date = $att->date_input;
                $loyaltybean->j_class_j_loyalty_1j_class_ida = $session['ju_class_id'];
                $loyaltybean->j_class_j_loyalty_1j_loyalty_idb = $session['id'];
                $loyaltybean->description = 'Cộng điểm buổi học ngày '.date("d-m-Y",strtotime($att->date_input));
                $loyaltybean->save();
            }
            else
                return json_encode(array( "success" => "2"));
        }
        return json_encode(array( "success" => "1"));

    }else return json_encode(array( "success" => "0"));
}

function attendenceSendApp(array $args){
    require_once('custom/clients/mobile/helper/NotificationHelper.php');
    $attend = BeanFactory::getBean('C_Attendance', $args['attend_id']);

    if($args['send_type'] == 'send_att'){
        $attend->notificated = 1;
        $attend->save();
        $status = 'RECEIVED';
    }elseif($args['send_type'] == 'send_msg'){
        $notify = new NotificationMobile();
        $status = 'RECEIVED';
        if(!$notify->pushNotification('Bạn có thông báo mới!!', $args['msg'] ,'', '', $attend->student_id))
            $status = 'SENT_FAILED';
    }else
        return json_encode(array("status" => 'FAILED'));

    return  json_encode(array("status" => $status));
}

?>
