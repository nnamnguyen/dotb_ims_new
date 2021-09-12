<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Index;

use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Index;
use Dotbcrm\Dotbcrm\Elasticsearch\Container;

/**
 *
 * Index collection iterator
 *
 * The index names (keys) used by the iterator are NOT prefixed. The
 * prefixing is performed directly on the underlaying Index objects and
 * are not exposed to higher up levels.
 *
 */
class IndexCollection implements \IteratorAggregate
{
    /**
     * @var \Dotbcrm\Dotbcrm\Elasticsearch\Container
     */
    protected $container;

    /**
     * Ctor
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     * @return Index[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this);
    }

    /**
     * Add index to the pool
     * @param string $index Index name
     * @return \Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Index
     */
    public function addIndex($index)
    {
        if (!isset($this->$index)) {
            $normalized = $this->container->indexPool->normalizeIndexName($index);
            $this->$index = $this->newIndexObject($normalized);
            $this->$index->setBaseName($index);
        }
        return $this->$index;
    }

    /**
     * Add list of indices to the pool
     * @param array $indices
     */
    public function addIndices(array $indices)
    {
        foreach ($indices as $index) {
            $this->addIndex($index);
        }
    }

    /**
     * Add a new type to the given indices
     * @param array $indices List of index names
     * @param string $type Type (module name)
     */
    public function addType(array $indices, $type)
    {
        foreach ($indices as $index) {
            $this->addIndex($index)->addType($type);
        }
    }

    /**
     * Set analysis settings. Currently all analysis settings are shared among
     * all the different indices which are created by the IndexPool. This has
     * no negative effect on performance and makes it easier to keep the
     * different analysis settings in sync.
     *
     * @param string $index Index name
     * @param array $analysis
     */
    public function addAnalysis($index, array $analysis)
    {
        $this->addIndex($index)->setAnalysis($analysis);
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
