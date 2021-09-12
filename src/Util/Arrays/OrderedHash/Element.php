<?php


namespace Dotbcrm\Dotbcrm\Util\Arrays\OrderedHash;

/**
 * Class Element
 * @package Dotbcrm\Dotbcrm\Util\Arrays\OrderedHash
 *
 * This class represents a key-value pair in an {@see OrderedHash}.
 */
class Element
{
    /**
     * @var string|int
     *
     * The key by which the element is referenced.
     */
    protected $key;

    /**
     * @var mixed
     *
     * The value stored under the key.
     */
    protected $value;

    /**
     * @var null|Element
     *
     * Points to the preceding element in an {@see OrderedHash}.
     */
    protected $before;

    /**
     * @var null|Element
     *
     * Points to the following element in an {@see OrderedHash}.
     */
    protected $after;

    /**
     * An element is identifiable by it's key, which is unique within a hash. It's value is the data accessed by its
     * key.
     *
     * @param string|int $key
     * @param mixed $value
     */
    public function __construct($key, $value)
    {
        $this->setKey($key);
        $this->setValue($value);
    }

    /**
     * Sets the pointer to the element that precedes this element.
     *
     * @param null|Element $element
     */
    public function setBefore($element)
    {
        $this->before = $element;
    }

    /**
     * Returns the element that precedes this element.
     *
     * @return null|Element
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * Sets the pointer to the element that follows this element.
     *
     * @param null|Element $element
     */
    public function setAfter($element)
    {
        $this->after = $element;
    }

    /**
     * Returns the element that follows this element.
     *
     * @return null|Element
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * Sets the element's key.
     *
     * @param string|int $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Returns the element's key.
     *
     * @return string|int
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets the element's value.
     *
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the element's value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
