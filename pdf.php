<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

/**
 * @deprecated This file will be removed in a next release
 */

global $locale;

if (!empty($_REQUEST['module']) && !empty($_REQUEST['action']) && !empty($_REQUEST['record'])) {

    $request = InputValidation::getService();
    $module = $request->getValidInputGet('module', 'Assert\Mvc\ModuleName');
    $record = $request->getValidInputGet('record', 'Assert\Guid');
    $action = $request->getValidInputGet('action');

} else {
    dotb_die("pdf.php - module, action, and record id all are required");
}

$GLOBALS['focus'] = BeanFactory::getBean($module, $record);

if (empty($GLOBALS['focus'])) {
    ACLController::displayNoAccess();
    dotb_die("pdf.php - record not found");
}

$includeFile = "modules/$module/$action.php";

if (!file_exists($includeFile)) {
    dotb_die("pdf.php - include file does not exist");
}

DotbAutoLoader::includeFile($includeFile);

