<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

if (!is_admin($GLOBALS['current_user'])) {
    dotb_die("Unauthorized access to administration.");
}
if (isset($GLOBALS['dotb_config']['hide_admin_diagnostics']) && $GLOBALS['dotb_config']['hide_admin_diagnostics'])
{
    dotb_die("Unauthorized access to diagnostic tool.");
}

echo getClassicModuleTitle(
        "Administration",
        array(
            "<a href='index.php?module=Administration&action=index'>{$mod_strings['LBL_MODULE_NAME']}</a>",
           translate('LBL_DIAGNOSTIC_TITLE')
           ),
        true
        );

$request = InputValidation::getService();
$file = $request->getValidInputRequest('file');
$guid = $request->getValidInputRequest('guid', 'Assert\Guid');

if(empty($file) || empty($guid))
{
	echo $mod_strings['LBL_DIAGNOSTIC_DELETE_ERROR'];
}
else
{
    // Make sure the guid and file are valid file names for security purposes
    clean_string($guid, "ALPHANUM");
    clean_string($file, "FILE");

	//Making sure someone doesn't pass a variable name as a false reference
	//  to delete a file
	if(strcmp(substr($file, 0, 10), "diagnostic") != 0)
	{
		die($mod_strings['LBL_DIAGNOSTIC_DELETE_DIE']);
	}

	if(file_exists($cachedfile = dotb_cached("diagnostic/". $guid . "/" . $file . ".zip")))
	{
  	  unlink($cachedfile);
  	  rmdir(dirname($cachedfile));
	  echo $mod_strings['LBL_DIAGNOSTIC_DELETED']."<br><br>";
	}
	else
	  echo $mod_strings['LBL_DIAGNOSTIC_FILE'] . $file . $mod_strings['LBL_DIAGNOSTIC_ZIP'];
}

print "<a href=\"index.php?module=Administration&action=index\">" . $mod_strings['LBL_DIAGNOSTIC_DELETE_RETURN'] . "</a><br>";

?>
