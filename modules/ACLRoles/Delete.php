<?php


$role = BeanFactory::newBean('ACLRoles');
if(isset($_REQUEST['record'])){
	$role->mark_deleted($_REQUEST['record']);
}
require_once('include/formbase.php');
handleRedirect();

?>