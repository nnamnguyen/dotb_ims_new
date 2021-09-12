<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


/**
 * This file intialize the service class and does all the setters based on the values provided in soap/rest entry point
 * and calls serve method which takes the request and send response back to the client
 */
ob_start();
chdir(dirname(__FILE__).'/../../');
define('ENTRY_POINT_TYPE', 'api');
require 'soap/SoapErrorDefinitions.php';
require_once 'service/core/SoapHelperWebService.php';
require_once($webservice_path);
require_once($registry_path);
if(isset($webservice_impl_class_path))
    require_once($webservice_impl_class_path);
$url = $GLOBALS['dotb_config']['site_url'].$location;
$service = new $webservice_class($url);
$service->registerClass($registry_class);
$service->register();
$service->registerImplClass($webservice_impl_class);

DotbMetric_Manager::getInstance()->setTransactionName('soap_' . (isset($_REQUEST['method'])? $_REQUEST['method'] : ""));

// set the service object in the global scope so that any error, if happens, can be set on this object
global $service_object;
$service_object = $service;

$service->serve();
