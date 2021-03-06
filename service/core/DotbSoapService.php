<?php
 if(!defined('dotbEntry'))define('dotbEntry', true);


require_once('service/core/DotbWebService.php');
require_once('service/core/DotbWebServiceImpl.php');

/**
 * This ia an abstract class for the soapservice. All the global fun
 *
 */
abstract class DotbSoapService extends DotbWebService{
	protected $soap_version = '1.1';
	protected $namespace = 'http://www.dotbcrm.com/dotbcrm';
	protected $implementationClass = 'DotbWebServiceImpl';
	protected $registryClass = "";
	protected $soapURL = "";
	
  	/**
  	 * This is an abstract method. The implementation method should registers all the functions you want to expose as services.
  	 *
  	 * @param String $function - name of the function
  	 * @param Array $input - assoc array of input values: key = param name, value = param type
  	 * @param Array $output - assoc array of output values: key = param name, value = param type
	 * @access public
  	 */
	abstract function registerFunction($function, $input, $output);
	
	/**
	 * This is an abstract method. This implementation method should register all the complex type	 
	 * 
	 * @param String $name - name of complex type
	 * @param String $typeClass - (complexType|simpleType|attribute)
	 * @param String $phpType - array or struct
	 * @param String $compositor - (all|sequence|choice)
	 * @param String $restrictionBase - SOAP-ENC:Array or empty
	 * @param Array $elements - array ( name => array(name=>'',type=>'') )
	 * @param Array $attrs - array(array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'xsd:string[]'))
	 * @param String $arrayType - arrayType: namespace:name (xsd:string)
	 * @access public
	 */	
	abstract function registerType($name, $typeClass, $phpType, $compositor, $restrictionBase, $elements, $attrs=array(), $arrayType='');
	
	/**
	 * Constructor
	 *
	 */
	protected function __construct(){
		$this->setObservers();
	}
	
	/**
	 * This method sets the soap server object on all the observers
	 * @access public
	 */
	public function setObservers() {
		global $observers;
		if(!empty($observers)){
			foreach($observers as $observer) {
	   			if(method_exists($observer, 'set_soap_server')) {
	   	 			 $observer->set_soap_server($this->server);
	   			}
			}
		}
	} // fn
	
	/**
	 * This method returns the soapURL
	 *
	 * @return String - soapURL
	 * @access public
	 */
	public function getSoapURL(){
		return $this->soapURL;
	}
		
	public function getSoapVersion(){
		return $this->soap_version;
	}
	
	/**
	 * This method returns the namespace
	 *
	 * @return String - namespace
	 * @access public
	 */
	public function getNameSpace(){
		return $this->namespace;
	}
	
	/**
	 * This mehtod returns registered implementation class
	 *
	 * @return String - implementationClass
	 * @access public
	 */
	public function getRegisteredImplClass() {
		return $this->implementationClass;	
	}

	/**
	 * This mehtod returns registry class
	 *
	 * @return String - registryClass
	 * @access public
	 */
	public function getRegisteredClass() {
		return $this->registryClass;	
	}
	
	/**
	 * This mehtod returns server
	 *
	 * @return String -server
	 * @access public
	 */
	public function getServer() {
		return $this->server;	
	} // fn
	
	
} // class
