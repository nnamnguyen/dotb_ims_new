<?php

 //Request object must have these property values:
 //		Module: module name, this module should have a file called TreeData.php
 //		Function: name of the function to be called in TreeData.php, the function will be called statically.
 //		PARAM prefixed properties: array of these property/values will be passed to the function as parameter.

require_once('include/JSON.php');
require_once('include/upload_file.php');

$json = getJSONobj();
$file_name = $json->decode(html_entity_decode($_REQUEST['file_name']));
 if(isset($file_name['jsonObject']) && $file_name['jsonObject'] != null){
	$file_name = $file_name['jsonObject'];
  }

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
