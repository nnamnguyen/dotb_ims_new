<?php
//_pp($_REQUEST);

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
require_once('modules/Documents/Popup_picker.php');
$popup = new Popup_Picker();

global $theme;
global $current_mod_strings;
global $app_strings;
global $currentModule;
global $dotb_version, $dotb_config;
global $app_list_strings;

$current_mod_strings = return_module_language($current_language, 'Documents');
$output_html = '';
$where = '';

$where = $popup->_get_where_clause();

// We can't attach remote documents to emails because we can't necessarialy fetch a copy of them to include.
if ( ! empty($where) ) {
    $where .= ' AND ';
}
$where .= "documents.doc_type IN ( '', 'Dotb')";

$name = empty($_REQUEST['name']) ? '' : $_REQUEST['name'];
$document_name = empty($_REQUEST['document_name']) ? '' : $_REQUEST['document_name'];
$category_id = empty($_REQUEST['category_id']) ? '' : $_REQUEST['category_id'];
$subcategory_id = empty($_REQUEST['subcategory_id']) ? '' : $_REQUEST['subcategory_id'];
$template_type = empty($_REQUEST['template_type']) ? '' : $_REQUEST['template_type'];
$is_template = empty($_REQUEST['is_template']) ? '' : $_REQUEST['is_template'];
$document_revision_id = empty($_REQUEST['document_revision_id']) ? '' : $_REQUEST['document_revision_id'];

//$request_data = empty($_REQUEST['request_data']) ? '' : $_REQUEST['request_data'];

$hide_clear_button = empty($_REQUEST['hide_clear_button']) ? false : true;
$button  = "<form action='index.php' method='post' name='form' id='form'>\n";
if(!$hide_clear_button)
{
	$button .= "<input type='button' name='button' class='button' onclick=\"send_back('','');\" title='"
		.$app_strings['LBL_CLEAR_BUTTON_TITLE']."' value='  "
		.$app_strings['LBL_CLEAR_BUTTON_LABEL']."  ' />\n";
}
$button .= "<input type='submit' name='button' class='button' onclick=\"window.close();\" title='"
	.$app_strings['LBL_CANCEL_BUTTON_TITLE']."' accesskey='"
	.$app_strings['LBL_CANCEL_BUTTON_KEY']."' value='  "
	.$app_strings['LBL_CANCEL_BUTTON_LABEL']."  ' />\n";
$button .= "</form>\n";

$form = new XTemplate('modules/Emails/PopupDocuments.html');
$form->assign('MOD', $current_mod_strings);
$form->assign('APP', $app_strings);
$form->assign('THEME', $theme);
$form->assign('MODULE_NAME', $currentModule);
$form->assign('NAME', $name);
$form->assign('DOCUMENT_NAME', $document_name);
$form->assign('DOCUMENT_TARGET', $_REQUEST['target']);
$form->assign('DOCUMENT_REVISION_ID', $document_revision_id);

//$form->assign('request_data', $request_data);
$form->assign("CATEGORY_OPTIONS", get_select_options_with_id($app_list_strings['document_category_dom'], $category_id));
$form->assign("SUB_CATEGORY_OPTIONS", get_select_options_with_id($app_list_strings['document_subcategory_dom'], $subcategory_id));
$form->assign("IS_TEMPLATE_OPTIONS", get_select_options_with_id($app_list_strings['checkbox_dom'], $is_template));
$form->assign("TEMPLATE_TYPE_OPTIONS", get_select_options_with_id($app_list_strings['document_template_type_dom'], $template_type));



ob_start();
insert_popup_header($theme);
$output_html .= ob_get_contents();
ob_end_clean();

$output_html .= get_form_header($current_mod_strings['LBL_SEARCH_FORM_TITLE'], '', false);

$form->parse('main.SearchHeader');
$output_html .= $form->text('main.SearchHeader');

// Reset the sections that are already in the page so that they do not print again later.
$form->reset('main.SearchHeader');

// create the listview
$seed_bean = BeanFactory::newBean('Documents');
$ListView = new ListView();
$ListView->show_export_button = false;
$ListView->process_for_popups = true;
$ListView->setXTemplate($form);
$ListView->setHeaderTitle($current_mod_strings['LBL_LIST_FORM_TITLE']);
$ListView->setHeaderText($button);
$ListView->setQuery($where, '', 'document_name', 'DOCUMENT');
$ListView->setModStrings($current_mod_strings);

ob_start();
$ListView->processListView($seed_bean, 'main', 'DOCUMENT');
$output_html .= ob_get_contents();
ob_end_clean();
		
$output_html .= insert_popup_footer();


echo $output_html;










?>