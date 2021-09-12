<?php


require("include/modules.php");
require_once("include/utils/dotb_file_utils.php");

foreach ($beanFiles as $classname => $filename){
	if (file_exists($filename)){
		// Rename the class and its constructor adding DotbCore at the beginning  (Ex: class DotbCoreCall)
		$handle = file_get_contents($filename);
        $patterns = array ('/class '.$classname.'/','/function '.$classname.'/');
        $replace = array ('class DotbCore'.$classname,'function DotbCore'.$classname);
		$data = preg_replace($patterns,$replace, $handle);
		dotb_file_put_contents($filename,$data);

		// Rename the DotbBean file into DotbCore.DotbBean (Ex: DotbCore.Call.php)
		$pos=strrpos($filename,"/");
		$newfilename=substr_replace($filename, 'DotbCore.', $pos+1, 0);
		dotb_rename($filename,$newfilename);

		//Create a new DotbBean that extends CoreBean
		$fileHandle = dotb_fopen($filename, 'w') ;
$newclass = <<<FABRICE
<?php

if(!class_exists('$classname')){
    if (file_exists('custom/$filename')) {
	    require('custom/$filename');
	} else {
	    require('$newfilename');
	    class $classname extends DotbCore$classname{}
	}
}
?>
FABRICE;
		fwrite($fileHandle, $newclass);
		fclose($fileHandle);
	}
}
?>
