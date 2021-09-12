<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
global $mod_strings;
echo getClassicModuleTitle('InboundEmail', array($mod_strings['LBL_MODULE_TITLE'], $mod_strings['LBL_HOME']), true);

//echo getClassicModuleTitle($mod_strings['LBL_MODULE_TITLE'], array($mod_strings['LBL_MODULE_TITLE'],$mod_strings['LBL_HOME']), true);
require_once('modules/InboundEmail/ListView.php');

?>
