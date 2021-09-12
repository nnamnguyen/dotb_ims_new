<?php


/**
 * This class is here to provide functions to easily call in to the individual module api helpers
 */
class ApiHelper
{
    /**
     * A list of all the loaded helpers so we don't have to reload them all again
     *
     * @var array
     */
    public static $moduleHelpers = array();

    /**
     * This method looks up the helper class for the bean and will provide the default helper
     * if there is not one defined for that particular bean
     *
     * @param $api ServiceBase The API that will be associated to this helper class
     *                         This is used so the formatting functions can handle different
     *                         API's with varying formatting requirements.
     * @param $bean DotbBean Grab the helper module for this bean
     * @return DotbBeanApiHelper API helper
     */
    public static function getHelper(ServiceBase $api, DotbBean $bean)
    {
        $modulePath = $bean->module_dir;
        $moduleName = $bean->module_name;

        if (!isset(self::$moduleHelpers[$moduleName])) {
            if (DotbAutoLoader::requireWithCustom('modules/' . $modulePath . '/' . $moduleName . 'ApiHelper.php')) {
                $moduleHelperClass = DotbAutoLoader::customClass($moduleName . 'ApiHelper');
            } elseif (file_exists('custom/data/DotbBeanApiHelper.php')) {
                require_once('custom/data/DotbBeanApiHelper.php');
                $moduleHelperClass = 'CustomDotbBeanApiHelper';
            } else {
                $moduleHelperClass = 'DotbBeanApiHelper';
            }

            self::$moduleHelpers[$moduleName] = new $moduleHelperClass($api);
        }

        return self::$moduleHelpers[$moduleName];
    }

    /**
     * Override module's api helper class
     *
     * For use mainly in unit tests
     *
     * @param $module
     * @param DotbBeanApiHelper|null $helper What class to set the helper as, if null, the helper will be unset
     */
    public static function setHelper($module, DotbBeanApiHelper $helper = null)
    {
        if (is_null($helper) && isset(self::$moduleHelpers[$module])) {
            unset(self::$moduleHelpers[$module]);
        } elseif (is_object($helper)) {
            self::$moduleHelpers[$module] = $helper;
        }
    }
}
