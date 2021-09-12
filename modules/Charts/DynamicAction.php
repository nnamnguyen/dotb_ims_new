<?php


if(isset($_GET['DynamicAction']) && $_GET['DynamicAction'] == "saveImage") {
	$filename = pathinfo($_POST['filename'], PATHINFO_BASENAME);
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array(strtolower($ext), array('jpg', 'png', 'jpeg'))) {
	    return false;
	}
	$image = str_replace(" ", "+", $_POST["imageStr"]);
	$data = substr($image, strpos($image, ","));
    if(dotb_mkdir(dotb_cached("images"), 0777, true))
    {
        $filepath = dotb_cached("images/$filename");
        file_put_contents($filepath, base64_decode($data));
        if(!verify_uploaded_image($filepath)) {
            unlink($filepath);
            return false;
        }
    }
    else
    {
        return false;
    }
}
