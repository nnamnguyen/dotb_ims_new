<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property;

/**
 *
 * Raw properties are possible but are very exceptional. Use this object
 * with caution when needed. Mostly other higher level mapping objects are
 * more appropriate to use. Use this as a last resort if nothing of the
 * other mapping properties fit your use case.
 *
 */
class RawProperty implements PropertyInterface
{
    /**
     * @var array Mapping definition
     */
    protected $mapping = array();

    /**
     * {@inheritdoc}
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * {@inheritdoc}
     */
    public function setMapping(array $mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * {@inheritdoc}
     */
    public function addCopyTo($field)
    {
        // initialize copy_to parameter if not set
        if (!isset($this->mapping['copy_to'])) {
            $this->mapping['copy_to'] = array();
        }

        // avoid duplicates just in case
        if (!in_array($field, $this->mapping['copy_to'])) {
            $this->mapping['copy_to'][] = $field;
        }
    }
}
