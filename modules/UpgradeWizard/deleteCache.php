<?php

 //Request object must have these property values:
 //		Module: module name, this module should have a file called TreeData.php
 //		Function: name of the function to be called in TreeData.php, the function will be called statically.
 //		PARAM prefixed properties: array of these property/values will be passed to the function as parameter.

require_once('include/JSON.php');

$json = getJSONobj();

//Clean modules from cache
$cachedir = dotb_cached("modules");
if(is_dir($cachedir)){
	$allModFiles = array();
	$allModFiles = findAllFiles($cachedir,$allModFiles);
   foreach($allModFiles as $file){
       	if(file_exists($file)){
			unlink($file);
       	}
   }
}
//Clean jsLanguage from cache
$cachedir = dotb_cached("jsLanguage");
if(is_dir($cachedir)){
	$allModFiles = array();
	$allModFiles = findAllFiles($cachedir,$allModFiles);
   foreach($allModFiles as $file){
	   	if(file_exists($file)){
			unlink($file);
	   	}
	}
}
//Clean smarty from cache
$cachedir = dotb_cached("smarty");
if(is_dir($cachedir)){
	$allModFiles = array();
	$allModFiles = findAllFiles($cachedir,$allModFiles);
   foreach($allModFiles as $file){
       	if(file_exists($file)){
			unlink($file);
       	}
   }
}

dotb_cleanup();
exit();
