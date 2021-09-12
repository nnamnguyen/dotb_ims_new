<?php




function get_body(&$ss, $vardef){
    global $app_list_strings;
	//$edit_mod_strings = return_module_language($current_language, 'EditCustomFields');
	//$edit_mod_strings['COLUMN_TITLE_DEFAULT_VALUE'] = $edit_mod_strings['COLUMN_TITLE_URL'];
	$vars = $ss->get_template_vars();
	$fields = $vars['module']->mbvardefs->vardefs['fields'];
	$fieldOptions = array();
	foreach($fields as $id=>$def) {
		$fieldOptions[$id] = $def['name'];
	}
	$ss->assign('fieldOpts', $fieldOptions);
    $link_target = !empty($vardef['link_target']) ? $vardef['link_target'] : '_self';
    $ss->assign('TARGET_OPTIONS', get_select_options_with_id($app_list_strings['link_target_dom'], $link_target));
    $ss->assign('LINK_TARGET', $link_target);
    $ss->assign('LINK_TARGET_LABEL', $app_list_strings['link_target_dom'][$link_target]);
	//_ppd($ss->fetch('modules/DynamicFields/templates/Fields/Forms/url.tpl'));
	return $ss->fetch('modules/DynamicFields/templates/Fields/Forms/url.tpl');
 }

?>
