<?php
    /**
     * Kiểm tra giáo viên đã dạy session nào trong khoảng thời gian truyển vào hay không
     *
     * @param id         : teacher id
     * @param db_start   : yyyy-mm-dd hh:mm:ss
     * @param db_end     : yyyy-mm-dd hh:mm:ss
     *
     * @return if teacher is free: true || if busy: false
     */
    function checkTeacherInDateime($id= '', $db_start= '', $db_end= '', $session_id = ''){
        $sql = "SELECT DISTINCT id FROM meetings
        WHERE teacher_id = '$id'
        AND ((('$db_start' >= date_start) AND ('$db_start' < date_end))
        OR (('$db_end' > date_start) AND ('$db_end' <= date_end))
        OR (('$db_start' < date_start) AND ('$db_end' > date_end)))
        AND deleted=0
        AND (timesheet_id = '' OR timesheet_id IS NULL)
        AND session_status <> 'Cancelled' AND id <> '$session_id' ";
        $id = $GLOBALS['db']->getOne($sql);

        if(!empty($id)) return false;
        else return true;
    }
    /**
     * Kiểm tra xem giáo viên đã dạy session nào trùng thời gian với session truyển vào hay không
     *
     * @return if teacher is free: true || if busy: false
     */
    function checkTeacherInSession($teacherId= '', $sessionId= ''){
        $sqlGetSession = "SELECT date_start, date_end
        FROM meetings
        WHERE id = '{$sessionId}' AND session_status <> 'Cancelled'";
        $rs = $GLOBALS['db']->query($sqlGetSession);
        $row = $GLOBALS['db']->fetchByAssoc($rs);

        return checkTeacherInDateime($teacherId,$row['date_start'],$row['date_end']);
    }

    /**
     * Check priority of teacher
     *
     * @param teacherId  : teacher id
     * @param classId    : class id
     * @param dayOff     : teacher day off: array("Monday", "Tuesday",...)
     * @param dayOfWeek  : day of session in week:  array("Monday", "Tuesday",...)
     * @param dayOfWoeek : array("Mon","Tue")
     *
     * @return 1 or 2 or 3
     */
    function checkTeacherPriority($teacherId= '', $teaFromPrev= '', $dayOff= '', $dayOfWeek= '', $holidays= ''){
        //Xet Day offf
        $days_name = array();
        foreach($dayOfWeek as $key => $value)
            $days_name[] =  trim(substr($value,0, strpos($value, '|') - 1));

        foreach ($dayOff as $value){
            $day_off = date('l',strtotime($value));
            if (in_array($day_off,$days_name))
                return "3";
        }
        if($holidays > 0) return "3";


        //Xet uu tien teacher day lop truoc
        if(!empty($teaFromPrev)){
            if(in_array($teacherId,$teaFromPrev))
                return "1";
        }

        //Teacher muc do trung binh
        return "2";
    }

    /**
     * check teacher holidays in a list of session
     *
     * @param teacherId  : teacher id
     * @param sessions   : array of session
     *
     * @return number of holidays
     */
    function checkTeacherHolidays($teacherId= '', $session_date= ''){
        global $timedate;
        $sql = "SELECT IFNULL(holiday_date, '') holiday_date
        FROM holidays
        WHERE teacher_id = '$teacherId'
        AND holiday_date in ($session_date)
        AND deleted=0";
        $res = $GLOBALS['db']->query($sql);
        $listHoliday = array();
        while ($row = $GLOBALS['db']->fetchByAssoc($res)){
            $listHoliday[] = date_format(date_create($row['holiday_date']), 'D') . ' - ' . $timedate->to_display_date($row['holiday_date']);
        }
        return $listHoliday;
    }

    function sortTeacherListByTaughtHour($teacherList= ''){
        $hourList = array();
        foreach($teacherList as $value) {
            $hour = $value["total_hour"];
            if (!in_array($hour,$hourList)) $hourList[] = $hour;
        }
        sort($hourList,1);

        $result = array();
        foreach($hourList as $hourItem) {
            foreach($teacherList as $teacherId => $teacher) {
                if ($teacher["total_hour"] == $hourItem) $result[$teacherId] = $teacher;
            }
        }
        return $result;
    }

    /**
     * Get available teachers for a class
     *
     * @param classId    : class id
     * @param date_start : display format ex:dd/mm/yyyy
     * @param date_end   : display format ex:dd/mm/yyyy
     * @param dayOfWoeek : array("Monday","Tuesday")
     *
     * @return array of teachers info
     */
    function getClassSession($classId= '', $date_start= '', $date_end= '', $dayOfWeek= ''){
        global $timedate;
        $date_start_db = $timedate->convertToDBDate($date_start,false);
        $date_end_db = $timedate->convertToDBDate($date_end,false);
        //$date_name = "'".implode("','",$dayOfWeek)."'";
        // Get list of session in class form $db_start to $db_end
        //    $sessionList = array();
        $ext_date = array();

        foreach($dayOfWeek as $key => $value){
            $day_name =  trim(substr($value,0, strpos($value, '|') - 1));
            $time_slot =   substr($value, strpos($value, '|') + 2, strlen($value));
            if(!strpos($time_slot, '&')){
                $slot_start = substr($time_slot, 0, 5);
                $slot_end = substr($time_slot, 8, 13);
                $ext_date[] = "DAYNAME(convert_tz(date_start,'+0:00','+7:00')) = '$day_name'
                AND DATE_FORMAT(convert_tz(date_start,'+0:00','+7:00'), '%H:%i') = '$slot_start'
                AND DATE_FORMAT(convert_tz(date_end,'+0:00','+7:00'), '%H:%i') = '$slot_end'";
            } else $ext_date[] = "DAYNAME(convert_tz(date_start,'+0:00','+7:00')) = '$day_name'";
        }
        $ext_date_string = "AND ((".implode(") OR (",$ext_date)."))";
        $sqlGetSessionList = "SELECT
        id meeting_id,
        date_start time_start,
        date_end time_end,
        Date_format(convert_tz(date_start,'+0:00','+7:00'),'%Y-%m-%d') start_date
        FROM
        meetings
        WHERE
        ju_class_id = '$classId'
        AND deleted = 0
        AND Date_format(convert_tz(date_start,'+0:00','+7:00'),'%Y-%m-%d') >= '$date_start_db'
        AND Date_format(convert_tz(date_end,'+0:00','+7:00'), '%Y-%m-%d') <= '$date_end_db'
        $ext_date_string
        AND session_status <> 'Cancelled'
        ORDER BY  time_start";
        return $GLOBALS['db']->fetchArray($sqlGetSessionList);

        /*while($rowSession = $GLOBALS['db']->fetchByAssoc($rsSessionList)){
        $sessionWeekDate = date('l',strtotime($rowSession['date_start']));
        if (in_array($sessionWeekDate,$dayOfWeek)) {
        $sessionList[$rowSession["id"]] = array(
        "date_start" => $rowSession['date_start'],
        "date_end" => $rowSession['date_end'],
        );
        }
        }

        return $sessionList;    */
    }

    /**
     * Get available teachers for a class
     *
     * @param classId    : class id
     * @param date_start : display format ex:dd/mm/yyyy
     * @param date_end   : display format ex:dd/mm/yyyy
     * @param dayOfWoeek : array("Monday","Tuesday")
     *
     * @return array of teachers info
     */
    function checkTeacherInClass($classId= '', $date_start= '', $date_end= '', $dayOfWeek= ''){
        global $timedate;
        $start_date = $timedate->convertToDBDate($date_start,false);
        $end_date = $timedate->convertToDBDate($date_end,false);
        $classBean = BeanFactory::getBean("J_Class", $classId);
        //    $schedule_list = get_class_schedule($classId, $start_date, $end_date, $dayOfWeek);
        $sessionList = getClassSession($classId, $date_start, $date_end, $dayOfWeek);
        $firstSession = reset($sessionList);
        $endSession = end($sessionList);
        $first_session_date = $firstSession['start_date'];
        $last_session_date = $endSession['start_date'];

        $teacherList = array();
        $q1 = "SELECT DISTINCT
        teacher.id teacher_id
        FROM j_teachercontract
        INNER JOIN c_teachers_j_teachercontract_1_c l1_1 ON j_teachercontract.id = l1_1.c_teachers_j_teachercontract_1j_teachercontract_idb AND l1_1.deleted = 0
        INNER JOIN c_teachers teacher ON teacher.id = l1_1.c_teachers_j_teachercontract_1c_teachers_ida AND teacher.deleted = 0
        INNER JOIN team_sets_teams tst ON tst.team_set_id = teacher.team_set_id AND tst.deleted = 0
        INNER JOIN teams ts ON ts.id = tst.team_id AND ts.deleted = 0 AND ts.id = '{$classBean->team_id}'
        WHERE j_teachercontract.deleted = 0
        AND j_teachercontract.status = 'Active'
        AND teacher.type = 'Teacher' AND teacher.status = 'Active'
        ORDER BY j_teachercontract.contract_until";
        $teacher_list = $GLOBALS['db']->fetchArray($q1);

        $arr_teacher_id = array_column($teacher_list,'teacher_id');

        $str_teacher_id = implode("','",$arr_teacher_id);
        $arr_condition = array();

        foreach($sessionList as $key => $value)
            $arr_condition[] = "date_start < '{$value['time_end']}' AND date_end > '{$value['time_start']}'";

        $str_condition = "(".implode(") OR (", $arr_condition).")";

        $row_teacher = $GLOBALS['db']->fetchArray("(SELECT DISTINCT teacher_id teacher_id
            FROM meetings
            WHERE deleted = 0 AND ($str_condition)
            AND teacher_id in ('$str_teacher_id')
            AND ju_class_id <> '$classId'
            AND meeting_type = 'Session'
            AND session_status <> 'Cancelled')
            UNION DISTINCT
            (SELECT DISTINCT sub_teacher_id teacher_id
            FROM meetings
            WHERE deleted = 0 AND ($str_condition)
            AND sub_teacher_id in ('$str_teacher_id')
            AND ju_class_id <> '$classId'
            AND meeting_type = 'Session'
            AND session_status <> 'Cancelled')");

        //remove teacher busy
        $arr_teacher_id = array_diff($arr_teacher_id, array_column($row_teacher,'teacher_id'));

        $str_teacher_id = implode("','",$arr_teacher_id);

        $ext_this_month = " AND (date_start >= '".date('Y-m-d H:i:s',strtotime("-7 hours ".date('Y-m-01',strtotime($start_date))." 00:00:00"))."' AND date_end <= '".date('Y-m-d H:i:s',strtotime("-7 hours ".date('Y-m-t',strtotime($start_date))." 23:59:59"))."')";

        $sqlTeacherList = "SELECT DISTINCT
        teacher.id teacher_id,
        teacher.full_teacher_name full_teacher_name,
        j_teachercontract.id contract_id,
        j_teachercontract.contract_date contract_date,
        j_teachercontract.contract_until contract_until,
        IFNULL(j_teachercontract.day_off, '') day_off,
        IFNULL(j_teachercontract.description, '') note,
        IFNULL(j_teachercontract.contract_type, '') contract_type,
        j_teachercontract.working_hours_monthly working_hours_monthly,
        IFNULL(mh.sum_hour, 0) taught_hours
        FROM
        j_teachercontract
        INNER JOIN
        c_teachers_j_teachercontract_1_c l1_1 ON j_teachercontract.id = l1_1.c_teachers_j_teachercontract_1j_teachercontract_idb
        AND l1_1.deleted = 0
        INNER JOIN
        c_teachers teacher ON teacher.id = l1_1.c_teachers_j_teachercontract_1c_teachers_ida
        AND teacher.deleted = 0
        INNER JOIN
        team_sets_teams tst ON tst.team_set_id = teacher.team_set_id
        AND tst.deleted = 0
        INNER JOIN
        teams ts ON ts.id = tst.team_id AND ts.deleted = 0
        AND ts.id = '{$classBean->team_id}'
        LEFT OUTER JOIN
        (SELECT
        teacher_id,
        SUM(teaching_hour) sum_hour
        FROM meetings
        WHERE LENGTH(ju_class_id) > 30
        AND LENGTH(teacher_id) > 30
        $ext_this_month
        AND status <> 'Cancelled' AND deleted = 0
        AND teacher_id IN ('$str_teacher_id')
        GROUP BY teacher_id) mh ON mh.teacher_id = teacher.id
        WHERE
        j_teachercontract.deleted = 0
        AND j_teachercontract.status = 'Active'
        AND teacher.id IN ('$str_teacher_id')
        ORDER BY j_teachercontract.contract_until";

        $rsTeacherList = $GLOBALS['db']->query($sqlTeacherList);
        //Get Info class upgrade From
        $teaFromPrev = array();
        if(!empty($classBean->j_class_j_class_1j_class_ida)){
            $qss = "SELECT DISTINCT IFNULL(teacher_id, '') teacher_id
            FROM meetings
            WHERE deleted = 0
            AND (ju_class_id = '{$classBean->j_class_j_class_1j_class_ida}')
            AND (session_status <> 'Cancelled') AND (teacher_id IS NOT NULL) AND (teacher_id <> '')";
            $teaFromPrev = $GLOBALS['db']->fetchArray($qss);
        }

        $arr_session_date = array_column($sessionList,'start_date');
        $str_session_date = "'" . implode("','", $arr_session_date) . "'";
        while($rowTeacher = $GLOBALS['db']->fetchByAssoc($rsTeacherList)){
            $holidays       = checkTeacherHolidays($rowTeacher["teacher_id"], $str_session_date);
            $holidays       = implode("<br>", $holidays);
            $dayOff         = unencodeMultienum($rowTeacher["day_off"]);
            $priority       = checkTeacherPriority($rowTeacher["teacher_id"], $teaFromPrev, $dayOff, $dayOfWeek, $holidays);
            $alertContractUtil = $timedate->to_display_date($rowTeacher["contract_until"],true);
            if($rowTeacher["contract_until"] < $end_date)
                $alertContractUtil = '<span class="error">'.$alertContractUtil.'</span>';


            $teacherList[$rowTeacher["teacher_id"]] = array(
                "teacher_id"      => $rowTeacher["teacher_id"],
                "teacher_name"    => $rowTeacher["full_teacher_name"],
                "contract_id"     => $rowTeacher["contract_id"],
                "contract_type"   => $GLOBALS['app_list_strings']['type_teacher_contract_list'][$rowTeacher["contract_type"]],
                "require_hours"   => format_number($rowTeacher["working_hours_monthly"],2,2),
                "total_hour"      => format_number($rowTeacher['taught_hours'],2,2),
                "contract_until"  => $timedate->to_display_date($rowTeacher["contract_until"],true),
                "contract_until_span"  => $alertContractUtil,
                "day_off"         => str_replace("^","",$rowTeacher["day_off"]),
                "note"         => $rowTeacher["note"],
                "holiday"         => $holidays,
                "priority"        => $priority,
            );
        }

        $teacherList = sortTeacherListByTaughtHour($teacherList);

        return $teacherList;
    }

    function checkTAInClass($classId= '', $date_start= '', $date_end= '', $dayOfWeek= ''){
        global $timedate;
        $start_date = $timedate->convertToDBDate($date_start,false);
        $end_date = $timedate->convertToDBDate($date_end,false);
        $classBean = BeanFactory::getBean("J_Class", $classId);
        //    $schedule_list = get_class_schedule($classId, $start_date, $end_date, $dayOfWeek);
        $sessionList = getClassSession($classId, $date_start, $date_end, $dayOfWeek);
        $firstSession = reset($sessionList);
        $endSession = end($sessionList);
        $first_session_date = $firstSession['start_date'];
        $last_session_date = $endSession['start_date'];

        $teacherList = array();
        $sql_teacher_id = "SELECT DISTINCT
        teacher.id teacher_id,
        teacher.date_entered date_entered
        FROM
        c_teachers teacher
        INNER JOIN
        team_sets_teams tst ON tst.team_set_id = teacher.team_set_id
        AND tst.deleted = 0
        INNER JOIN
        teams ts ON ts.id = tst.team_id AND ts.deleted = 0
        AND ts.id = '{$classBean->team_id}'
        WHERE
        teacher.deleted = 0
        AND teacher.type = 'TA' AND teacher.status = 'Active'
        ORDER BY date_entered DESC";
        $teacher_list = $GLOBALS['db']->fetchArray($sql_teacher_id);
        $arr_teacher_id = array();
        foreach($teacher_list as $key => $value) {
            $arr_teacher_id[] = $value['teacher_id'];
        }

        $str_teacher_id =   "'".implode("','",$arr_teacher_id)."'";
        $session_date = array();
        $arr_condition = array();

        foreach($sessionList as $key => $value){
            $session_date[] = $value['start_date'];
            $arr_condition[] = "date_start < '{$value['time_end']}'
            AND date_end > '{$value['time_start']}'";
        }
        $str_session_date =   "'".implode("','",$session_date)."'";
        $str_condition = "(".implode(") OR (", $arr_condition).")";
        $sql_teacher_in_work = "SELECT DISTINCT
        teacher_id
        FROM
        meetings
        WHERE
        ($str_condition)
        AND teacher_id in ($str_teacher_id)
        AND ju_class_id <> '$classId'
        AND meeting_type = 'Session'
        AND session_status <> 'Cancelled'
        AND deleted = 0";
        $row_teacher = $GLOBALS['db']->fetchArray($sql_teacher_in_work);
        $teacher_in_work = array();
        foreach($row_teacher as $key => $value){
            $teacher_in_work[] = $value['teacher_id'];
        }
        $arr_teacher_id = array_diff($arr_teacher_id, $teacher_in_work);
        $str_teacher_id  =   "'".implode("','",$arr_teacher_id)."'";

        $ext_this_month = " AND (date_start >= '".date('Y-m-d H:i:s',strtotime("-7 hours ".date('Y-m-01',strtotime($start_date))." 00:00:00"))."' AND date_end <= '".date('Y-m-d H:i:s',strtotime("-7 hours ".date('Y-m-t',strtotime($start_date))." 23:59:59"))."')";

        $sqlTeacherList = "SELECT DISTINCT
        teacher.id teacher_id,
        teacher.full_teacher_name full_teacher_name,
        teacher.description note,
        IFNULL(mh.sum_hour, 0) taught_hours
        FROM
        c_teachers teacher
        INNER JOIN
        team_sets_teams tst ON tst.team_set_id = teacher.team_set_id
        AND tst.deleted = 0
        INNER JOIN
        teams ts ON ts.id = tst.team_id AND ts.deleted = 0
        AND ts.id = '{$classBean->team_id}'
        LEFT OUTER JOIN
        (SELECT
        teacher_id, SUM(teaching_hour) sum_hour
        FROM
        meetings
        WHERE
        LENGTH(ju_class_id) > 30
        AND LENGTH(teacher_id) > 30
        $ext_this_month
        AND status <> 'Cancelled'
        AND deleted = 0
        AND teacher_id IN ($str_teacher_id)
        GROUP BY teacher_id) mh ON mh.teacher_id = teacher.id
        WHERE
        teacher.deleted = 0
        AND teacher.status = 'Active'
        AND teacher.id IN ($str_teacher_id)
        ORDER BY teacher.date_entered DESC";

        $rsTeacherList = $GLOBALS['db']->query($sqlTeacherList);
        //Get Info class upgrade From
        $teaFromPrev = array();
        if(!empty($classBean->j_class_j_class_1j_class_ida)){
            $qss = "SELECT DISTINCT IFNULL(teacher_id, '') teacher_id
            FROM meetings
            WHERE deleted = 0
            AND (ju_class_id = '{$classBean->j_class_j_class_1j_class_ida}')
            AND (session_status <> 'Cancelled') AND (teacher_id IS NOT NULL) AND (teacher_id <> '')";
            $teaFromPrev = $GLOBALS['db']->fetchArray($qss);
        }

        while($rowTeacher = $GLOBALS['db']->fetchByAssoc($rsTeacherList)){
            $holidays       = checkTeacherHolidays($rowTeacher["teacher_id"], $str_session_date);
            $dayOff         = unencodeMultienum($rowTeacher["day_off"]);
            $priority       = checkTeacherPriority($rowTeacher["teacher_id"], $teaFromPrev, $dayOff, $dayOfWeek, $holidays);
            $alertContractUtil = $timedate->to_display_date($rowTeacher["contract_until"],true);
            if($rowTeacher["contract_until"] < $end_date)
                $alertContractUtil = '<span class="error">'.$alertContractUtil.'</span>';


            $teacherList[$rowTeacher["teacher_id"]] = array(
                "teacher_id"      => $rowTeacher["teacher_id"],
                "teacher_name"    => $rowTeacher["full_teacher_name"],
                "contract_id"     => $rowTeacher["contract_id"],
                "contract_type"   => $GLOBALS['app_list_strings']['type_teacher_contract_list'][$rowTeacher["contract_type"]],
                "require_hours"   => format_number($rowTeacher["working_hours_monthly"],2,2),
                "total_hour"      => format_number($rowTeacher['taught_hours'],2,2),
                "contract_until"  => $timedate->to_display_date($rowTeacher["contract_until"],true),
                "contract_until_span"  => $alertContractUtil,
                "day_off"         => str_replace("^","",$rowTeacher["day_off"]),
                "note"         => $rowTeacher["note"],
                "holiday"         => $holidays,
                "priority"        => $priority,
            );
        }

        $teacherList = sortTeacherListByTaughtHour($teacherList);

        return $teacherList;
    }

    function checkRoomInClass($classId= '', $date_start= '', $date_end= '', $dayOfWeek= ''){
        global $timedate;
        $start_date = $timedate->convertToDBDate($date_start,false);
        $end_date = $timedate->convertToDBDate($date_end,false);
        $classBean = BeanFactory::getBean("J_Class", $classId);

        $sessionList = getClassSession($classId, $date_start, $date_end, $dayOfWeek);
        $firstSession = reset($sessionList);
        $endSession = end($sessionList);
        $first_session_date = $firstSession['start_date'];
        $last_session_date = $endSession['start_date'];

        $roomList = array();
        $sql_room_id = "SELECT DISTINCT
        room.id room_id,
        room.date_entered date_entered
        FROM
        c_rooms room
        INNER JOIN
        team_sets_teams tst ON tst.team_set_id = room.team_set_id
        AND tst.deleted = 0
        INNER JOIN
        teams ts ON ts.id = tst.team_id AND ts.deleted = 0
        AND ts.id = '{$classBean->team_id}'
        WHERE
        room.deleted = 0 AND room.status = 'Active'
        ORDER BY date_entered DESC";
        $room_list = $GLOBALS['db']->fetchArray($sql_room_id);
        $arr_room_id = array();
        foreach($room_list as $key => $value)
            $arr_room_id[] = $value['room_id'];


        $str_room_id =   "'".implode("','",$arr_room_id)."'";
        $session_date = array();
        $arr_condition = array();

        foreach($sessionList as $key => $value){
            $session_date[] = $value['start_date'];
            $arr_condition[] = "date_start < '{$value['time_end']}'
            AND date_end > '{$value['time_start']}'";
        }
        $str_session_date =   "'".implode("','",$session_date)."'";
        $str_condition = "(".implode(") OR (", $arr_condition).")";
        $sql_room_in_work = "SELECT DISTINCT
        room_id
        FROM
        meetings
        WHERE
        ($str_condition)
        AND room_id in ($str_room_id)
        AND ju_class_id <> '$classId'
        AND meeting_type = 'Session'
        AND session_status <> 'Cancelled'
        AND deleted = 0";
        $row_room = $GLOBALS['db']->fetchArray($sql_room_in_work);
        $room_in_work = array();
        foreach($row_room as $key => $value){
            $room_in_work[] = $value['room_id'];
        }
        $arr_room_id = array_diff($arr_room_id, $room_in_work);
        $str_room_id  =   "'".implode("','",$arr_room_id)."'";

        $sql_room = "SELECT DISTINCT
        IFNULL(id,'') room_id,
        IFNULL(name,'') room_name,
        IFNULL(capacity,'') capacity,
        IFNULL(description,'') description,
        IFNULL(status,'') status
        FROM c_rooms WHERE id IN ($str_room_id)";
        $rsRoomList = $GLOBALS['db']->query($sql_room);

        while($rowRoom = $GLOBALS['db']->fetchByAssoc($rsRoomList)){
            $roomList[$rowRoom["room_id"]] = array(
                "teacher_id"      => $rowRoom["room_id"],
                "teacher_name"    => $rowRoom["room_name"],
                "contract_id"     => '-none-',
                "contract_type"   => '',
                "require_hours"   => 'Room Size: '.$rowRoom["capacity"],
                "total_hour"      => '',
                "contract_until"  => '',
                "contract_until_span"  => '',
                "day_off"         => '',
                "note"         => $rowRoom["description"],
                "holiday"         => '-none-',
                "priority"        => '2',
            );
        }
        return $roomList;
    }


    /**
     * Get list holiday in date range
     *
     */
    function getPublicHolidays($start_date= '', $end_date = ''){
        global $timedate;
        //Get list Public Holiday
        $ext_end = '';
        if(!empty($end_date))
            $ext_end = "AND holiday_date <= '{$timedate->convertToDBDate($end_date,false)}'";

        $ext_type = "AND apply_for = 'All'";

        $q1 = "SELECT id,
        holiday_date,
        description
        FROM holidays
        WHERE deleted = 0
        AND type = 'Public Holiday'
        $ext_type
        AND holiday_date >= '{$timedate->convertToDBDate($start_date,false)}'
        $ext_end";
        $rs1 = $GLOBALS['db']->query($q1);
        $holiday_list   = array();
        while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
            $holiday_list[$row['holiday_date']] = $row['description'];
        }
        return $holiday_list;
    }

    /**
     * get all teacher of Centers
     *
     * @param array center id $center_id
     *
     * @author Lap Nguyen
     */
    function getTeacherOfCenter($center_id = array()) {
        if (!in_array($center_id)) $center_id = array($center_id) ;
        $teacher = array();
        global $locale;
        $sql = "SELECT t.id, t.first_name, t.last_name
        FROM c_teachers t
        INNER JOIN team_sets_teams tst ON tst.team_set_id = t.team_set_id AND tst.deleted = 0
        INNER JOIN teams ts ON ts.id = tst.team_id AND ts.deleted = 0 AND ts.id IN ('".implode("','",$center_id)."')
        WHERE t.deleted = 0";
        $result = $GLOBALS['db']->query($sql);
        while($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $row['name'] = $locale->getLocaleFormattedName($row['first_name'], $row['last_name'],'');
            $teacher[$row['id']] = $row['name'];
        }
        return $teacher;
    }

    /**
     * get room of center
     *
     * @param mixed $center_id
     *
     * @author Lap Nguyen
     */
    function getRoomOfCenter($center_id = array()) {
        if (!in_array($center_id)) $center_id = array($center_id) ;
        $room = array();
        $sql = "SELECT t.id, t.name
        FROM c_rooms t
        INNER JOIN team_sets_teams tst ON tst.team_set_id = t.team_set_id AND tst.deleted = 0
        INNER JOIN teams ts ON ts.id = tst.team_id AND ts.deleted = 0 AND ts.id IN ('".implode("','",$center_id)."')
        WHERE t.deleted = 0";
        $result = $GLOBALS['db']->query($sql);
        while($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $room[$row['id']] = $row['name'];
        }
        return $room;
    }


    function checkRoomInDateime($id= '', $db_start= '', $db_end= '', $session_id = ""){
        $sql = "SELECT count(id) FROM meetings
        WHERE room_id = '$id'
        AND ((('$db_start' >= date_start) AND ('$db_start' < date_end))
        OR (('$db_end' > date_start) AND ('$db_end' <= date_end))
        OR (('$db_start' < date_start) AND ('$db_end' > date_end)))
        AND deleted=0  AND id <> '$session_id'
        AND session_status <> 'Cancelled'";

        return ($GLOBALS['db']->getOne($sql)?false:true);
    }

    /**
     * function check teacher is working
     *
     * @param mixed $teacher_id
     * @param mixed $start_time
     * @param mixed $end_time
     */
    function checkTeacherWorking($teacher_id= '',$start_time= '', $end_time= '', $return = 'bool') {
        $ext_start = '';
        if(!empty($start_time))
            $ext_start = "AND tc.contract_date <= '$start_time'";

        $ext_end = '';
        if(!empty($end_time))
            $ext_end = "AND tc.contract_until >= '$end_time'";

        $sqlTeacherList = "SELECT tc.id
        FROM
        j_teachercontract tc
        INNER JOIN c_teachers_j_teachercontract_1_c l1_1 ON tc.id = l1_1.c_teachers_j_teachercontract_1j_teachercontract_idb AND l1_1.deleted = 0
        INNER JOIN c_teachers t ON t.id = l1_1.c_teachers_j_teachercontract_1c_teachers_ida AND t.deleted = 0
        WHERE  tc.deleted <> 1 AND tc.status = 'Active'
        $ext_start $ext_end
        AND t.id = '$teacher_id'
        ORDER BY tc.contract_until DESC ";
        $teacher_contract_id = $GLOBALS['db']->getOne($sqlTeacherList);
        if(empty($teacher_contract_id))
            $teacher_contract_id = '';
        if ($return == 'id') return $teacher_contract_id;
        return !empty($teacher_contract_id) ? true : false;
    }

    function checkExistTeacherInClass($class_id= '', $teacher_id= '') {
        $sql = "SELECT count(id)
        FROM meetings
        WHERE ju_class_id = '$class_id' AND teacher_id = '$teacher_id'
        AND deleted = 0 AND session_status <> 'Cancelled' ";
        return $GLOBALS['db']->getOne($sql);
    }

    /**
     * Get array week days from date to date DB Format
     *
     * @param display date $start_date. eg:1/12/2013
     * @param display date $end_date. eg:30/12/2013
     * @param day of week $weekdate. eg:Tue
     * @return array eg: : array = 0: string = "03/12/2013"  1: string = "10/12/2013"
     */
    function get_array_weekdates_db($start_date= '', $end_date= '', $weekdate= ''){
        global $timedate;
        date_default_timezone_set("Asia/Bangkok");
        // $start_date = $start_date.' 00:00:00';
        //  $end_date = $end_date.' 23:59:59';
        $days = array();
        $i = 0;
        $start = strtotime($timedate->convertToDBDate($start_date,false));
        $end = strtotime($timedate->convertToDBDate($end_date,false));
        $end = strtotime('+ 23 hours', $end);
        while($start <= $end){
            if (array_key_exists(date('D', $start), $weekdate)){
                $days[$i]=date('Y-m-d', $start);
                $i++;
            }
            $start = strtotime('+1 day', $start);
        }
        return $days;
    }

?>
