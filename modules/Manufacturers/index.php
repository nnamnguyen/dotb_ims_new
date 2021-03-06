<?php

/*********************************************************************************

 * Description:
 ********************************************************************************/
use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

require_once 'include/DotbSmarty/plugins/function.dotb_action_menu.php';
require_once 'include/DotbSmarty/plugins/function.dotb_csrf_form_token.php';

$header_text = '';
global $mod_strings;
global $app_list_strings;
global $app_strings;
global $current_user;
if (!is_admin($current_user) && !is_admin_for_module($GLOBALS['current_user'],'Products'))
{
   dotb_die("Unauthorized access to administration.");
}

$focus = BeanFactory::newBean('Manufacturers');

$params = array();
$params[] = "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME','Administration')."</a>";
$params[] = $mod_strings['LBL_MODULE_NAME'];
echo getClassicModuleTitle($focus->module_dir, $params, true);

$is_edit = false;
if(!empty($_REQUEST['record'])) {
    $result = $focus->retrieve($_REQUEST['record']);
    if($result == null)
    {
    	dotb_die($app_strings['ERROR_NO_RECORD']);
    }
	$is_edit=true;
}
if(isset($_REQUEST['edit']) && $_REQUEST['edit']=='true') {
	$is_edit=true;
	//Only allow admins to enter this screen
	if (!is_admin($current_user) && !is_admin_for_module($GLOBALS['current_user'],'Products')){
		$GLOBALS['log']->error("Non-admin user ($current_user->user_name) attempted to enter the Manufacturers edit screen");
		session_destroy();
		include('modules/Users/Logout.php');
	}
}

$GLOBALS['log']->info("Manufacturer list view");
global $theme;

$ListView = new ListView();
$module = InputValidation::getService()->getValidInputRequest('module', 'Assert\Mvc\ModuleName');

$button  = "<form border='0' action='index.php' method='post' name='form'>\n";
$button .= smarty_function_dotb_csrf_form_token(array(), $ListView);
$button .= "<input type='hidden' name='module' value='Manufacturers'>\n";
$button .= "<input type='hidden' name='action' value='EditView'>\n";
$button .= "<input type='hidden' name='edit' value='true'>\n";
$button .= "<input type='hidden' name='return_module' value='".$currentModule."'>\n";
$button .= "<input type='hidden' name='return_action' value='".$action."'>\n";
$button .= "<input title='".$app_strings['LBL_NEW_BUTTON_TITLE']."' accessyKey='".$app_strings['LBL_NEW_BUTTON_KEY']."' class='button primary' type='submit' name='New' value='".$app_strings['LBL_NEW_BUTTON_LABEL']."' id='btn_create'>\n";
$button .= "</form>\n";

if(is_admin($current_user) && $module != 'DynamicLayout' && !empty($_SESSION['editinplace'])){
		$header_text = "&nbsp;<a href='index.php?action=index&module=DynamicLayout&from_action=ListView&from_module=".htmlspecialchars($module, ENT_QUOTES, 'UTF-8') ."'>".DotbThemeRegistry::current()->getImage("EditLayout","border='0' alt='Edit Layout' align='bottom'",null,null,'.gif',$mod_strings['LBL_EDITLAYOUT'])."</a>";
}
$ListView->initNewXTemplate( 'modules/Manufacturers/ListView.html',$mod_strings);
$ListView->xTemplateAssign("DELETE_INLINE_PNG",  DotbThemeRegistry::current()->getImage('delete_inline','align="absmiddle" border="0"',null,null,'.gif',$app_strings['LNK_DELETE']));

$action_button = smarty_function_dotb_action_menu(array(
    'id' => 'manufacturer_create_button',
    'buttons' => array($button),
), $ListView);

$ListView->setHeaderTitle($header_text.$action_button);

$ListView->show_select_menu = false;
$ListView->show_export_button = false;
$ListView->show_mass_update = false;
$ListView->show_delete_button = false;
$ListView->setQuery("", "", "list_order", "MANUFACTURER");
$ListView->processListView($focus, "main", "MANUFACTURER");

if ($is_edit) {

		$edit_button ="<form name='EditView' method='POST' action='index.php'>\n";
        $edit_button .= smarty_function_dotb_csrf_form_token(array(), $ListView);
		$edit_button .="<input type='hidden' name='module' value='Manufacturers'>\n";
		$edit_button .="<input type='hidden' name='record' value='$focus->id'>\n";
		$edit_button .="<input type='hidden' name='action'>\n";
		$edit_button .="<input type='hidden' name='edit'>\n";
		$edit_button .="<input type='hidden' name='isDuplicate'>\n";
		$edit_button .="<input type='hidden' name='return_module' value='Manufacturers'>\n";
		$edit_button .="<input type='hidden' name='return_action' value='index'>\n";
		$edit_button .="<input type='hidden' name='return_id' value=''>\n";
		$edit_button .='<input title="'.$app_strings['LBL_SAVE_BUTTON_TITLE'].'" accessKey="'.$app_strings['LBL_SAVE_BUTTON_KEY'].'" class="button" onclick="this.form.action.value=\'Save\'; return check_form(\'EditView\');" type="submit" name="button primary" value="'.$app_strings['LBL_SAVE_BUTTON_LABEL'].'" id="btn_save">';
		$edit_button .=' <input title="'.$app_strings['LBL_SAVE_NEW_BUTTON_TITLE'].'" class="button" onclick="this.form.action.value=\'Save\'; this.form.isDuplicate.value=\'true\'; this.form.edit.value=\'true\'; this.form.return_action.value=\'EditView\'; return check_form(\'EditView\')" type="submit" name="button" value="'.$app_strings['LBL_SAVE_NEW_BUTTON_LABEL'].'" >';
		if(is_admin($current_user) && $module != 'DynamicLayout' && !empty($_SESSION['editinplace'])){
		$header_text = "&nbsp;<a href='index.php?action=index&module=DynamicLayout&edit=true&from_action=EditView&from_module=".htmlspecialchars($module, ENT_QUOTES, 'UTF-8') ."'>".DotbThemeRegistry::current()->getImage("EditLayout","border='0' alt='Edit Layout' align='bottom'",null,null,'.gif',$mod_strings['LBL_EDITLAYOUT'])."</a>";
		}
echo get_form_header($mod_strings['LBL_MANUFACTURER']." ".$focus->name . ' '. $header_text,$edit_button , false);


	$GLOBALS['log']->info("Manufacturers edit view");
	$xtpl=new XTemplate ('modules/Manufacturers/EditView.html');
	$xtpl->assign("MOD", $mod_strings);
	$xtpl->assign("APP", $app_strings);

	$returnModule = InputValidation::getService()->getValidInputRequest('return_module', 'Assert\Mvc\ModuleName');
	$returnAction = InputValidation::getService()->getValidInputRequest('return_action');
	$returnId = InputValidation::getService()->getValidInputRequest('return_id', 'Assert\Guid');
	if (!empty($returnModule)) {
		$xtpl->assign("RETURN_MODULE", htmlspecialchars($returnModule, ENT_QUOTES, 'UTF-8'));
	}
	if (!empty($returnAction)) {
		$xtpl->assign("RETURN_ACTION", htmlspecialchars($returnAction, ENT_QUOTES, 'UTF-8'));
	}
	if (!empty($returnId)) {
		$xtpl->assign("RETURN_ID", htmlspecialchars($returnId, ENT_QUOTES, 'UTF-8'));
	}
	$xtpl->assign("JAVASCRIPT", get_set_focus_js());
	$xtpl->assign("ID", $focus->id);
	$xtpl->assign('NAME', $focus->name);
	$xtpl->assign('STATUS', $focus->status);

	if (empty($focus->list_order)) $xtpl->assign('LIST_ORDER', count($focus->get_manufacturers(false,'All'))+1);
	else $xtpl->assign('LIST_ORDER', $focus->list_order);
	$xtpl->assign('STATUS_OPTIONS', get_select_options_with_id($mod_strings['manufacturer_status_dom'], $focus->status));

// adding custom fields:

require_once('modules/DynamicFields/templates/Files/EditView.php');


	$xtpl->parse("main");
	$xtpl->out("main");

$javascript = new javascript();
$javascript->setFormName('EditView');
$javascript->setDotbBean($focus);
$javascript->addAllFields('');
echo $javascript->getScript();
}
?>
