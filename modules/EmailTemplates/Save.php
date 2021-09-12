<?php

/*********************************************************************************
 * Description:  Saves an Account record and then redirects the browser to the
 * defined return URL.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$focus = BeanFactory::newBean('EmailTemplates');
require_once('include/formbase.php');
$focus = populateFromPost('', $focus);

$form = new EmailTemplateFormBase();
dotb_cache_clear('select_array:'.$focus->object_name.'namebase_module=\''.$focus->base_module.'\'name');
if(isset($_REQUEST['inpopupwindow']) and $_REQUEST['inpopupwindow'] == true) {
	$focus=$form->handleSave('',false, false); //do not redirect.
	$body1 = "
		<script type='text/javascript'>
			function refreshTemplates() {
				window.opener.refresh_email_template_list('$focus->id','$focus->name')
				window.close();
			}

			refreshTemplates();
		</script>";
	echo  $body1;
} else {
	$form->handleSave('',true, false);
}
?>