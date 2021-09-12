<?php


use Dotbcrm\Dotbcrm\ProcessManager;


class PMSELogicHook
{
    function after_save($bean, $event, $arguments)
    {
        if (!$this->isDotbInstalled()) {
            return true;
        }

        if (!PMSEEngineUtils::hasActiveProcesses($bean)) {
            return true;
        }
        //Define PA Hook Handler
        $handler = ProcessManager\Factory::getPMSEObject('PMSEHookHandler');
        return $handler->runStartEventAfterSave($bean, $event, $arguments);
    }

    function after_delete($bean, $event, $arguments)
    {
        if (!$this->isDotbInstalled()) {
            return true;
        }

        if (!PMSEEngineUtils::hasActiveProcesses($bean)) {
            return true;
        }
        //Define PA Hook Handler
        $handler = ProcessManager\Factory::getPMSEObject('PMSEHookHandler');
        return $handler->terminateCaseAfterDelete($bean, $event, $arguments);
    }

    /**
     * Checks to see if Dotb is installed. Returns false when Dotb is in the process
     * of installation
     * @return boolean
     */
    protected function isDotbInstalled()
    {
        global $dotb_config;

        // During installation, the `installing` variable is set, so if this is
        // not empty, then we are in the middle of installation, or not installed
        if (!empty($GLOBALS['installing'])) {
            return false;
        }

        // When installed, dotb sets `installer_locked` in the config to true,
        // so if `installer_locked` is not empty then we are installed
        return !empty($dotb_config['installer_locked']);
    }
}
