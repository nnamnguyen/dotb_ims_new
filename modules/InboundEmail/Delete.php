<?php

global $mod_strings;
if(empty($_REQUEST['record'])) {
	dotb_die($mod_strings['LBL_DELETE_ERROR']);
} else {
	
	$focus = BeanFactory::newBean('InboundEmail');

	// retrieve the focus in order to populate it with ID. otherwise this
	// instance will be marked as deleted and than replaced by another instance,
	// which will be saved and tracked (bug #47552)
	$focus->retrieve($_REQUEST['record']);
	$focus->mark_deleted($_REQUEST['record']);
	header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
}

?>
