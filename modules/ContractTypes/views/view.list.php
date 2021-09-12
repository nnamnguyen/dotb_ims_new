<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class ContractTypesViewList extends ViewList {
 	function preDisplay(){
 		parent::preDisplay();
 		$this->lv->showMassupdateFields=false;
 		
 	}
}
?>
