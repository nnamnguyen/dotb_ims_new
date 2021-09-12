<?php
if(!defined('dotbEntry'))define('dotbEntry', true);


require_once('service/core/REST/DotbRest.php');

use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

/**
 * This class is a serialize implementation of REST protocol
 * @api
 */
class DotbRestSerialize extends DotbRest{

	/**
	 * It will serialize the input object and echo's it
	 *
	 * @param array $input - assoc array of input values: key = param name, value = param type
	 * @return String - echos serialize string of $input
	 */
	function generateResponse($input){
		ob_clean();
		if (isset($this->faultObject)) {
			$this->generateFaultResponse($this->faultObject);
		} else {
			echo serialize($input);
		}
	} // fn

	/**
	 * This method calls functions on the implementation class and returns the output or Fault object in case of error to client
	 *
	 * @return unknown
	 */
	function serve(){
		$GLOBALS['log']->info('Begin: DotbRestSerialize->serve');
		if(empty($_REQUEST['method']) || !method_exists($this->implementation, $_REQUEST['method'])){
			$er = new SoapError();
			$er->set_error('invalid_call');
			$this->fault($er);
		}else{
			$data = InputValidation::getService()->getValidInputRequest(
                'rest_data',
                array('Assert\PhpSerialized' => array('htmlEncoded' => true)),
                ''
            );
			if(!is_array($data))$data = array($data);
			$GLOBALS['log']->info('End: DotbRestSerialize->serve');
            return $this->invoke($_REQUEST['method'], $data);
		} // else
	} // fn

	/**
	 * This function sends response to client containing error object
	 *
	 * @param SoapError $errorObject - This is an object of type SoapError
	 * @access public
	 */
	function fault($errorObject){
		$this->faultServer->faultObject = $errorObject;
	} // fn

	function generateFaultResponse($errorObject){
		$error = $errorObject->number . ': ' . $errorObject->name . '<br>' . $errorObject->description;
		$GLOBALS['log']->error($error);
		ob_clean();
		echo serialize($errorObject);
	} // fn

} // clazz
