<?php

class ViewIndex extends DotbView
{
    public function __construct()
    {
		$this->options['show_footer'] = false;
		$this->options['show_header'] = true;
        parent::__construct();
 	}
 	
 	function display() {
 		$smarty = new Dotb_Smarty();
 		$smarty->display('modules/ExpressionEngine/tpls/index.tpl');
 	}
}

