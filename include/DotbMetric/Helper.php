<?php


/**
 * DotbMetric Helper class
 *
 * Loads DotbMetric_Manager with depending objects such as dotb configuration
 * Used to take all loading logic in one place
 */
class DotbMetric_Helper
{
    /**
     * Loads DotBCRM configuration files
     *
     * In case global configuration files are not loaded
     * (f.e. on entryPoint "getImage" or "getYUIComboFile"
     * @see include/preDispatch.php)
     * we should load them to use in DotbMetric_Manager class
     */
    public static function loadDotbConfig()
    {
        global $dotb_config;

        if ($dotb_config) {
            return;
        }

        if (is_file('config.php')) {
            require_once('config.php');
        }

        if (is_file('config_override.php')) {
            require_once('config_override.php');
        }
    }

    /**
     * Helper method to load DotbMetric_Manager
     *
     * DotbAutoLoader is not available only in case of entryPoint = "getYUIComboFile"
     * @see include/preDispatch.php
     */
    public static function loadManagerClass()
    {
        if (class_exists('DotbAutoLoader')) {
            DotbAutoLoader::requireWithCustom('include/DotbMetric/Manager.php');
        } else {
            if (file_exists('custom/include/DotbMetric/Manager.php')) {
                require_once 'custom/include/DotbMetric/Manager.php';
            } elseif (file_exists('include/DotbMetric/Manager.php')) {
            }
        }
    }

    /**
     * Helper method to load DotbMetric_Manager and set endPoints and transaction name
     *
     * @param string|bool $transaction is $transaction is FALSE do not call setTransactionName method
     */
    public static function run($transaction = '')
    {
        self::loadDotbConfig();
        self::loadManagerClass();

        $instance = DotbMetric_Manager::getInstance();

        if ($transaction !== false) {
            $instance->setTransactionName($transaction);
        }
    }
}
