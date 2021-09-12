<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a soap entry point for soap version 3.1
 */
chdir('../..');
require 'include/entryPoint.php';
require_once('DotbWebServiceImplv3_1.php');
$webservice_class = 'DotbSoapService2';
$webservice_path = 'service/v2/DotbSoapService2.php';
$registry_class = 'registry_v3_1';
$registry_path = 'service/v3_1/registry.php';
$webservice_impl_class = 'DotbWebServiceImplv3_1';
$location = '/service/v3_1/soap.php';
require_once 'service/core/webservice.php';
