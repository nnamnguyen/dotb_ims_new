<?php


class ProspectsViewEdit extends ViewEdit
{
 	public function __construct()
 	{
        parent::__construct();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}

}