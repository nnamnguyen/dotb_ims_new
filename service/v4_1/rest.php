<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a rest entry point for rest version 4
 */
chdir('../..');
require 'include/entryPoint.php';
require_once('DotbWebServiceImplv4_1.php');
$webservice_class = 'DotbRestService';
$webservice_path = 'service/core/DotbRestService.php';
$webservice_impl_class = 'DotbWebServiceImplv4_1';
$registry_class = 'registry';
$location = '/service/v4_1/rest.php';
$registry_path = 'service/v4_1/registry.php';
require_once('service/core/webservice.php');
