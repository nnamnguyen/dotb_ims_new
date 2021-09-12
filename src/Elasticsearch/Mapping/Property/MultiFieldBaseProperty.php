<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property;

use Dotbcrm\Dotbcrm\Elasticsearch\Exception\MappingException;

/**
 *
 * This mapping property handles the primary field for a multi field setup.
 * Additional fields can be added on top of this object using the
 * MultiFieldProperty.
 *
 */
class MultiFieldBaseProperty extends RawProperty implements PropertyInterface
{
    /**
     * Base mapping
     * {@inheritdoc}
     */
    protected $mapping = array(
        'type' => 'keyword',
        'index' => false,
    );

    /**
     * Multi field properties
     * @var array
     */
    protected $fields = array();

    /**
     * {@inheritdoc}
     */
    public function getMapping()
    {
        $mapping = $this->mapping;

        // Only add fields if any are set
        if (!empty($this->fields)) {
            $mapping['fields'] = $this->fields;
        }

        return $mapping;
    }

    /**
     * Add multi field property
     * @param string $name
     * @param MultiFieldProperty $property
     * @throws MappingException
     */
    public function addField($name, MultiFieldProperty $property)
    {
        if (isset($this->fields[$name])) {
            throw new MappingException("Field '{$name}' already exists as multi field");
        }
        $this->fields[$name] = $property->getMapping();
    }
}
