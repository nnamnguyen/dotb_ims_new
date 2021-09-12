<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

 //Request object must have these property values:
 //		Module: module name, this module should have a file called TreeData.php
 //		Function: name of the function to be called in TreeData.php, the function will be called statically.
 //		PARAM prefixed properties: array of these property/values will be passed to the function as parameter.


$json = getJSONobj();

$file_name = $_REQUEST['file_name'];
$filesize = '';
if(file_exists($file_name)){
    $filesize =filesize($file_name);
}

$response = '';

if($filesize != null){
	if(($filesize > return_bytes(ini_get("upload_max_filesize"))) || ($filesize > return_bytes(ini_get("post_max_size")))){
		$response=$filesize;
	}
}

if (!empty($response)) {
    echo $response;
}
dotb_cleanup();
exit();
