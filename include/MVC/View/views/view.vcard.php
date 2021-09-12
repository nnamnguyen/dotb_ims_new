<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class ViewVcard extends DotbView
{
	public $type = 'detail';
	
	/**
     * @see DotbView::display()
     */
	public function display()
    {
		$vcard = new vCard();		
		$vcard->loadContact($this->bean->id, $this->module);
		$vcard->saveVCard();
 	}
}
?>
