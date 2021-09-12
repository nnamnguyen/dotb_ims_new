<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a rest entry point for rest version 3.1
 */
chdir('../..');
require 'include/entryPoint.php';
require_once('DotbWebServiceImplv3_1.php');
$webservice_class = 'DotbRestService';
$webservice_path = 'service/core/DotbRestService.php';
$webservice_impl_class = 'DotbWebServiceImplv3_1';
$registry_class = 'registry';
$location = '/service/v3_1/rest.php';
$registry_path = 'service/v3_1/registry.php';
require_once('service/core/webservice.php');
