<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');



global $app_list_strings, $app_strings, $current_language;

$mod_strings = return_module_language('en_us', 'WorkFlow');


//run as admin
global $current_user;
$current_user->getSystemUser();

$process_object = new WorkFlowSchedule();
$process_object->process_scheduled();
unset($process_object);


//dotb_cleanup(); // moved to cron.php
?>
