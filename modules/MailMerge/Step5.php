<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

if(!empty($_REQUEST['mtime']))
{
    $request = InputValidation::getService();
    $mTime = $request->getValidInputRequest('mtime', array('Assert\Type' => array('type' => 'numeric')));
	$file = $_SESSION['MAILMERGE_TEMP_FILE_'.$mTime];
	$rtfFile = 'dotbtokendoc'.$mTime.'.doc';
	unlink($file);
	if(file_exists($rtfFile)){
		unlink($rtfFile);
	}
}

header("Location: index.php?module=MailMerge");
