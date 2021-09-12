<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

 /**
 * Used to call a generic method in a dashlet
 */
// Only define entry point type if it isnt already defined
if (!defined('ENTRY_POINT_TYPE')) {
    define('ENTRY_POINT_TYPE', 'gui');
}
 require_once('include/entryPoint.php');
if(!is_admin($GLOBALS['current_user'])){
	dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);
}
    $requestedMethod = $_REQUEST['method'];
    $pmc = new PackageController();

    if(method_exists($pmc, $requestedMethod)) {
        echo $pmc->$requestedMethod();
    }
    else {
        echo 'no method';
    }
   // dotb_cleanup();
?>
