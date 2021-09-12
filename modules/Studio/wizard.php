<?php



use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;
use Dotbcrm\Dotbcrm\Util\Files\FileLoader;

require_once 'modules/Studio/config.php';

$wizard = InputValidation::getService()->getValidInputRequest('wizard', null, 'StudioWizard');

if (file_exists('modules/Studio/wizards/'. $wizard . '.php')) {
    require_once FileLoader::validateFilePath('modules/Studio/wizards/'. $wizard . '.php');
    $thewiz = new $wizard();
} else {
    unset($_SESSION['studio']['lastWizard']);
    $thewiz = new StudioWizard();
}

if (!empty($_REQUEST['back'])) {
    $thewiz->back();
}
if (!empty($_REQUEST['option'])) {
    $thewiz->process($_REQUEST['option']);
} else {
    $thewiz->display();
}
