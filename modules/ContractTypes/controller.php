<?php

class ContractTypesController extends DotbController {
	public function process(){
        if ((!is_admin($GLOBALS['current_user']) && (!is_admin_for_module($GLOBALS['current_user'], 'Contracts')))) {
			$this->hasAccess = false;
		}
		parent::process();
	}
	
}

