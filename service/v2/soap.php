<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a soap entry point for soap version 2
 */
chdir('../..');
require 'include/entryPoint.php';
$webservice_class = 'DotbSoapService2';
$webservice_path = 'service/v2/DotbSoapService2.php';
$registry_class = 'registry';
$registry_path = 'service/v2/registry.php';
$webservice_impl_class = 'DotbWebServiceImpl';
$location = '/service/v2/soap.php';
require_once('service/core/webservice.php');




		
