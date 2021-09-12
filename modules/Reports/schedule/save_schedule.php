<?php


if(!empty($_REQUEST['save_schedule_msi'])){
	global $current_user, $timedate, $app_strings;
$rs = new ReportSchedule();
global $timedate;
if(!empty($_REQUEST['schedule_id'])){
	$id = $_REQUEST['schedule_id'];
}else{
	$id = '';	
}


if(!empty($_REQUEST['date_start'])){
	$date_start = $timedate->to_db($_REQUEST['date_start'], true);
}else{
	$date_start = '';	
}


if(!empty($_REQUEST['schedule_active']) ){
	$active = 1;
}else{
	$active = 0;	
}

if(!empty($_REQUEST['schedule_type']) ){
	$schedule_type = $_REQUEST['schedule_type'];
}else{
	$schedule_type = "pro";	
}

$rs->save_schedule($id,$current_user->id, $_REQUEST['id'],$date_start,$_REQUEST['schedule_time_interval'], $active, $schedule_type);
$refreshPage = (isset($_REQUEST['refreshPage']) ? $_REQUEST['refreshPage'] : "true");
if (!$active) {
	$date_start = $app_strings['LBL_LINK_NONE'];
} else {	
	if(empty($date_start)){
  		$date_start = gmdate($GLOBALS['timedate']->get_db_date_time_format(), time());
	} else {
  		$date_start = $timedate->handle_offset($date_start, $timedate->get_db_date_time_format(), false);
	}	
	$date_start = $timedate->to_display_date_time($date_start);
} // else

if ($refreshPage == "false") {
	echo "<script>opener.window.setSchuleTime('$date_start');window.close();</script>";	
} else {
	echo '<script>opener.window.location.reload();window.close();</script>';
}
}
?>