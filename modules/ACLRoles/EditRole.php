<?php



use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

global $app_list_strings, $modInvisList;

$dotb_smarty = new Dotb_Smarty();

$dotb_smarty->assign('MOD', $mod_strings);
$dotb_smarty->assign('APP', $app_strings);
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
	} else {
		$return['record']= $role->id;
		$return['action']='DetailView';
	}
	
} else {
	$categories = ACLRole::getRoleActions('');
}
// hidden module
$hidden_modules = array(
    "Bugs",
    "C_AdminConfig",
    "C_Gallery",
    "C_GalleryDetail",
    "C_SMS",
    "CJ_Forms",
    "CJ_WebHooks",
    "Contracts",
    "DRI_SubWorkflow_Templates",
    "DRI_SubWorkflows",
    "DRI_Workflow_Task_Templates",
    "DRI_Workflow_Templates",
    "DRI_Workflows",
    "DataPrivacy",
    "Forecasts",
    "J_GradebookDetail",
    "J_Inventorydetail",
    "KBArticles",
    "KBContents",
    "KBContentTemplates",
    "RT_DotbBoards",
    "C_Attendance",
    "C_Carryforward",
    "ProjectTask",
    "Project",
    "Products",
    "Quotes",
    "RevenueLineItems",
    "Trackers",
    "TrackerQueries",
    "TrackerSessions",
    "fte_UsageTracking",
    "TrackerPerfs",
    "Opportunities",
    "PdfManager",
    "Tags",
    "Users",
    "WebLogicHooks",
);
foreach ($categories as $name => $category) {
    $objName = BeanFactory::getObjectName($name) ?: $name;
    if (in_array($name, $hidden_modules)) {
        unset($categories[$name]);
        $hidden_categories[] = $name;
    }
}
// Skipping modules that have 'hidden_to_role_assignment' property
foreach ($categories as $name => $category) {
	if (isset($dictionary[$name]) &&
		isset($dictionary[$name]['hidden_to_role_assignment']) &&
		$dictionary[$name]['hidden_to_role_assignment']
	) {
		unset($categories[$name]);
	}
}

if (in_array('Project', $modInvisList)) {
    unset($categories['Project']);
    unset($categories['ProjectTask']);
}
$dotb_smarty->assign('ROLE', $role->toArray());
$tdwidth = 10;

$returnModule = $request->getValidInputRequest('return_module', 'Assert\Mvc\ModuleName');
$returnAction = $request->getValidInputRequest('return_action');
$returnRecord = $request->getValidInputRequest('return_record', 'Assert\Guid');
if ($returnModule !== null) {
	$return['module'] = $returnModule;
	if($returnAction !== null) {
		$return['action'] = $returnAction;
	}
	if($returnRecord !== null) {
		$return['record'] = $returnRecord;
	}
}
$categoryName = $request->getValidInputRequest('category_name');

$dotb_smarty->assign('RETURN', $return);
$names = ACLAction::setupCategoriesMatrix($categories);
if(!empty($names))$tdwidth = 100 / sizeof($names);
$dotb_smarty->assign('CATEGORIES', $categories);
$dotb_smarty->assign('CATEGORY_NAME', $categoryName);
$dotb_smarty->assign('TDWIDTH', $tdwidth);
$dotb_smarty->assign('ACTION_NAMES', $names);

$actions = null;
if (isset($categories[$_REQUEST['category_name']]['module'])) {
    $actions = $categories[$categoryName]['module'];
}

$dotb_smarty->assign('ACTIONS', $actions);
ob_clean();

if($categoryName == 'All'){
	echo $dotb_smarty->fetch('modules/ACLRoles/EditAllBody.tpl');	
}else{
//WDong Bug 23195: Strings not localized in Role Management.
echo getClassicModuleTitle(
    $categoryName,
    array($app_list_strings['moduleList'][$categoryName]),
    false
);
echo $dotb_smarty->fetch('modules/ACLRoles/EditRole.tpl');
if (!isset($dictionary[$categoryName]['hide_fields_to_edit_role']) ||
    $dictionary[$categoryName]['hide_fields_to_edit_role'] === false
) {
    echo ACLFieldsEditView::getView($categoryName, $role->id);
}
echo '</form>';
}
dotb_cleanup(true);
