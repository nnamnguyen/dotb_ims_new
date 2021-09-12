<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);

define('ENTRY_POINT_TYPE', 'api');
require_once('include/entryPoint.php');
include_once('modules/EmailMan/EmailManDelivery.php');
dotb_cleanup(true);