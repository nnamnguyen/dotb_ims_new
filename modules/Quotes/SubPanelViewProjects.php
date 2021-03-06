<?php







global $app_strings;
//we don't want the parent module's string file, but rather the string file specifc to this subpanel
global $current_language;
$current_module_strings = return_module_language($current_language, 'Quotes');
$project_module_strings = return_module_language($current_language, 'Project');

global $currentModule;

global $theme;
global $focus;
global $action;

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

// focus_list is the means of passing data to a SubPanelView.
global $focus_list;

$button  = "<form action='index.php' method='post' name='form' id='form'>\n";
$button .= "<input type='hidden' name='module' value='Quotes'>\n";
$button .= "<input type='hidden' name='return_module' value='".$currentModule."'>\n";
$button .= "<input type='hidden' name='return_action' value='".$action."'>\n";
$button .= "<input type='hidden' name='return_id' value='".$focus->id."'>\n";
$button .= "<input type='hidden' name='action'>\n";

$button .= "<input title='".$app_strings['LBL_SELECT_BUTTON_TITLE']."' accessyKey='".$app_strings['LBL_SELECT_BUTTON_KEY']."' type='button' class='button' value='  ".$app_strings['LBL_SELECT_BUTTON_LABEL']
	."  ' name='button' onclick='open_popup(\"Quotes\", 600, 400, \"\", false, true, {$encoded_popup_request_data});'>\n";
$button .= "</form>\n";

$ListView = new ListView();
$ListView->initNewXTemplate( 'modules/Quotes/SubPanelViewProjects.html',$current_module_strings);
$ListView->xTemplateAssign("REMOVE_INLINE_PNG", DotbThemeRegistry::current()->getImage('delete_inline','align="absmiddle" border="0"',null,null,'.gif',$app_strings['LNK_REMOVE']));
$ListView->xTemplateAssign("RETURN_URL", "&return_module=".$currentModule."&return_action=DetailView&return_id=".$focus->id);
$header_text = '';
if((is_admin($current_user) || is_admin_for_module($GLOBALS['current_user'],'Quotes'))
	&& $_REQUEST['module'] != 'DynamicLayout'
	&& !empty($_SESSION['editinplace']))
{	
	$header_text = " <a href='index.php?action=index"
		. "&module=DynamicLayout"
		. "&from_action=SubPanelViewProjects"
		. "&from_module=Quotes'>"
		. DotbThemeRegistry::current()->getImage( 'EditLayout', "border='0' align='bottom'",null,null,'.gif',$mod_strings['LBL_EDITLAYOUT'])
		. '</a>';
}
$ListView->setHeaderTitle($project_module_strings['LBL_QUOTE_SUBPANEL_TITLE'] . $header_text);
$ListView->setHeaderText($button);
$ListView->processListView($focus_list, "main", "QUOTE");

?>
