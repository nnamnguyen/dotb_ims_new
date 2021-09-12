<?php


namespace Dotbcrm\Dotbcrm\SearchEngine;

use Dotbcrm\Dotbcrm\SearchEngine\Engine\EngineInterface;

/**
 *
 * SearchEngine main class
 *
 */
class SearchEngine
{
    /**
     * @var \Dotbcrm\Dotbcrm\SearchEngine\SearchEngine
     */
    private static $instance;

    /**
     * @var \Dotbcrm\Dotbcrm\SearchEngine\Engine\EngineInterface
     */
    private $engine;

    /**
     * @param \Dotbcrm\Dotbcrm\SearchEngine\Engine\EngineInterface $searchEngine
     */
    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Get SearchEngine instance based on current system configuration.
     * @param string $capability Optional capability to check for
     * @throws \RuntimeException
     * @return \Dotbcrm\Dotbcrm\SearchEngine\SearchEngine
     * TODO: add ES specific exceptions
     */
    public static function getInstance($capability = null)
    {
        // Load our instance if not done so yet
        if (empty(self::$instance)) {

            $dotbConfig = \DotbConfig::getInstance();

            if (!$config = $dotbConfig->get('full_text_engine', false)) {
                throw new \RuntimeException("No search engine configured");
            }

            $configKeys = array_keys($config);
            $type = array_pop($configKeys);
            self::$instance = new self(self::newEngine($type, $config[$type]));
            self::$instance->setGlobalConfig($dotbConfig->get('search_engine', array()));
        }

        // Check for capability if requested
        if (!empty($capability) && !self::$instance->hasCapability($capability)) {
            throw new \RuntimeException("Capability '{$capability}' unavailable");
        }

        return self::$instance;
    }

    /**
     * Create SearchEngine object
     * @param string $type Engine implementation
     * @param array $config Engine configuration settings
     * @throws \RuntimeException
     * @return \Dotbcrm\Dotbcrm\SearchEngine\Engine\EngineInterface
     */
    public static function newEngine($type, array $config = array())
    {
        $type = ucfirst($type);
        $class = \DotbAutoLoader::customClass(
            sprintf('Dotbcrm\\Dotbcrm\\SearchEngine\\Engine\\%s', $type)
        );

        if (!class_exists($class)) {
            throw new \RuntimeException("SearchEngine class '$class' not found");
        }

        $engine = new $class();

        if (!$engine instanceof EngineInterface) {
            throw new \RuntimeException("SearchEngine class '$class' must implement EngineInterface");
        }

        $engine->setEngineConfig($config);

        return $engine;
    }

    /**
     * Overload method calls for implementation engine
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, array $arguments)
    {
        if (!method_exists($this->engine, $method)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid method "%s" called for SearchEngine "%s"',
                    $method,
                    get_class($this->engine)
                )
            );
        }
        return call_user_func_array(array($this->engine, $method), $arguments);
    }

    /**
     * Check given search engine supports capability
     * @param string $capability Capability interface name
     * @return boolean
     */
    public function hasCapability($capability)
    {
        $interface = sprintf(
            'Dotbcrm\Dotbcrm\SearchEngine\Capability\%s\%sCapable',
            $capability,
            $capability
        );
        return in_array($interface, class_implements($this->engine, false));
    }

    /**
     * Return the actual engine object
     * @return \Dotbcrm\Dotbcrm\SearchEngine\Engine\EngineInterface
     */
    public function getEngine()
    {
        return $this->engine;
    }
}
