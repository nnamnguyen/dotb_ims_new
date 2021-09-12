<?php

$local_location = $_SESSION['mail_merge_file_location'];
$name = $_SESSION['mail_merge_file_name'];
$download_location= $_SESSION['mail_merge_file_location'];

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-type: application/force-download");
header("Content-Length: " . filesize($local_location));
		header("Content-disposition: attachment; filename=\"".$name."\";");

		header("Expires: 0");
		set_time_limit(0);

		@ob_end_clean();
		ob_start();


	        echo file_get_contents($download_location);

		@ob_flush();
?>
