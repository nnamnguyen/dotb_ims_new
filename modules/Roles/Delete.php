<?php






$focus = BeanFactory::newBean('Roles');

if(!isset($_REQUEST['record']))
	dotb_die("A record number must be specified to delete the role.");

$focus->mark_deleted($_REQUEST['record']);

header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
?>
