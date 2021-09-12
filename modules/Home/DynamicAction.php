<?php




$myDotb = new MyDotb($_REQUEST['module']);
if (!isset($_REQUEST['DynamicAction'])) {
	$_REQUEST['DynamicAction'] = 'displayDashlet';
}
// commit session before returning output so we can serialize AJAX requests
// and not get session into a wrong state
$res = $myDotb->{$_REQUEST['DynamicAction']}();
if(isset($_REQUEST['commit_session'])) {
    session_commit();
}
echo $res;
