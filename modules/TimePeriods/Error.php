<?php

/*********************************************************************************

 * Description: TODO:  To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
global $app_strings;
global $mod_strings;

?>
<br><br>
<span class='error'><?php if (isset($_REQUEST['error_string'])) echo $mod_strings[$_REQUEST['error_string']]; ?>
<br><br>
<?php echo $app_strings['NTC_CLICK_BACK']; ?>
</span>

