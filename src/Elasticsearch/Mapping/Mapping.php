<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Mapping;

use Dotbcrm\Dotbcrm\Elasticsearch\Provider\ProviderCollection;
use Dotbcrm\Dotbcrm\Elasticsearch\Exception\MappingException;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldBaseProperty;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\RawProperty;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\PropertyInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\ObjectProperty;

/**
 *
 * This class builds the mapping per module (type) based on the available
 * providers.
 *
 */
class Mapping implements MappingInterface
{
    /**
     * Property name prefix separator
     * @var string
     */
    const PREFIX_SEP = '__';

    /**
     * Common prefix
     * @var string
     */
    const PREFIX_COMMON = 'Common__';

    /**
     * @var string Module name
     */
    private $module;

    /**
     * @var \DotbBean
     */
    private $bean;

    /**
     * Elasticsearch mapping properties
     * @var PropertyInterface[]
     */
    private $properties = [];

    /**
     * Base mapping used for all multi fields
     * @var array
     */
    private $multiFieldBase = [
        'type' => 'keyword',
        'index' => true,
    ];

    /**
     * Base mapping for not indexed fields
     * @var array
     */
    private $notIndexedBase = [
        'type' => 'keyword',
        'index' => false,
    ];

    /**
     * Excluded fields from _source
     * @var array
     */
    private $sourceExcludes = [];

    /**
     * @param string $module
     */
    public function __construct($module)
    {
        $this->module = $module;
    }

    /**
     * {@inheritdoc}
     */
    public function excludeFromSource($field)
    {
        $this->sourceExcludes[$field] = $field;
    }

    /**
     * {@inheritdoc}
     */
    public function getSourceExcludes()
    {
        return array_values($this->sourceExcludes);
    }

    /**
     * {@inheritdoc}
     */
    public function buildMapping(ProviderCollection $providers)
    {
        foreach ($providers as $provider) {
            $provider->buildMapping($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * {@inheritdoc}
     */
    public function getBean()
    {
        // lazy load bean
        if ($this->bean === null) {
            $this->bean = \BeanFactory::newBean($this->module);
        }
        return $this->bean;
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        $compiled = [];
        foreach ($this->properties as $field => $property) {
            $compiled[$field] = $property->getMapping();
        }
        return $compiled;
    }

    /**
     * {@inheritdoc}
     */
    public function addModuleField($baseField, $field, MultiFieldProperty $property)
    {
        $moduleField = $this->module . self::PREFIX_SEP . $baseField;
        $this->createMultiFieldBase($moduleField, $this->notIndexedBase)->addField($field, $property);
        $this->createCopyToBase($baseField, [$moduleField]);
    }

    /**
     * {@inheritdoc}
     */
    public function addCommonField($baseField, $field, MultiFieldProperty $property)
    {
        $commonField = self::PREFIX_COMMON . $baseField;
        $this->createMultiFieldBase($commonField, $this->notIndexedBase)->addField($field, $property);
        $this->createCopyToBase($baseField, [$commonField]);
    }

    /**
     * {@inheritdoc}
     */
    public function addModuleObjectProperty($field, ObjectProperty $property)
    {
        $this->addProperty($this->module . self::PREFIX_SEP . $field, $property);
    }

    /**
     * {@inheritdoc}
     */
    public function addCommonObjectProperty($field, ObjectProperty $property)
    {
        $this->addProperty(self::PREFIX_COMMON . $field, $property);
    }

    /**
     * {@inheritdoc}
     */
    public function addNotIndexedField($field, array $copyTo = [])
    {
        $this->createMultiFieldBase($field, $this->notIndexedBase, $copyTo);
    }

    /**
     * {@inheritdoc}
     */
    public function addNotAnalyzedField($field, array $copyTo = [])
    {
        $this->createMultiFieldBase($field, $this->multiFieldBase, $copyTo);
    }

    /**
     * {@inheritdoc}
     */
    public function addMultiField($baseField, $field, MultiFieldProperty $property)
    {
        $this->createMultiFieldBase($baseField, $this->multiFieldBase, [])->addField($field, $property);
    }
    
    /**
     * {@inheritdoc}
     */
    public function addObjectProperty($field, ObjectProperty $property)
    {
        $this->addProperty($field, $property);
    }

    /**
     * {@inheritdoc}
     */
    public function addRawProperty($field, RawProperty $property)
    {
        $this->addProperty($field, $property);
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty($field)
    {
        return isset($this->properties[$field]);
    }

    /**
     * {@inheritdoc}
     */
    public function getProperty($field)
    {
        if ($this->hasProperty($field)) {
            return $this->properties[$field];
        }
        throw new MappingException("Trying to get non-existing property '{$field}' for '{$this->module}'");
    }

    /**
     * Create base multi field object for given field. If the field already
     * exists we use the one which is present and only apply the copyTo fields
     * on top of the already existing one.
     *
     * @param string $field
     * @param array $mapping Mapping to apply on base field
     * @param array $copyTo Optional copy_to definition
     * @throws MappingException
     * @return MultiFieldBaseProperty
     */
    private function createMultiFieldBase($field, array $mapping, array $copyTo = [])
    {
        // create multi field base if not set yet
        if (!$this->hasProperty($field)) {
            $property = new MultiFieldBaseProperty();
            $property->setMapping($mapping);
            $this->addRawProperty($field, $property);
        }

        // make sure we have a base multi field
        $property = $this->getProperty($field);
        if (!$property instanceof MultiFieldBaseProperty) {
            throw new MappingException("Field '{$field}' is not a multi field");
        }

        // append copy_to definitions
        foreach ($copyTo as $copyToField) {
            $property->addCopyTo($copyToField);
        }

        return $property;
    }

    /**
     * Create primary base field for indexing and _source purpose
     * copying the values into the given target field
     * @param string $field The primary field name
     * @param string[] $targetFields Array of target fields
     */
    private function createCopyToBase($field, array $targetFields = [])
    {
        $this->createMultiFieldBase($field, $this->notIndexedBase, $targetFields);
    }

    /**
     * Low level wrapper to add mapping properties
     *
     * @param string $field
     * @param PropertyInterface $property
     * @throws MappingException
     */
    private function addProperty($field, PropertyInterface $property)
    {
        if (isset($this->properties[$field])) {
            throw new MappingException("Cannot redeclare field '{$field}' for module '{$this->module}'");
        }
        $this->properties[$field] = $property;
    }
}
