<?php
if(!defined('dotbEntry'))define('dotbEntry', true);



ob_start();
define('ENTRY_POINT_TYPE', 'gui');
require_once('include/entryPoint.php');
require("modules/iCals/Server.php");
