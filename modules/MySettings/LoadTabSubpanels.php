<?php


/**
 * Created on Jul 17, 2006
 * Ajax Procedure for loading all subpanels for a certain subpanel tab.
 */
use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

$detailView = new DetailView();

$focus = BeanFactory::newBean($_REQUEST['loadModule']);
$focus->id = $_REQUEST['record'];

$loadModule = InputValidation::getService()->getValidInputRequest('loadModule', 'Assert\Mvc\ModuleName');
$subpanel = new SubPanelTiles($focus, $loadModule);

if(!function_exists('get_form_header')) {
    global $theme;

}

// set up data for subpanels
global $currentModule;
$currentModule = $_REQUEST['loadModule'];
$_REQUEST['action'] = 'DetailView';

//This line of code is critical.  We need to ensure that the global controller bean is set to the $currentModule global variable
$GLOBALS['app']->controller->bean = $focus;
echo $subpanel->display(false);
?>
