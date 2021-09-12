<?php


namespace Dotbcrm\Dotbcrm\SearchEngine\Engine;

use Dotbcrm\Dotbcrm\Elasticsearch\Container;
use Dotbcrm\Dotbcrm\SearchEngine\Capability\GlobalSearch\GlobalSearchCapable;
use Dotbcrm\Dotbcrm\SearchEngine\Capability\Aggregation\AggregationCapable;

/**
 *
 * Elasticsearch engine
 *
 */
class Elastic implements
    EngineInterface,
    GlobalSearchCapable,
    AggregationCapable
{
    /**
     * @var \Dotbcrm\Dotbcrm\Elasticsearch\Container
     */
    protected $container;

    /**
     * @param \Dotbcrm\Dotbcrm\Elasticsearch\Container $container
     */
    public function __construct(Container $container = null)
    {
        $this->container = $container ?: Container::getInstance();
    }

    //// BASE INTERFACE ////

    /**
     * {@inheritdoc}
     */
    public function getMetaDataHelper()
    {
        return $this->container->metaDataHelper;
    }

    /**
     * {@inheritDoc}
     */
    public function setEngineConfig(array $config)
    {
        $this->container->setConfig('engine', $config);
    }

    /**
     * {@inheritDoc}
     */
    public function getEngineConfig()
    {
        return $this->container->getConfig('engine');
    }

    /**
     * {@inheritDoc}
     */
    public function setGlobalConfig(array $config)
    {
        $this->container->setConfig('global', $config);
    }

    /**
     * {@inheritDoc}
     */
    public function getGlobalConfig()
    {
        return $this->container->getConfig('global');
    }

    /**
     * {@inheritDoc}
     */
    public function isAvailable($force = false)
    {
        return $this->container->client->isAvailable($force);
    }

    /**
     * {@inheritDoc}
     */
    public function verifyConnectivity($updateAvailability = true)
    {
        return $this->container->client->verifyConnectivity($updateAvailability);
    }

    /**
     * {@inheritDoc}
     */
    public function scheduleIndexing(array $modules = array(), $clearData = false)
    {
        return $this->container->indexManager->scheduleIndexing($modules, $clearData);
    }

    /**
     * {@inheritDoc}
     */
    public function addMappings(array $modules = array())
    {
        return $this->container->indexManager->addMappings($modules);
    }

    /**
     * {@inheritDoc}
     */
    public function indexBean(\DotbBean $bean, array $options = array())
    {
        $this->container->indexer->indexBean($bean);
    }

    /**
     * {@inheritDoc}
     */
    public function runFullReindex($clearData = false)
    {
        $this->scheduleIndexing(array(), $clearData);
        $this->container->queueManager->consumeQueue();
    }

    /**
     * {@inheritDoc}
     */
    public function setForceAsyncIndex($toggle)
    {
        $this->container->indexer->setForceAsyncIndex($toggle);
    }

    /**
     * {@inheritDoc}
     */
    public function setDisableIndexing($toggle)
    {
        $this->container->indexer->setDisable($toggle);
    }

    //// GLOBALSEARCH CAPABILITY /////

    /**
     * {@inheritDoc}
     */
    public function search()
    {
        return $this->gsProvider()->search();
    }

    /**
     * {@inheritDoc}
     */
    public function searchTags()
    {
        return $this->gsProvider()->searchTags();
    }

    /**
     * {@inheritDoc}
     */
    public function term($term)
    {
        $this->gsProvider()->term($term);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function from(array $modules = array())
    {
        $this->gsProvider()->from($modules);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTags($getTags)
    {
        $this->gsProvider()->getTags($getTags);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setTagLimit($tagLimit)
    {
        $this->gsProvider()->setTagLimit($tagLimit);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setFilters($filters)
    {
        $this->gsProvider()->setFilters($filters);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function limit($limit)
    {
        $this->gsProvider()->limit($limit);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function offset($offset)
    {
        $this->gsProvider()->offset($offset);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function highlighter($toggle)
    {
        $this->gsProvider()->useHighlighter($toggle);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function fieldBoost($toggle)
    {
        $this->gsProvider()->fieldBoost($toggle);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function sort(array $fields)
    {
        $this->gsProvider()->sort($fields);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStudioSupportedTypes()
    {
        return $this->gsProvider()->getStudioSupportedTypes();
    }

    //// AGGREGATION CAPABILITY ////

    /**
     * {@inheritdoc}
     */
    public function queryCrossModuleAggs($toggle)
    {
        $this->gsProvider()->queryCrossModuleAggs($toggle);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function queryModuleAggs(array $modules)
    {
        $this->gsProvider()->queryModuleAggs($modules);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function aggFilters(array $filters)
    {
        $this->gsProvider()->aggFilters($filters);
    }

    //// ELASTIC ENGINE SPECIFIC ////

    /**
     * Get Elastic service container
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\GlobalSearch
     */
    protected function gsProvider()
    {
        return $this->container->getProvider('GlobalSearch');
    }
}
