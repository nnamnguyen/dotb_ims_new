<?php
if(!defined('dotbEntry'))define('dotbEntry', true);


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

require_once('service/core/REST/DotbRestSerialize.php');

/**
 * This class is a JSON implementation of REST protocol
 * @api
 */
class DotbRestJSON extends DotbRestSerialize{

    /**
     * A callback function name provided by a jQuery JSONP request
     * @var string
     */
    protected $callback ='';

    /**
     * @inheritdoc
     */
    public function __construct($implementation)
    {
        parent::__construct($implementation);

        $this->callback = InputValidation::getService()->getValidInputGet('jsoncallback');

        if (!\DotbConfig::getInstance()->get('jsonp_web_service_enabled', false)) {
            $this->callback = '';
        }
    }

	/**
	 * It will json encode the input object and echo's it
	 *
	 * @param array $input - assoc array of input values: key = param name, value = param type
	 * @return String - echos json encoded string of $input
	 */
    function generateResponse($input) {
        if (isset($this->faultObject)) {
            $this->generateFaultResponse($this->faultObject);
        } else {
            $this->printResponse($input);
        }
	} // fn

	/**
	 * This method calls functions on the implementation class and returns the output or Fault object in case of error to client
	 *
	 * @return unknown
	 */
	function serve(){
		$GLOBALS['log']->info('Begin: DotbRestJSON->serve');
		$json_data = !empty($_REQUEST['rest_data'])? $GLOBALS['RAW_REQUEST']['rest_data']: '';
		if(empty($_REQUEST['method']) || !method_exists($this->implementation, $_REQUEST['method'])){
			$er = new SoapError();
			$er->set_error('invalid_call');
			$this->fault($er);
		}else{
			$json = getJSONObj();
			$data = $json->decode($json_data);
			if(!is_array($data))$data = array($data);
            $res = $this->invoke($_REQUEST['method'], $data);
            $GLOBALS['log']->info('End: DotbRestJSON->serve');
			return $res;
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
        $this->printResponse($errorObject);
	} // fn

    /**
     * Encode and print response object. With or without JSONP callback function
     */
    protected function printResponse($response)
    {
        $json = getJSONObj();
        ob_clean();

        if (!empty($this->callback)) {
            echo $this->callback . '(';
        }

        echo $json->encode($response);

        if (!empty($this->callback)) {
            echo ')';
        }
    }
} // class
