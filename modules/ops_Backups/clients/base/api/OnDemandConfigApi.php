<?php
/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 */

require_once('clients/base/api/ConfigModuleApi.php');

class OnDemandConfigApi extends ConfigModuleApi
{

    /**
     * Set this to true in a subclass if this is being handled by the subclass in additional scripts
     *
     * @var bool
     */
    protected $skipMetadataRefresh = false;

    /**
     * Setup the endpoint that belong to this API EndPoint
     *
     * @return array
     */
    public function registerApiRest()
    {
        return array(
            'config' => array(
                'reqType' => 'GET',
                'path' => array('ops_Backups', 'config'),
                'pathVars' => array('module', ''),
                'method' => 'config',
                'shortHelp' => 'Retrieves the config settings for a given module',
                'longHelp' => 'include/api/help/module_config_get_help.html',
            ),
            'configCreate' => array(
                'reqType' => 'POST',
                'path' => array('ops_Backups', 'config'),
                'pathVars' => array('module', ''),
                'method' => 'configSave',
                'shortHelp' => 'Creates the config entries for the given module',
                'longHelp' => 'include/api/help/module_config_post_help.html',
            ),
            'configUpdate' => array(
                'reqType' => 'PUT',
                'path' => array('ops_Backups', 'config'),
                'pathVars' => array('module', ''),
                'method' => 'configSave',
                'shortHelp' => 'Updates the config entries for given module',
                'longHelp' => 'include/api/help/module_config_put_help.html',
            ),
        );
    }

    /**
     * Returns the config settings for the given module
     *
     * @throws DotbApiExceptionNotAuthorized
     * @param ServiceBase $api
     * @param $args 'module' is required, 'platform' is optional and defaults to 'base'
     * @return array
     */
    public function config(ServiceBase $api, array $args)
    {

        $this->requireArgs($args, array('module'));
        $seed = BeanFactory::newBean($args['module']);

        //acl check
        if (!$seed->ACLAccess('access')) {
            // No create access so we construct an error message and throw the exception
            $moduleName = null;
            if (isset($args['module'])) {
                $failed_module_strings = return_module_language($GLOBALS['current_language'], $args['module']);
                $moduleName = $failed_module_strings['LBL_MODULE_NAME'];
            }
            $args = null;
            if (!empty($moduleName)) {
                $args = array('moduleName' => $moduleName);
            }
            throw new DotbApiExceptionNotAuthorized(
                $GLOBALS['app_strings']['EXCEPTION_ACCESS_MODULE_CONFIG_NOT_AUTHORIZED'],
                $args
            );
        }

        if (!empty($args['module'])) {
            ops_Backups::dotbConfig();
        }
        return;
    }

    /**
     * Save function for the config settings for a given module.
     *
     * @throws DotbApiExceptionNotAuthorized
     * @param ServiceBase $api
     * @param array $args           'module' is required, 'platform' is optional and defaults to 'base'
     * @return array
     */
    public function configSave(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array('module'));

        $module = $args['module'];

        // these are not part of the config values, so unset
        unset($args['module']);
        unset($args['__dotb_url']);

        //acl check, only allow if they are module admin
        if (!$api->user->isAdmin() && !$api->user->isDeveloperForModule($module)) {
            // No create access so we construct an error message and throw the exception
            $failed_module_strings = return_module_language($GLOBALS['current_language'], $module);
            $moduleName = $failed_module_strings['LBL_MODULE_NAME'];

            $args = null;
            if (!empty($moduleName)) {
                $args = array('moduleName' => $moduleName);
            }

            throw new DotbApiExceptionNotAuthorized(
                $GLOBALS['app_strings']['EXCEPTION_CHANGE_MODULE_CONFIG_NOT_AUTHORIZED'],
                $args
            );
        }

        foreach ($args as $name => $value) {
            ops_Backups::setDotbConfig($name,$value);
        }

        if ($this->skipMetadataRefresh === false) {
            MetaDataManager::refreshModulesCache(array($module));
        }

        return ops_Backups::dotbConfig(true);
    }
}
