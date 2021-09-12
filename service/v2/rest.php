<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a rest entry point for rest version 2
 */
chdir('../..');
require 'include/entryPoint.php';
$webservice_class = 'DotbRestService';
$webservice_path = 'service/core/DotbRestService.php';
$webservice_impl_class = 'DotbRestServiceImpl';
$registry_class = 'registry';
$location = '/service/v2/rest.php';
$registry_path = 'service/v2/registry.php';
require_once('service/core/webservice.php');
