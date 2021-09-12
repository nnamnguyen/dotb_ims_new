<?php


/**
 * ContactsViewContactAddressPopup
 * 
 * */
 
require_once('modules/Contacts/Popup_picker.php');

class ContactsViewMailMergePopup extends DotbView {
    /**
     * {@inheritDoc}
     *
     * @param array $params Ignored
     */
    public function process($params = array())
    {
		$this->display();
 	}

 	function display() {
 		
		$popup = new Popup_Picker();
		echo $popup->process_page_for_merge();
 	}	
}
