<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Index\Strategy;

/**
 *
 * Abstract Strategy
 *
 */
abstract class AbstractStrategy implements StrategyInterface
{
    /**
     * @var array Strategy configuration parameters
     */
    protected $config = array();

    /**
     * @var string Identifier
     */
    protected $identifier;

    /**
     * {@inheritdoc}
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Helper to get module specific configuration
     * @param string $module
     * @param string $key Config key to retrieve
     * @param mixed $default Default value if config key is not found
     * @return mixed
     */
    protected function getModuleConfig($module, $key, $default = null)
    {
        return (isset($this->config[$module][$key])) ? $this->config[$module][$key] : $default;
    }
}
