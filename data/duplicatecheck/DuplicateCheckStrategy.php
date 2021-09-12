<?php


/**
 * Base class for duplicate check strategy implementations
 * @abstract
 * @api
 */
abstract class DuplicateCheckStrategy
{
    /**
     * Parent bean
     * @var DotbBean
     */
    protected $bean;

    /**
     * @param DotbBean $bean
     * @param array $metadata
     */
    public function __construct($bean, $metadata)
    {
        $this->bean = $bean;
        $this->setMetadata($metadata);
    }

    /**
     * Parse the provided metadata into appropriate protected properties
     *
     * @abstract
     * @access protected
     */
    abstract protected function setMetadata($metadata);

    /**
     * Finds possible duplicate records for a given set of field data.
     *
     * @abstract
     * @access public
     */
    abstract public function findDuplicates();
}