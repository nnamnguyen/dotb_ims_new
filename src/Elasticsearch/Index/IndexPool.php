<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Index;

use Dotbcrm\Dotbcrm\Elasticsearch\Index\Strategy\OneModulePerIndexStrategy;
use Dotbcrm\Dotbcrm\Elasticsearch\Index\Strategy\StaticStrategy;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\MappingCollection;
use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Index;
use Dotbcrm\Dotbcrm\Elasticsearch\Exception\IndexPoolStrategyException;
use Dotbcrm\Dotbcrm\Elasticsearch\Container;
use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Client;

/**
 *
 * Wrapper class to manage different indices. Every module can have one or
 * more indices assigned. The logic resides in the strategy classes. This
 * class manages the link between modules and indices. All index objects
 * needed have to be requested through this class.
 *
 */
class IndexPool
{
    const DEFAULT_STRATEGY = 'static';
    const SINGLE_MODULE_STRATEGY = 'single';

    const MAX_ES_INDEX_NAME = 255;

    /**
     * @var string Prefix for every index
     */
    protected $prefix;

    /**
     * @var array Configuration parameters
     */
    protected $config;

    /**
     * @var \Dotbcrm\Dotbcrm\Elasticsearch\Container
     */
    protected $container;

    /**
     * Loaded strategies
     * @var \Dotbcrm\Dotbcrm\Elasticsearch\Index\Strategy\StrategyInterface[]
     */
    protected $loaded = array();

    /**
     * Registered strategies
     * @var array
     */
    protected $strategies = array();

    /**
     * @param string $prefix Index prefix
     * @param array $config
     */
    public function __construct($prefix, array $config, Container $container)
    {
        $this->prefix = $prefix;
        $this->config = $config;
        $this->container = $container;
        $this->registerStrategies();
    }

    /**
     * Build index collection for given mapping
     * @param MappingCollection $mappings
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Index\IndexCollection
     */
    public function buildIndexCollection(MappingCollection $mappings)
    {
        $collection = new IndexCollection($this->container);

        foreach ($mappings as $mapping) {
            /* @var Mapping $mapping */
            $module = $mapping->getModule();
            $indices = $this->getStrategy($module)->getManagedIndices($module);
            $collection->addType($indices, $module);
        }

        return $collection;
    }

    /**
     * Normalize index name and add prefix. The normalized named is only
     * referenced in the underlaying \Elastica\Index objects. Index name
     * access should always be resolved against the non-prefixed format.
     *
     * @param string $name Index name
     * @return string
     */
    public function normalizeIndexName($name)
    {
        if (!empty($this->prefix)) {
            $name = $this->prefix . '_' . $name;
        }

        if (strlen($name) > self::MAX_ES_INDEX_NAME) {
            $name = substr($name, 0, self::MAX_ES_INDEX_NAME - 1);
        }
        // only lowercase index names are allowed
        return strtolower($name);
    }

    /**
     * Get strategy object for given module
     * @param string $module Module name
     * @throws \Dotbcrm\Dotbcrm\Elasticsearch\Exception\IndexPoolStrategyException
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Index\Strategy\StrategyInterface
     */
    public function getStrategy($module)
    {
        // take strategy identifier from config or use default if not available
        // for ES 6.x, it requires to use OneModulePerIndexStrategy strategy

        if (!empty($this->config[$module]) && !empty($this->config[$module]['strategy'])) {
            $id = $this->config[$module]['strategy'];
        } else {
            if (version_compare($this->container->client->getVersion(), '6.0', '<')) {
                $id = self::DEFAULT_STRATEGY;
            } else {
                $id = self::SINGLE_MODULE_STRATEGY;
            }
        }

        if (!isset($this->loaded[$id])) {

            if (!isset($this->strategies[$id])) {
                throw new IndexPoolStrategyException("Unknown strategy identifier '$id'");
            }

            $className = $this->strategies[$id];
            if (!class_exists($className)) {
                throw new IndexPoolStrategyException("Invalid strategy '$id' for module '$module'");
            }

            // create strategy object and pass index_strategy config
            $this->loaded[$id] = $strategy = new $className();
            $strategy->setConfig($this->config);
            $strategy->setIdentifier($id);
        }

        return $this->loaded[$id];
    }

    /**
     * Get list of available read indices for given modules
     * @param array $modules
     * @param array $context
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Index\IndexCollection
     */
    public function getReadIndices(array $modules, array $context = array())
    {
        $collection = new IndexCollection($this->container);
        foreach ($modules as $module) {
            $indices = $this->getStrategy($module)->getReadIndices($module, $context);
            $collection->addIndices($indices);
        }
        return $collection;
    }

    /**
     * Get list of managed indices for given modules
     * @param array $modules
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Index\IndexCollection
     */
    public function getManagedIndices(array $modules)
    {
        $collection = new IndexCollection($this->container);
        foreach ($modules as $module) {
            $indices = $this->getStrategy($module)->getManagedIndices($module);
            $collection->addIndices($indices);
        }
        return $collection;
    }

    /**
     * Get write index for given module. There can only be one write index at
     * any given time for a module.
     * @param string $module
     * @param array $context
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Index
     */
    public function getWriteIndex($module, array $context = array())
    {
        $index = $this->getStrategy($module)->getWriteIndex($module, $context);
        $normalized = $this->normalizeIndexName($index);
        return $this->newIndexObject($normalized);
    }

    /**
     * Add strategy to registry
     * @param string $identifier
     * @param string $className Class implementing StrategyInterface
     */
    public function addStrategy($identifier, $className)
    {
        $this->strategies[$identifier] = $className;
    }

    /**
     * Register available strategies
     */
    protected function registerStrategies()
    {
        $this->addStrategy(self::DEFAULT_STRATEGY, StaticStrategy::class);
        $this->addStrategy(self::SINGLE_MODULE_STRATEGY, OneModulePerIndexStrategy::class);
    }

    /**
     * Get index object
     * @param string $indexName Index name
     * @param Client $client Optional client
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Index
     */
    protected function newIndexObject($name, Client $client = null)
    {
        $client = $client ?: $this->container->client;
        return new Index($client, $name);
    }
}
