<?php

/*********************************************************************************

 * Description:
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc. All Rights
 * Reserved. Contributor(s): ______________________________________..
 * *******************************************************************************/
global $current_language;
global $mod_strings;

// grab Adminstration strings too
$admin_mod_strings = return_module_language($current_language, 'Administration');
$mod_strings = dotbArrayMerge($admin_mod_strings, $mod_strings);

include("modules/Administration/Menu.php");
?>
