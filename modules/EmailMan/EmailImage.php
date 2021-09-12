<?php


if(empty($_REQUEST['id']) || !preg_match("/^[\w\d\-]+$/", $_REQUEST['id'])) {
	die("Not a Valid Entry Point");
}
global $mod_strings;
$note = BeanFactory::newBean('Notes');
//check if file is an email image
if (!$note->retrieve_by_string_fields(array('id' => $_REQUEST['id'], 'email_type' => "Emails"))) {
	die($mod_strings['LBL_INVALID_ENTRY_POINT']);
}

$location = $GLOBALS['dotb_config']['upload_dir']."/" . $_REQUEST['id'];

$mime = getimagesize($location);

if(!empty($mime)) {
	header("Content-Type: {$mime['mime']}");
} else {
	header("Content-Type: image/png");
}


readfile($location);


