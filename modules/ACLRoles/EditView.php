<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;


global $app_list_strings;// $modInvisList;

$dotb_smarty = new Dotb_Smarty();

$dotb_smarty->assign('MOD', $mod_strings);
$dotb_smarty->assign('APP', $app_strings);
$dotb_smarty->assign('ISDUPLICATE', '');
$duplicateString='';
//mass localization
$dotb_smarty->assign('APP_LIST', $app_list_strings);
$role = BeanFactory::newBean('ACLRoles');
$role_name = '';
$return= array('module'=>'ACLRoles', 'action'=>'index', 'record'=>'');
$request = InputValidation::getService();
$record = $request->getValidInputRequest('record', 'Assert\Guid');
$isDuplicate = $request->getValidInputRequest('isDuplicate');

if (!empty($record)) {
	$role->retrieve($record);
	$categories = ACLRole::getRoleActions($record);
	$role_name =  $role->name;
	if (!empty($isDuplicate)) {
		//role id is stripped here in duplicate so anything using role id after this will not have it
		$role->id = '';
		$dotb_smarty->assign('ISDUPLICATE', $record);
		$duplicateString=translate('LBL_DUPLICATE_OF', 'ACLRoles');
	} else {
		$return['record']= $role->id;
		$return['action']='DetailView';
	}

} else {
	$categories = ACLRole::getRoleActions('');
}
$dotb_smarty->assign('ROLE', $role->toArray());
$tdwidth = 10;

$returnModule = $request->getValidInputRequest('return_module', 'Assert\Mvc\ModuleName');
$returnId = $request->getValidInputRequest('return_id', 'Assert\Guid');
$returnAction = $request->getValidInputRequest('return_action');
$returnRecord = $request->getValidInputRequest('return_record', 'Assert\Guid');

if ($returnModule !== null) {
	$return['module'] = $returnModule;

	if($returnId !== null) {
		$return['record'] = $returnId;
	}
	if($returnRecord !== null) {
		$return['record'] = $returnRecord;
	}
	if($returnAction !== null) {
		$return['action'] = $returnAction;
	}
    if ( !empty($return['record']) ) {
        $return['action'] = 'DetailView';
    }
}

$dotb_smarty->assign('RETURN', $return);
$names = ACLAction::setupCategoriesMatrix($categories);

$dotb_smarty->assign('CATEGORIES', $categories);
$dotb_smarty->assign('TDWIDTH', $tdwidth);
$dotb_smarty->assign('ACTION_NAMES', $names);

$params = array();
$params[] = "<a href='index.php?module=ACLRoles&action=index'>{$mod_strings['LBL_MODULE_NAME']}</a>";
if(empty($role->id)){
	$params[] = $GLOBALS['app_strings']['LBL_CREATE_BUTTON_LABEL'];
}else{
	$params[] = $role->get_summary_text();
}
echo getClassicModuleTitle("ACLRoles", $params, true);

$buttons = array(
	"<input title=".$app_strings['LBL_SAVE_BUTTON_TITLE']." id='save_button'
		accessKey=".$app_strings['LBL_SAVE_BUTTON_KEY']." class='button primary'
		onclick=\"this.form.action.value='Save';return check_form('EditView');\"
		type='submit' name='button' value=".$app_strings['LBL_SAVE_BUTTON_LABEL']." >",
	"<input title=".$app_strings['LBL_CANCEL_BUTTON_TITLE']."
		class='button cancel_button' accessKey=".$app_strings['LBL_CANCEL_BUTTON_KEY']."
		type='submit' name='save' value=".$app_strings['LBL_CANCEL_BUTTON_LABEL']."
		onclick=\"document.EditView.action.value='".$return['action']."';document.EditView.module.value='".$return['module']."';document.EditView.record.value='".$return['record']."';document.EditView.submit();\">",
);

$action_buttons = $buttons;
$dotb_smarty->assign('ACTION_MENU', $action_buttons);
echo $dotb_smarty->fetch('modules/ACLRoles/EditView.tpl');

?>
