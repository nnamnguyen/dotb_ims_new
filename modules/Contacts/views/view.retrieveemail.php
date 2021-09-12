<?php


/**
 * ContactsViewRetrieveEmailUsername.php
 * 
 * This class overrides DotbView and provides an implementation for the RetrieveEmailUsername
 * method used for returning the information about an email address
 * 
 * @author Collin Lee
 * */

class ContactsViewRetrieveEmail extends DotbView {
    /**
     * {@inheritDoc}
     *
     * @param array $params Ignored
     */
    public function process($params = array())
    {
		$this->display();
 	}

 	function display(){
	    $data = array();
	    $data['target'] = $this->request->getValidInputRequest('target', 'Assert\ComponentName');
        if(!empty($_REQUEST['email'])) {
			$emailAddr = $this->request->getValidInputRequest('email', 'Assert\Email');
	        $db = DBManagerFactory::getInstance();
	        $email = $GLOBALS['db']->quoted(strtoupper(trim($emailAddr)));
	        $result = $db->query("SELECT * FROM email_addresses WHERE email_address_caps = $email AND deleted = 0");
			if($row = $db->fetchByAssoc($result)) {
		        $data['email'] = $row;
			} else {
				$data['email'] = '';
			}
        }
		$json = new JSON();
		echo $json->encode($data); 
 	}	
}
