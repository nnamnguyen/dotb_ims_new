<?php

/*********************************************************************************

 * Description: TODO:  To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
global $app_strings;
?>
<br><br>
<span class='error'>
<?php
if (isset($_REQUEST['error_string'])) {
    echo htmlspecialchars($_REQUEST['error_string'], ENT_QUOTES, 'UTF-8');
}
?>
<br><br>
<?php echo $app_strings['NTC_CLICK_BACK']; ?>
</span>

