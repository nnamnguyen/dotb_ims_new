<?php

/*********************************************************************************

 * Description:
 ********************************************************************************/

global $mod_strings;

$focus = BeanFactory::newBean('WorkFlowTriggerShells');

if (empty($_REQUEST['record']))
{
    dotb_die($mod_strings['ERR_DELETE_RECORD']);
}

$focus = BeanFactory::retrieveBean('WorkFlowTriggerShells', $_REQUEST['record']);
if (empty($focus)) {
    dotb_die($mod_strings['ERR_DELETE_EMPTY']);
}
$focus->mark_deleted($_REQUEST['record']);

header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
