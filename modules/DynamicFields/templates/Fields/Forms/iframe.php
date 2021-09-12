<?php

 
function get_body(&$ss, $vardef){
	$vars = $ss->get_template_vars();
	$fields = $vars['module']->mbvardefs->vardefs['fields'];
	$fieldOptions = array();
	foreach($fields as $id=>$def) {
		$fieldOptions[$id] = $def['name'];
	}
	$ss->assign('fieldOpts', $fieldOptions);
    $ss->assign('hideReportable', true);
	return $ss->fetch('modules/DynamicFields/templates/Fields/Forms/iframe.tpl');
 }
