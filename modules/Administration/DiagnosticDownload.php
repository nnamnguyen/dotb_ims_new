<?php


global $current_user;

use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;


if (!is_admin($current_user)) dotb_die("Unauthorized access to administration.");
if (isset($GLOBALS['dotb_config']['hide_admin_diagnostics']) && $GLOBALS['dotb_config']['hide_admin_diagnostics'])
{
    dotb_die("Unauthorized access to diagnostic tool.");
}

$request = InputValidation::getService();
$timeRequest = $request->getValidInputRequest('time');
$guidRequest = $request->getValidInputRequest('guid', 'Assert\Guid');

if ($guidRequest === null || $timeRequest === null) {
	die('Did not receive a filename to download');
}

ini_set('zlib.output_compression','Off');

$time = str_replace(array('.', '/', '\\'), '', $timeRequest);
$guid = str_replace(array('.', '/', '\\'), '', $guidRequest);
$path = dotb_cached("diagnostic/{$guid}/diagnostic{$time}.zip");
$filesize = filesize($path);
ob_clean();
header('Content-Description: File Transfer');
header('Content-type: application/octet-stream');
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=$guid.zip");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");
readfile($path);

