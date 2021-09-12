<?php


/**
 * Metric Manager class
 *
 * Provides basic interface to work with Metric Providers such as Newrelic provider
 * All configuration should be done in Config/providers.php file
 * or initialize method should be called with config array
 */
class DotbMetric_Manager
{
    /**
     * @var DotbMetric_Provider_Interface[]
     */
    protected $metricProviders = array();

    /**
     * @var DotbMetric_Manager
     */
    protected static $instance = null;

    /**
     * Transaction naming state
     *
     * @var bool
     */
    protected $transactionNamed = false;

    /**
     * Singleton constructor
     */
    protected function __construct()
    {
        global $dotb_config;

        // Check metrics is enabled in configuration
        if (empty($dotb_config['metrics_enabled'])) {
            return $this;
        }

        if (isset($dotb_config['metric_providers'])) {
            foreach ($dotb_config['metric_providers'] as $name => $path) {

                // Could not use DotbAutoLoader there, because in case of
                // entryPoint=getYUIComboFile script do not loads DotbAutoLoader
                if (file_exists($path)) {
                    require_once $path;

                    $additionalConfig = isset($dotb_config['metric_settings'][$name])
                        ? $dotb_config['metric_settings'][$name]
                        : array();

                    /** @var DotbMetric_Provider_Interface $metric  */
                    $metric = new $name($additionalConfig);

                    if ($metric->isLoaded()) {
                        $this->registerMetricProvider($name, $metric);
                    }
                }
            }
        }
    }

    /**
     * Deny cloning Singleton
     */
    protected function __clone()
    {

    }

    /**
     * Singleton initialization
     *
     * @return DotbMetric_Manager
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DotbMetric_Manager();
        }

        return self::$instance;
    }


    /**
     * Register Metric Provider as listener
     *
     * @param string $name
     * @param DotbMetric_Provider_Interface $metricProvider
     * @return DotbMetric_Manager
     */
    public function registerMetricProvider($name, DotbMetric_Provider_Interface $metricProvider)
    {
        if (!isset($this->metricProviders[$name])) {
            $this->metricProviders[$name] = $metricProvider;
        }

        return $this;
    }

    /**
     * Return registered Metric Providers
     *
     * @return DotbMetric_Provider_Interface[]
     */
    public function getMetricProviders()
    {
        return $this->metricProviders;
    }

    /**
     * Set up a name for current transaction
     *
     * @param string $name
     * @return DotbMetric_Manager
     */
    public function setTransactionName($name = '')
    {
        foreach ($this->metricProviders as $provider) {
            $provider->setTransactionName($name);
        }

        $this->transactionNamed = true;

        return $this;
    }

    /**
     * Returns transaction naming state
     *
     * @return bool
     */
    public function isNamedTransaction()
    {
        return $this->transactionNamed;
    }

    /**
     * Set current transaction as background
     *
     * @param string $name class metrics job name (f.e. "background", "massupdate")
     * @return DotbMetric_Manager
     */
    public function setMetricClass($name)
    {
        foreach ($this->metricProviders as $provider) {
            $provider->setMetricClass($name);
        }

        return $this;
    }

    /**
     * Add params to current transaction stack trace
     *
     * @param string $name
     * @param mixed $value
     * @return DotbMetric_Manager
     */
    public function addTransactionParam($name, $value)
    {
        foreach ($this->metricProviders as $provider) {
            $provider->addTransactionParam($name, $value);
        }

        return $this;
    }

    /**
     * Send exception trace to providers
     *
     * @param Exception $exception
     */
    public function handleException($exception)
    {
        foreach ($this->metricProviders as $provider) {
            $provider->handleException($exception);
        }
    }

}
