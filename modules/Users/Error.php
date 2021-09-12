<?php

/*********************************************************************************

 * Description: TODO:  To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
global $app_strings;
echo "<br><br>";

if(isset($_REQUEST['ie_error']) && $_REQUEST['ie_error'] == 'true') {
	echo '<a href="index.php?module=Users&action=EditView&record='.htmlspecialchars($_REQUEST['id'], ENT_QUOTES, 'UTF-8').'">'.$mod_strings['ERR_IE_FAILURE1'].'</a><br>';
	echo $mod_strings['ERR_IE_FAILURE2'];
} else {
?>
<span class='error'><?php if (isset($_REQUEST['error_string'])) echo htmlspecialchars($_REQUEST['error_string'], ENT_QUOTES, 'UTF-8'); ?>
<br><br>
<?php echo $app_strings['NTC_CLICK_BACK']; }?>
</span>
