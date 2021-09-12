<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a rest entry point for rest version 3.1
 */
chdir('../..');
require 'include/entryPoint.php';
require_once 'service/v2_1/DotbWebServiceImplv2_1.php';
$webservice_class = 'DotbRestService';
$webservice_path = 'service/core/DotbRestService.php';
$webservice_impl_class = 'DotbWebServiceImplv2_1';
$registry_class = 'registry_v2_1';
$location = '/service/v2_1/rest.php';
$registry_path = 'service/v2_1/registry.php';
require_once('service/core/webservice.php');
