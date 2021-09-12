<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property;

/**
 *
 * Geo point property.
 *
 */
class GeoProperty extends RawProperty implements PropertyInterface
{
    /**
     * @var string
     */
    protected $type = 'geo_point';

    /**
     * Field data settings
     * @var array
     */
    protected $fieldData = array();

    /**
     * {@inheritdoc}
     */
    public function getMapping()
    {
        // base mapping
        $mapping = array_merge(
            $this->mapping,
            array(
                'type' => $this->type,
            )
        );

        // field data
        if (!empty($this->fieldData)) {
            $mapping['fielddata'] = $this->fieldData;
        }

        return $mapping;
    }

    /**
     * Set field data
     * @param array $fieldData
     */
    public function setFieldData(array $fieldData)
    {
        $this->fieldData = $fieldData;
    }
}
