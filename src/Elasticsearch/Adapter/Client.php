<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Adapter;

use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;
use Dotbcrm\Dotbcrm\Elasticsearch\Exception\ConnectionException;
use Elastica\Client as BaseClient;
use Elastica\Connection;
use Elastica\Request;
use Psr\Log\LoggerInterface;

/**
 *
 * Adapter class for \Elastica\Client
 *
 */
class Client extends BaseClient
{
    /**
     * Administration config settings
     */
    const STATUS_CATEGORY = 'info';
    const STATUS_KEY = 'fts_down';

    /**
     * Connection status
     */
    const CONN_SUCCESS = 1;
    const CONN_ERROR = -1;
    const CONN_VERSION_NOT_SUPPORTED = -2;
    const CONN_NO_VERSION_AVAILABLE = -3;
    const CONN_FAILURE = -99;

    /**
     * User-agent settings
     */
    const USER_AGENT = 'DotBCRM';
    const VERSION_UNKNOWN = 'unknown';

    /**
     * @var string, current installed elastic version
     */
    protected $version;

    /**
     * Return allowed versions array
     * @var array
     */
    protected $allowedVersions = array(
        '5.4',
        '5.6',
        '6.x',
    );

    /**
     * supported ES versions
     * @var array
     */
    protected static $supportedVersions = array(
        array('version' =>'5.4', 'operator' => '>='),
        array('version' => '7.0', 'operator' => '<'),
    );

    /**
     * List of supported $dotb_config Elastic configuration options
     * @see \Elastica\Client::$_config
     */
    protected $connAllowedConfig = array(
        'host',
        'port',
        'path',
        'transport',
        'timeout',
        'curl',
        'headers',
        'url',
        'persistent',
        'aws_access_key_id',
        'aws_secret_access_key',
        'aws_session_token',
        'aws_region',
    );

    /**
     * @var \Dotbcrm\Dotbcrm\Elasticsearch\Logger
     */
    protected $_logger;

    /**
     * @var boolean Elasticsearch backend availability
     */
    protected $available;

    /**
     * Ctor
     * @param array $config Connection configuration from `$dotb_config`
     */
    public function __construct(array $config, LoggerInterface $logger)
    {
        $this->setLogger($logger);
        $config = $this->parseConfig($config);
        parent::__construct($config, array($this, 'onConnectionFailure'), $logger);
    }

    /**
     * @return string elasticsearch version
     * @throws \Exception
     */
    public function getVersion() : string
    {
        if (empty($this->version)) {
            $result = $this->ping();
            if ($result->isOk()) {
                $data = $result->getData();
                $this->version = $data['version']['number']?? null;
            }
        }

        if (empty($this->version)) {
            $this->_logger->critical("Elasticsearch: not able to get ES version");
            throw new \Exception('Elasticsearch: not able to get ES version');
        }
        return $this->version;
    }

    /**
     * Check if Elasticsearch is available. Note that the availability state
     * is based on a cached value saved in config table for 'info_fts_down'.
     * Once declared unavailable only the cron execution will be able to lift
     * it and promote the connection back to available.
     *
     * @return boolean
     */
    public function isAvailable($force = false)
    {
        // To avoid incorrectly declaring the connection down because of
        // indexing timeouts, only check and use the availability when forced
        if ($force) {
            $this->verifyConnectivity();
            return $this->loadAvailability();
        }

        // When not forced to check, assume the connection is available
        return true;
    }

    /**
     * Check the data response to determine status.
     * @param $data string the data response
     * @return string
     */
    protected function processDataResponse($data)
    {
        if (empty($data['version']['number'])) {
            $status = self::CONN_NO_VERSION_AVAILABLE;
            $this->_logger->critical("Elasticsearch verify conn: No valid version string available");
        } else {
            $this->version = $data['version']['number'];
            if ($this->checkEsVersion($this->version)) {
                $status = self::CONN_SUCCESS;
            } else {
                $status = self::CONN_VERSION_NOT_SUPPORTED;
                $this->_logger->critical("Elasticsearch verify conn: Unsupported Elasticsearch version");
            }
        }
        return $status;
    }

    /**
     * This call will *always* try to create a connection to the Elasticsearch
     * backend to determine its availability. This should basically only be
     * called during install/upgrade and the search admin section. The usage
     * of `$this->isAvailable` is preferred.
     *
     * @param boolean $updateAvailability, Update cached availability flag
     * @return integer Connection status, see declared CONN_ constants
     */
    public function verifyConnectivity($updateAvailability = true)
    {
        try {
            $result = $this->ping();
            if ($result->isOk()) {
                $data = $result->getData();
                $status = $this->processDataResponse($data);
            } else {
                $status = self::CONN_ERROR;
                $this->_logger->critical("Elasticsearch verify conn: No valid return code ({$result->getStatus()})");
            }
        } catch (\Exception $e) {
            $status = self::CONN_FAILURE;
            $this->_logger->critical("Elasticsearch verify conn: failure");
        }

        if ($updateAvailability) {
            $availability = ($status > 0) ? true : false;
            $this->updateAvailability($availability);
        }

        return $status;
    }

    /**
     * Handle connection pool failures. At this point we don't flag the backend
     * as unavailable as there may be multiple connections. In case all
     * connections from the pool are exhausted a ConnectionException will be
     * thrown further down the pipe triggering the backend as unavailable.
     *
     * Will be more useful when we support multiple connection to the backend.
     *
     * @param \Elastica\Connection $conn
     * @param \Exception $e
     * @param \Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Client $client
     */
    public function onConnectionFailure(Connection $conn, \Exception $e, Client $client)
    {
        $msg = sprintf(
            "Elasticsearch: connection went away to %s:%s",
            $conn->getHost(),
            $conn->getPort()
        );
        $this->_logger->critical($msg);
    }

    /**
     * Send generic ping to backend
     * @return \Elastica\Response
     */
    protected function ping()
    {
        return parent::request('', Request::GET);
    }

    /**
     * Verify if Elasticsearch version meets the supported list. In developer
     * mode only the minumum version applies.
     * @param array $version Elasticsearch version array
     * @return boolean
     */
    protected function checkEsVersion($version)
    {
        $result = true;
        // verify supported versions
        foreach (self::$supportedVersions as $check) {
            $result = $result && version_compare($version, $check['version'], $check['operator']);
        }
        return $result;
    }

    /**
     * Return array of allowed ES versions
     * @return array
     */
    public function getAllowedVersions()
    {
        return $this->allowedVersions;
    }

    /**
     * Update new persistent status
     * @param boolean $status True if available, false if not
     * @return boolean
     */
    protected function updateAvailability($status)
    {
        $currentStatus = $this->loadAvailability();

        if ($status !== $currentStatus) {
            $this->saveAdminStatus($status);
            $this->available = $status;
            if ($status) {
                $this->_logger->info("Elasticsearch promoted as available");
            } else {
                $this->_logger->critical("Elasticsearch no longer available");
            }
        }
        return $status;
    }

    /**
     * save status for Administration
     * @param boolean $status
     */
    protected function saveAdminStatus($status)
    {
        $admin = \BeanFactory::getBean('Administration');
        $admin->saveSetting(self::STATUS_CATEGORY, self::STATUS_KEY, ($status ? 0 : 1));
    }

    /**
     * Load the current availability
     * @return boolean
     */
    protected function loadAvailability()
    {
        if ($this->available === null) {
            $this->available = $this->isSearchEngineAvailable();
        }
        return $this->available;
    }

    /**
     * check if search engine is available using
     * Administration settings for key=info_fts_down
     * @return boolean
     */
    protected function isSearchEngineAvailable()
    {
        $settings = \Administration::getSettings();
        return empty($settings->settings['info_fts_down']);
    }

    /**
     * Build connection configuration from $dotb_config format
     * @param array $config `$dotb_config['full_text_search']`
     * @return array
     */
    protected function parseConfig(array $config)
    {
        // Currently only one connection is supported. This might be extended
        // in the future being able to use multiple connections and/or having
        // a split between search endpoints and index endpoints.
        $connection = array();
        foreach ($config as $k => $v) {
            if (in_array($k, $this->connAllowedConfig)) {
                $connection[$k] = $v;
            }
        }

        // Force the user-agent header to match DotBCRM's version
        $connection['curl'][CURLOPT_USERAGENT] = self::USER_AGENT . '/' . $this->getDotbVersion();

        return array('connections' => array($connection));
    }

    /**
     * Override request taking logging into our own hands. This will be removed
     * when the logging capabilities in Elastica are cleaned up:
     * https://github.com/ruflin/Elastica/issues/712
     * https://github.com/ruflin/Elastica/issues/482
     *
     * {@inheritdoc}
     *
     * @throws \Exception
     * @throws \Dotbcrm\Dotbcrm\Elasticsearch\Exception\ConnectionException
     */
    public function request($path, $method = Request::GET, $data = array(), array $query = array(), $contentType = Request::DEFAULT_CONTENT_TYPE)
    {
        // Enforce cached availability
        if (!$this->isAvailable()) {
            throw new \Exception('Elasticsearch not available');
        }

        try {
            $response = parent::request($path, $method, $data, $query);

            // Handle HTTP 502 Bad Gateway

            // In case a reverse proxy is sitting in between dotb and Elastic
            // it must generate an HTTP 502 in case Elastic goes down. If this
            // happens we declare the backend as unavailable as well just like
            // we do if we encouter a connection failure.
            // Note that this handling should be directly handled by Elastica
            // instead as we are escaping from the ConnectionPool here and not
            // retrying any other connections. For the current implementation
            // this is okay as DotBCRM only supports one single connection at
            // the moment.

            if ($response->getStatus() === 502) {
                throw new \Elastica\Exception\ConnectionException('HTTP 502 Bad gateway');
            }

            $this->_logger->onRequestSuccess($this->_lastRequest, $this->_lastResponse);

        } catch (\Exception $e) {
            $this->_logger->onRequestFailure($this->getConnection(), $e, $path, $method, $data);

            // On connection issues flag Elasticsearch as unavailable
            if ($e instanceof \Elastica\Exception\ConnectionException) {
                $this->updateAvailability(false);
                throw new ConnectionException($e->getMessage(), $e->getCode(), $e);
            }

            // Let is pass
            throw $e;
        }

        return $response;
    }

    /**
     * Override logging capabilities.
     * {@inheritdoc}
     */
    protected function _log($context)
    {
        return;
    }

    /**
     * Get dotb version number, returns "unknown" if not available.
     * @return string
     */
    protected function getDotbVersion()
    {
        return empty($GLOBALS['dotb_version']) ? self::VERSION_UNKNOWN : $GLOBALS['dotb_version'];
    }
}
