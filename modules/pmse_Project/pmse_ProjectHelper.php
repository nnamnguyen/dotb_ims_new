<?php


use Dotbcrm\Dotbcrm\ProcessManager;

function getTargetsModules()
{
    // Prepare the result
    $modules = array();

    // Get the module list from the data wrapper
    $wrapper = ProcessManager\Factory::getPMSEObject('PMSECrmDataWrapper');
    $list = $wrapper->retrieveModules();

    // If there are results, use them to build the list
    if (is_array($list)) {
        foreach ($list as $module) {
            $modules[$module['value']] = $module['text'];
        }
    }

    // Filter the module list through ACLs
    $modules = DotbACL::filterModuleList($modules, 'access', false);

    // Return the result
    return $modules;
}
