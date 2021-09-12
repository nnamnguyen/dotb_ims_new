
<?php

require("include/modules.php");
foreach ($beanFiles as $Classname => $filename){ 
    // Find the name of the file generated by the updateclass script
	$pos=strrpos($filename,"/");
	$Newfilename=substr_replace($filename, 'DotbCore.', $pos+1, 0);
    //delete the new DotbBean that extends CoreBean and replace it by the old one undoing all the changes
	if (file_exists($Newfilename)){
		unlink($filename);
		$handle = file_get_contents($Newfilename);
		$data = preg_replace("/class DotbCore".$Classname."/", 'class '.$Classname, $handle);
		$data1 = preg_replace("/function DotbCore".$Classname."/", 'function '.$Classname, $data);
		file_put_contents($Newfilename,$data1);
		rename($Newfilename,$filename);
	}
}
?>
