<?php



use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

global $beanList;
global $beanFiles;

$module = InputValidation::getService()->getValidInputRequest('module', 'Assert\Mvc\ModuleName', '');
$record = InputValidation::getService()->getValidInputRequest('record', 'Assert\Guid', '');

if (empty($module)) {
    die("'module' was not defined");
}

if (empty($record)) {
    die("'record' was not defined");
}

if(empty($_REQUEST['subpanel']))
{
    LoggerManager::getLogger()->error("SubPanelViewer: 'subpanel' was not defined in request");
    exit(1);
}

if (!isset($beanList[$module])) {
    die("'".$module."' is not defined in \$beanList");
}

$subpanel = $_REQUEST['subpanel'];

if(empty($_REQUEST['inline']))
{
	insert_popup_header($theme);
}

include('include/SubPanel/SubPanel.php');
$layout_def_key = '';
if(!empty($_REQUEST['layout_def_key'])){
	$layout_def_key = $_REQUEST['layout_def_key'];
}

$subpanel_object = new SubPanel($module, $record, $subpanel,null, $layout_def_key);

$subpanel_object->setTemplateFile('include/SubPanel/SubPanelDynamic.html');
echo (empty($_REQUEST['inline']))?$subpanel_object->get_buttons():'' ;

$subpanel_object->display();

if(empty($_REQUEST['inline']))
{
	insert_popup_footer($theme);
}

