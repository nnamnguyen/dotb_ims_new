<?php

/**
* Convert vietnamese name to no marks
*/
function viToEn($str)
{
    $str = html_entity_decode_utf8($str);
    //Convert Unicode Dung San
    $str = preg_replace('/(à|á|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ)/', 'a', $str);
    $str = preg_replace('/(Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ)/', 'A', $str);

    $str = preg_replace("/(é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ)/", 'e', $str);
    $str = preg_replace("/(É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ)/", 'E', $str);

    $str = preg_replace("/(í|ì|ỉ|ị|ĩ)/", 'i', $str);
    $str = preg_replace("/(Í|Ì|Ỉ|Ĩ|Ị)/", 'i', $str);

    $str = preg_replace("/(ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ)/", 'o', $str);
    $str = preg_replace("/(Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ)/", 'O', $str);

    $str = preg_replace("/(ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự)/", 'u', $str);
    $str = preg_replace("/(Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự)/", 'U', $str);

    $str = preg_replace("/(ý|ỳ|ỷ|ỹ|ỵ)/", 'y', $str);
    $str = preg_replace("/(Ý|Ỳ|Ỷ|Ỹ|Ỵ)/", 'Y', $str);

    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);


    //Convert Unicode To Hop
    $str = preg_replace('/(à|á|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ)/', 'a', $str);
    $str = preg_replace('/(Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ)/', 'A', $str);

    $str = preg_replace("/(é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ)/", 'e', $str);
    $str = preg_replace("/(É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ)/", 'E', $str);

    $str = preg_replace("/(í|ì|ỉ|ị|ĩ)/", 'i', $str);
    $str = preg_replace("/(Í|Ì|Ỉ|Ĩ|Ị)/", 'i', $str);

    $str = preg_replace("/(ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ)/", 'o', $str);
    $str = preg_replace("/(Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ)/", 'O', $str);

    $str = preg_replace("/(ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự)/", 'u', $str);
    $str = preg_replace("/(Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự)/", 'U', $str);

    $str = preg_replace("/(ý|ỳ|ỷ|ỹ|ỵ)/", 'y', $str);
    $str = preg_replace("/(Ý|Ỳ|Ỷ|Ỹ|Ỵ)/", 'Y', $str);

    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/(`)/", '', $str);
    return $str;
}

function getParentTeamName($team_id)
{
    return $GLOBALS['db']->getOne("SELECT l1.name
        FROM teams
        LEFT JOIN teams l1 ON l1.id = teams.parent_id AND l1.deleted <> 1
        WHERE teams.id = '$team_id' AND teams.deleted = 0");
}

/**
* Generate an array of string dates between 2 dates
*
* @param string $start Start date
* @param string $end End date
* @param string $format Output format (Default: Y-m-d)
*
* @return array
*/
function getDatesFromRange($start, $end, $format = 'Y-m-d')
{
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach ($period as $date) {
        $array[] = $date->format($format);
    }

    return $array;
}

function get_string_between($string, $start = "'", $end = "'")
{
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $end_pos = strpos($string, $end, $ini);
    $len = $end_pos - $ini;
    $resStr = substr($string, $ini, $len);

    if (!empty($resStr)) return $resStr;
    else {
        $string = substr($string, $end_pos + strlen($end));

        $ini = strpos($string, $start);
        $ini += strlen($start);
        $end_pos = strpos($string, $end, $ini);
        $len = $end_pos - $ini;
        $resStr = substr($string, $ini, $len);
        return $resStr;
    }
}

function checkDataLockDate($input_date, $type = 'month_lock', $lock_back = '')
{
    global $timedate, $dotb_config;

    //except lock user admin
    if ($GLOBALS['current_user']->isAdmin()) return true;

    //except lock list
    if (!empty($dotb_config['lock_info']['except_lock_for_user_name'])) {
        $exceptList = explode(",", $dotb_config['lock_info']['except_lock_for_user_name']);
        if (in_array($current_user->user_name, $exceptList)) return true;
    }

    if ($dotb_config['lock_info']['enable']) {
        switch ($type) {
            case 'back_lock':
                if (empty($lock_back)) $lock_back = $dotb_config['lock_info']['lock_back'];
                if (empty($lock_back)) $lock_back = '0 days';
                $lock_back = '-' . $lock_back;

                $input_date_db = $timedate->convertToDBDate($input_date);
                $check_date_time = strtotime($input_date_db . ' 23:59:59');
                $now_date = strtotime("+7hour $lock_back" . $timedate->nowDb());
                return ($now_date > $check_date_time) ? false : true;
                break;
            case 'month_lock':
                $splited = explode('-', $dotb_config['lock_info']['lock_date']);
                $input_date_db = $timedate->convertToDBDate($input_date);
                $check_date_time = strtotime('first day of next month ' . $input_date_db) + ((intval($splited[0]) - 1) * 86400) + ((intval($splited[1])) * 3600);
                $now_date = strtotime('+7hour ' . $timedate->nowDb());
                return ($now_date > $check_date_time) ? false : true;
                break;
            default:
                return false;
        }
    } else return true;

}


function getCenterList()
{
    global $current_user;
    $qr = "";
    if (!$current_user->isAdmin()) {
        $sql_get_my_team = "SELECT DISTINCT
        rel.team_id
        FROM
        team_memberships rel
        RIGHT JOIN teams ON (rel.team_id = teams.id)
        WHERE rel.user_id = '" . $current_user->id . "' AND teams.private = 0
        AND rel.deleted = 0 AND teams.deleted = 0";
        $result = $GLOBALS['db']->query($sql_get_my_team);

        $teamIds = array();
        while ($row = $GLOBALS['db']->fetchByAssoc($result))
            $teamIds[] = $row['team_id'];

        $qr = " AND t1.id IN ('" . implode("','", $teamIds) . "') ";
    }


    $sql_get_team = "SELECT DISTINCT IFNULL(t1.id, '') id, IFNULL(t1.name, '') name, IFNULL(t1.code_prefix, '') center_code
    FROM teams t1
    INNER JOIN teams t2 ON t1.parent_id = t2.id AND t2.deleted = 0
    $qr AND t1.deleted = 0 AND t1.id NOT IN (SELECT DISTINCT tt.parent_id FROM teams tt WHERE tt.private = 0 AND tt.deleted = 0 AND (tt.parent_id <> '' AND tt.parent_id IS NOT NULL))
    ORDER BY t1.name";
    $result = $GLOBALS['db']->query($sql_get_team);
    $teams = array();
    while ($row = $GLOBALS['db']->fetchByAssoc($result))
        $teams[] = $row['id'];
    return $teams;
}

/*
*function split name field Họ Tên Bé  lưu trong Dotb là Firstname và Lastname.
*/
function split_fullname($fullname, $t = 1)
{

    $parts = explode(" ", $fullname);
    $lastname = array_pop($parts);
    $firstname = implode(" ", $parts);
    if ($t == 1)
        return $firstname;
    else
        return $lastname;

}

function getlastAtivities($bean)
{
    $st_id = $bean->id;
    $activities = '';
    $limit = 200;

    //Call, Task, meeting
    $call_query = "SELECT * FROM ((SELECT
    name, description, assigned_user_id, date_modified, 'call' type
    FROM calls
    WHERE parent_id = '$st_id' AND deleted = 0
    ORDER BY date_modified DESC
    LIMIT 3)
    UNION (SELECT
    name, description, assigned_user_id, date_modified, 'task' type
    FROM tasks
    WHERE parent_id = '$st_id' AND deleted = 0
    ORDER BY date_modified DESC
    LIMIT 3)
    UNION (SELECT
    name, description, assigned_user_id, date_modified, 'meeting' type
    FROM meetings
    WHERE parent_id = '$st_id' AND deleted = 0 AND meeting_type = 'Meeting'
    ORDER BY date_modified DESC
    LIMIT 3))
    ORDER BY date_modified DESC
    LIMIT 3";
    $rows = $GLOBALS['db']->fetchArray($call_query);
    $activities = '<div class="ellipsis_inline">';
    foreach ($rows as $row) {
        $activities .= "<a href='#' class='nav-link'><i class='icon-stack2'></i><span></span></a>";
    }
    $activities .= '</div>';
    if (strlen(trim($bean->description)) > $limit)
        $activities .= mb_substr($bean->description, 0, $limit, 'UTF-8') . ' ...';
    return $description;
}


function parseAppListString($language, array $appStrings)
{
    global $app_list_strings;
    $app_list_strings = return_app_list_strings_language($language);
    $return_value = array();
    foreach ($appStrings as $appString) {
        $array = array();
        $array['name'] = $appString;
        $list = array();

        foreach ($app_list_strings[$appString] as $key => $value) {
            $list_array = array();
            $list_array['key'] = $key;
            $list_array['value'] = $value;
            array_push($list, $list_array);
        }
        $array['list'] = $list;
        array_push($return_value, $array);
    }
    return $return_value;
}

function formatPhoneNumber($phone){
    $phone = preg_replace("/[^0-9]/", "",$phone);
    if(substr($phone,0 , 2) == '84') $phone = substr_replace($phone,'0',0,2);
    if(substr($phone,0 , 2) == '00') $phone = substr_replace($phone,'0',0,2);
    if(substr($phone,0 , 2) == '000') $phone = substr_replace($phone,'0',0,3);
    if(substr($phone,0 , 2) == '0000') $phone = substr_replace($phone,'0',0,4);
    return $phone;
}

if (!function_exists('split_fullname')) {
    function split_fullname($fullname, $t = 1)
    {
        $parts = explode(" ", $fullname);
        $lastname = array_pop($parts);
        $firstname = implode(" ", $parts);
        if ($t == 1)
            return $firstname;
        else
            return $lastname;

    }
}

?>
