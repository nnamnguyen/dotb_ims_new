<?php

class ViewCfTest extends DotbView
{
    public function __construct()
    {
		$this->options['show_footer'] = true;
		$this->options['show_header'] = true;
        parent::__construct();
 	}
 	
 	function display() {
 		$th = new TemplateHandler();
 		$depScript = $th->createDependencyJavascript(array(
 			'phone_office' => array(
 				'calculated' => true, 
 				"formula" => 'add(strlen($name), $employees)',
 				"enforced" => true,
 		)),array(), "EditView");
 		$smarty = new Dotb_Smarty();
 		$smarty->assign("dependencies", $depScript);
 		$smarty->display('modules/ExpressionEngine/tpls/cfTest.tpl');
 	}
}

