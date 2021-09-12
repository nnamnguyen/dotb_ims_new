<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 
function get_body(&$ss, $vardef){
    $ss->assign('hideReportable', true);
	return $ss->fetch('modules/DynamicFields/templates/Fields/Forms/parent.tpl');
 }
?>
