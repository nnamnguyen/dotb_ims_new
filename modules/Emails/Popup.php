<?php


if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'show_raw') {
	if(!class_exists("Email")) {

	}
	$email = BeanFactory::getBean('Emails', $_REQUEST['metadata']);
	echo nl2br(DotbCleaner::cleanHtml($email->raw_source));
} else {
	require_once('include/Popups/Popup_picker.php');
	$popup = new Popup_Picker();
	echo $popup->process_page();
}

?>
