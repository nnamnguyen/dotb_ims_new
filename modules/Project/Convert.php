<?php




global $timedate;
global $app_strings;
global $app_list_strings;
global $current_language;
global $current_user;
global $dotb_version, $dotb_config;
$focus = BeanFactory::newBean('Project');



if(!empty($_REQUEST['record']))
{
    $focus->retrieve($_REQUEST['record']);
}

if ($focus->is_template){
	echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'],
						 array($mod_strings['LBL_PROJECT_TEMPLATE'] . ': ' . $focus->name), true);
}
else{
	echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], array($mod_strings['LBL_MODULE_NAME'],$focus->name), true);

}



$GLOBALS['log']->info("Project detail view");

$dotb_smarty = new Dotb_Smarty();
///
/// Assign the template variables
///
$dotb_smarty->assign('MOD', $mod_strings);
$dotb_smarty->assign('APP', $app_strings);
$dotb_smarty->assign('name', $focus->name);

$dotb_smarty->assign('ID', $focus->id);
$dotb_smarty->assign('NAME', $focus->name);

// get date/time fields in correct display format to pass front end validation
foreach ($focus->fetched_row as $field=>$value) {
    if (isset($focus->field_defs[$field]['type'])
        && in_array($focus->field_defs[$field]['type'], array('date','datetime','datetimecombo','time'))) {
        $focus->fetched_row[$field] = $focus->$field;
    }
}

// awu: Bug 11820 - date entered was not conforming to correct date in Oracle
$focus->fetched_row['estimated_start_date'] = $focus->estimated_start_date;
$focus->fetched_row['estimated_end_date'] = $focus->estimated_end_date;
$focus->fetched_row['date_entered'] = $timedate->nowDbDate();
$focus->fetched_row['date_modified'] = $timedate->nowDbDate();

// populate form with project's data
$dotb_smarty->assign('PROJECT_FORM', $focus->fetched_row);

if ($focus->is_template){
	$dotb_smarty->assign('SAVE_TYPE', "TemplateToProject");
	$dotb_smarty->assign('SAVE_TO', "project");
	$dotb_smarty->assign('SAVE_TO_LBL', $mod_strings['LBL_PROJECT_NAME']);
	$dotb_smarty->assign('SAVE_BUTTON', $mod_strings['LBL_SAVE_AS_NEW_PROJECT_BUTTON']);
}
else{
	$dotb_smarty->assign('SAVE_TYPE', "ProjectToTemplate");
	$dotb_smarty->assign('SAVE_TO', "template");
	$dotb_smarty->assign('SAVE_TO_LBL', $mod_strings['LBL_TEMPLATE_NAME']);
	$dotb_smarty->assign('SAVE_BUTTON', $mod_strings['LBL_SAVE_AS_NEW_TEMPLATE_BUTTON']);
}

echo $dotb_smarty->fetch('modules/Project/Convert.tpl');


$javascript = new javascript();
$javascript->setFormName('EditView');
$javascript->setDotbBean($focus);
$javascript->addAllFields('');
if ($focus->is_template){
	$javascript->addFieldGeneric('project_name', 'varchar', $mod_strings['LBL_PROJECT_NAME'] ,'true');
}
else{
	$javascript->addFieldGeneric('template_name', 'varchar', $mod_strings['LBL_TEMPLATE_NAME'] ,'true');
}

echo $javascript->getScript();

?>
