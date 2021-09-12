<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping;

/**
 *
 * Mapping collection iterator
 *
 */
class MappingCollection implements \IteratorAggregate
{
    /**
     * @param array $modules Module list
     */
    public function __construct(array $modules)
    {
        foreach ($modules as $module) {
             $this->$module = new Mapping($module);
        }
    }

    /**
     * {@inheritdoc}
     * @return Mapping[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this);
    }
}
