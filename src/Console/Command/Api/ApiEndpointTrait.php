<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Api;

/**
 *
 * Trait for easy \DotbApi endpoint calls from Command
 *
 * This trait can be used to easily expose existing REST API calls as a
 * command. Note that this trait makes internal calls mimicking an actual
 * REST API call. This implementation does not make actual REST API calls.
 *
 * By default the CLI framework in instance mode will initialize a system
 * user as current user. If this is not desirable, the command can override
 * current user as it sees fit.
 *
 */
trait ApiEndpointTrait
{
    /**
     * @var \DotbApi
     */
    protected $api;

    /**
     * @var \RestService
     */
    protected $service;

    /**
     * Initialize API
     * @param \DotbApi $api
     * @return ApiEndpointTrait
     */
    protected function initApi(\DotbApi $api)
    {
        $this->api = $api;
        $this->service = $this->getService();
        return $this;
    }

    /**
     * Wrapper to call a method with arguments on given DotbApi object
     * @param string $method Method to be invoked on the public API
     * @param array $args Arguments to be passed to the public API
     */
    protected function callApi($method, array $args = array())
    {
        $args = array($this->service, $args);
        return call_user_func_array(array($this->api, $method), $args);
    }

    /**
     * Get REST service backend
     * @return \RestService
     */
    protected function getService()
    {
        return new \RestService();
    }
}
