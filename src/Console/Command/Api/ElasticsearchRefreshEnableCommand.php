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

namespace Dotbcrm\Dotbcrm\Console\Command\Api;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use AdministrationApi;
use RestService;
use DotbApi;

require_once 'modules/Administration/clients/base/api/AdministrationApi.php';

/**
 *
 * Elasticsearch index refresh trigger
 *
 */
class ElasticsearchRefreshEnableCommand extends Command implements InstanceModeInterface
{
    // Not using trait until we have PHP 5.4 minimum support
    //use ApiEndpointTrait;

    // START TRAIT
    /**
     * @var DotbApi
     */
    protected $api;

    /**
     * @var RestService
     */
    protected $service;

    /**
     * Initialize API
     * @param DotbApi $api
     * @return ApiEndpointTrait
     * @codeCoverageIgnore
     */
    protected function initApi(DotbApi $api)
    {
        $this->api = $api;
        $this->service = $this->getService();
        return $this;
    }

    /**
     * Wrapper to call a method with arguments on given DotbApi object
     * @param string $method Method to be invoked on the public API
     * @param array $args Arguments to be passed to the public API
     * @codeCoverageIgnore
     */
    protected function callApi($method, array $args = array())
    {
        $args = array($this->service, $args);
        return call_user_func_array(array($this->api, $method), $args);
    }

    /**
     * Get REST service backend
     * @return RestService
     * @codeCoverageIgnore
     */
    protected function getService()
    {
        return new RestService();
    }
    // END TRAIT

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('elastic:refresh_enable')
            ->setDescription('Enable refresh on all indices')
        ;
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this
            ->initApi($this->getApi())
            ->callApi('elasticSearchRefreshEnable', array())
        ;

        $table = new Table($output);
        $table->setHeaders(array('Index', 'Status'));

        if ($result) {
            foreach ($result as $index => $status) {
                if ($status == '200') {
                    $status = '<info>ok</info>';
                } else {
                    $status = sprintf('<error>%s</error>', $status);
                }
                $table->addRow(array($index, $status));
            }
        }

        $table->render();
    }

    /**
     * @return AdministrationApi
     */
    protected function getApi()
    {
        return new AdministrationApi();
    }
}