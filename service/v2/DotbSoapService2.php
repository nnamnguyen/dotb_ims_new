<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This is a service class for version 2
 */
require_once('service/core/NusoapSoap.php');
class DotbSoapService2 extends NusoapSoap{
		
	/**
	 * This method registers all the functions which you want to be available for SOAP.
	 *
	 * @param array $excludeFunctions - All the functions you don't want to register
	 */
	public function register($excludeFunctions = array()){
		$GLOBALS['log']->info('Begin: DotbSoapService2->register');
		$this->excludeFunctions = $excludeFunctions;
		$registryObject = new $this->registryClass($this);
		$registryObject->register();
		$this->excludeFunctions = array();
		$GLOBALS['log']->info('End: DotbSoapService2->register');
	} // fn
			
} // clazz
?>
