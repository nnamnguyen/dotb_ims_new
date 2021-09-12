<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;
use Dotbcrm\Dotbcrm\Util\Files\FileLoader;

// Used for custom plugins
if (!empty($_REQUEST['plugin_action']) && !empty($_REQUEST['plugin_module'])) {

    $request = InputValidation::getService();
    $module = $request->getValidInputRequest('plugin_action');
    $action = $request->getValidInputRequest('plugin_action');

    $plugin = 'custom/workflow/plugins/'.$module.'/'.$action.'.php';

    if (DotbAutoLoader::existing($plugin)) {
        include_once FileLoader::validateFilePath($plugin);
    } else {
        echo "custom plugin file not found";
    }

} else {
    echo "A custom plugin step 2 was not specified";
}
