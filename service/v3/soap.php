<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a soap entry point for soap version 3
 */
chdir('../..');
require 'include/entryPoint.php';
require_once 'service/v3/DotbWebServiceImplv3.php';
$webservice_class = 'DotbSoapService2';
$webservice_path = 'service/v2/DotbSoapService2.php';
$registry_class = 'registry_v3';
$registry_path = 'service/v3/registry.php';
$webservice_impl_class = 'DotbWebServiceImplv3';
$location = '/service/v3/soap.php';
require_once 'service/core/webservice.php';
