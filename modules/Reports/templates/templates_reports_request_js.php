<?php

//////////////////////////////////////////////
// TEMPLATE:
//
//////////////////////////////////////////////
global $report_modules;
function template_reports_request_vars_js(&$smarty, &$reporter,&$args) {
	$field_defs = $reporter->focus->field_defs;

	$table_columns = array();
	$hidden_columns = array();


	if (!isset($reporter->report_def['report_type'])) {
		$report_type = 'tabular';
	} else {
		$report_type = $reporter->report_def['report_type'];
	} // else
	$allowed_modules_arr = array();
	global $report_modules;
	foreach($report_modules as $module=>$name) {
		array_push($allowed_modules_arr ,"\"$module\":1");
	} // foreach
	$allowed_modules_js = implode(",",$allowed_modules_arr);
	$smarty->assign('allowed_modules_js', "{".$allowed_modules_js."}");
	$smarty->assign('reporter_report_def_str1', $reporter->report_def_str);
	if (isset($reporter->report_def['goto_anchor'])) {
		$goto_anchor = $reporter->report_def['goto_anchor'];
	} else {
		$goto_anchor = "\"\"";
	} // else
	$smarty->assign('goto_anchor', $goto_anchor);
	$user_array = get_user_array(FALSE);
	$smarty->assign('user_array', $user_array);
} // fn
