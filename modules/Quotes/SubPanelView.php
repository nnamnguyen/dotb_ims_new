<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/





global $app_strings;
//we don't want the parent module's string file, but rather the string file specifc to this subpanel
global $current_language;
$current_module_strings = return_module_language($current_language, 'Quotes');

global $currentModule;

global $theme;
global $focus;
global $action;

// focus_list is the means of passing data to a SubPanelView.
global $focus_list;

$button  = "<form action='index.php' method='post' name='form' id='form'>\n";
$button .= "<input type='hidden' name='module' value='Quotes'>\n";
if ($currentModule == 'Accounts') {
	$button .= "<input type='hidden' name='account_id' value='$focus->id'>\n";
	$button .= "<input type='hidden' name='account_name' value=\"$focus->name\">\n";
}
elseif ($currentModule == 'Contacts') {
	$button .= "<input type='hidden' name='account_id' value='$focus->account_id'>\n";
	$button .= "<input type='hidden' name='account_name' value=\"$focus->account_name\">\n";
	$button .= "<input type='hidden' name='contact_id' value='$focus->id'>\n";
}
elseif ($currentModule == 'Opportunities') {
	$button .= "<input type='hidden' name='account_id' value='$focus->account_id'>\n";
	$button .= "<input type='hidden' name='account_name' value=\"$focus->account_name\">\n";
	$button .= "<input type='hidden' name='opportunity_id' value='$focus->id'>\n";
	$button .= "<input type='hidden' name='opportunity_name' value=\"$focus->name\">\n";
	$button .= "<input type='hidden' name='date_quote_expected_closed' value=\"$focus->date_closed\">\n";
}

$button .= "<input type='hidden' name='return_module' value='".$currentModule."'>\n";
$button .= "<input type='hidden' name='return_action' value='".$action."'>\n";
$button .= "<input type='hidden' name='return_id' value='".$focus->id."'>\n";
$button .= "<input type='hidden' name='action'>\n";

$button .= "<input title='".$app_strings['LBL_NEW_BUTTON_TITLE']."' accessyKey='".$app_strings['LBL_NEW_BUTTON_KEY']."' class='button' onclick=\"this.form.action.value='EditView'\" type='submit' name='New' value='  ".$app_strings['LBL_NEW_BUTTON_LABEL']."  '>\n";
if ($currentModule == 'Opportunities')
{
	///////////////////////////////////////
	///
	/// SETUP PARENT POPUP
	
	$popup_request_data = array(
		'call_back_function' => 'set_return_and_save',
		'form_name' => 'DetailView',
		'field_to_name_array' => array(
			'id' => 'quote_id',
			),
		);
	
	$json = getJSONobj();
	$encoded_popup_request_data = $json->encode($popup_request_data);
	
	//
	///////////////////////////////////////
	
	$button .= "<input title='".$app_strings['LBL_SELECT_BUTTON_TITLE']
		."' accessyKey='".$app_strings['LBL_SELECT_BUTTON_KEY']
		."' type='button' class='button' value='  ".$app_strings['LBL_SELECT_BUTTON_LABEL']
		."' name='button' onclick='open_popup(\"Quotes\", 600, 400, \"\", false, true, {$encoded_popup_request_data});'>\n";
//		."  ' name='button' onclick='window.open(\"index.php?module=Quotes&action=Popup&html=Popup_picker&form=DetailView&form_submit=true\",\"new\",\"width=600,height=400,resizable=1,scrollbars=1\");'>\n";
}
else if($currentModule != 'Accounts' && $currentModule != 'Contacts')
$button .= "<input title='".$app_strings['LBL_SELECT_BUTTON_TITLE']."' accessyKey='".$app_strings['LBL_SELECT_BUTTON_KEY']."' type='button' class='button' value='  ".$app_strings['LBL_SELECT_BUTTON_LABEL']."  ' name='button' LANGUAGE=javascript onclick='window.open(\"index.php?module=Quotes&action=Popup&html=Popup_picker&form=ContactDetailView&form_submit=true\",\"new\",\"width=600,height=400,resizable=1,scrollbars=1\");'>\n";

$button .= "</form>\n";

$ListView = new ListView();
$ListView->initNewXTemplate( 'modules/Quotes/SubPanelView.html',$current_module_strings);
$ListView->xTemplateAssign("EDIT_INLINE_PNG",  DotbThemeRegistry::current()->getImage('edit_inline','align="absmiddle" border="0"',null,null,'.gif',$app_strings['LNK_EDIT']));
$ListView->xTemplateAssign("RETURN_URL", "&return_module=".$currentModule."&return_action=DetailView&return_id=".$focus->id);
$ListView->setHeaderTitle($current_module_strings['LBL_MODULE_NAME'] );
$ListView->setHeaderText($button);
$ListView->processListView($focus_list, "main", "QUOTE");

?>
