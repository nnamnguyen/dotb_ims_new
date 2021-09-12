<?php





/**
 * Collection of beans related to the primary bean by means of multiple links
 */
class RelateCollectionDefinition extends AbstractCollectionDefinition
{
    /**
     * The key in collection definition that identifies sources
     *
     * @var string
     */
    protected static $sourcesKey = 'links';

    /**
     * Primary bean
     *
     * @var DotbBean
     */
    protected $bean;

    /**
     * Constructor
     *
     * @param DotbBean $bean Primary bean
     * @param string $name Collection name
     */
    public function __construct(DotbBean $bean, $name)
    {
        $this->bean = $bean;

        parent::__construct($name);
    }

    /** {@inheritDoc} */
    public function getSourceModuleName($source)
    {
        if (!$this->bean->load_relationship($source)) {
            throw new DotbApiExceptionError(
                $this->getErrorMessage('Unable to load link %s', array($source))
            );
        }

        $moduleName = $this->bean->$source->getRelatedModuleName();

        return $moduleName;
    }

    /** {@inheritDoc} */
    protected function loadDefinition()
    {
        $definition = $this->bean->getFieldDefinition($this->name);
        if (!is_array($definition) || !isset($definition['type']) || $definition['type'] !== 'collection') {
            throw new DotbApiExceptionNotFound('Collection not found');
        }

        return $definition;
    }

    /**
     * {@inheritDoc}
     *
     * Adds primary module name to the error message
     */
    protected function getErrorMessage($format, array $arguments)
    {
        return parent::getErrorMessage($format, $arguments) . ' in module ' . $this->bean->module_name;
    }
}
