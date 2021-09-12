<?php
if(!defined('dotbEntry'))define('dotbEntry', true);


ob_start();
chdir(dirname(__FILE__).'/../');
define('ENTRY_POINT_TYPE', 'api');
require('include/entryPoint.php');
DotbAutoLoader::load('custom/include/RestService.php');
$restServiceClass = DotbAutoLoader::customClass('RestService');

global $service;
$service = new $restServiceClass();
$service->execute();

