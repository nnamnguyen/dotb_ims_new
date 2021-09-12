<?php


class ContactsController extends DotbController
{
	function action_Popup(){
		if(!empty($_REQUEST['html']) && $_REQUEST['html'] == 'mail_merge'){
			$this->view = 'mailmergepopup';
		}else{
			$this->view = 'popup';
		}
	}
	
    function action_ValidPortalUsername()
    {
		$this->view = 'validportalusername';
    }

    function action_RetrieveEmail()
    {
        $this->view = 'retrieveemail';	
    }

    function action_ContactAddressPopup()
    {
		$this->view = 'contactaddresspopup';
    }
  
    function action_CloseContactAddressPopup()
    {
    	$this->view = 'closecontactaddresspopup';
    }    
}
?>