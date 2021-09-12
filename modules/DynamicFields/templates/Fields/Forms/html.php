<?php


function get_body($ss, $vardef)
{
	$edit_mod_strings = return_module_language($GLOBALS['current_language'], 'EditCustomFields');
	$ss->assign('MOD', $edit_mod_strings);

	$edValue = '';
    if(!empty($vardef['default_value'])) {
        $edValue = $vardef['default_value'];
        $edValue = str_replace(array("\r\n", "\n"), " ",$edValue);
    }
    $ss->assign('HTML_EDITOR', $edValue);
    $ss->assign('preSave', 'document.popup_form.presave();');
    $ss->assign('hideReportable', true);
	///////////////////////////////////
	return $ss->fetch('modules/DynamicFields/templates/Fields/Forms/html.tpl');
}
?>
