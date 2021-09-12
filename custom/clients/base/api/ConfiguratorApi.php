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
 *
 * @package FTE Usage Tracking
 */


class ConfiguratorApi extends ConfigModuleApi
{

    public function registerApiRest()
    {
        return array(
            'configurator' => array(
                'reqType' => 'GET',
                'path' => array('configurator'),
                'pathVars' => array(''),
                'method' => 'getConfig',
                'shortHelp' => 'Get Config Override content',
                'longHelp' => '',
            ),
            'configuratorSave' => array(
                'reqType' => 'POST',
                'path' => array('configurator'),
                'pathVars' => array(''),
                'method' => 'setConfig',
                'shortHelp' => 'Set Config Override content',
                'longHelp' => '',
            ),
        );
    }

    public function getConfig(ServiceBase $api, array $args)
    {
        $adminBean = BeanFactory::newBean("Administration");
        return $adminBean->getConfigForModule("fte_UsageTracking", $this->getPlatform($api->platform));
    }

    public function setConfig(ServiceBase $api, array $args)
    {
        $this->skipMetadataRefresh = true;
        $args['module'] = "fte_UsageTracking";

        return $this->configSave($api, $args);
    }
}