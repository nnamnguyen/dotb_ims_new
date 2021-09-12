<?php


function get_body(&$ss, $vardef){
	$td = new TemplateDate();
	$ss->assign('default_values', array_flip($td->dateStrings));
	return $ss->fetch('modules/DynamicFields/templates/Fields/Forms/date.tpl');
}

?>
