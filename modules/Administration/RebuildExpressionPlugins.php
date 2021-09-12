<?php

global $current_user;

if(is_admin($current_user)){
    $GLOBALS['updateSilent'] = false;
	require_once("include/Expressions/updatecache.php");
}
