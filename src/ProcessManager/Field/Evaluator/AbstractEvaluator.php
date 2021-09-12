<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Field evaluator abstract class
 * @package ProcessManager
 */
abstract class AbstractEvaluator
{
    /**
     * DotbBean object
     * @var DotbBean
     */
    protected $bean;

    /**
     * The name of the field being evaluated
     * @var string
     */
    protected $name;

    /**
     * Data array used for various functions
     * @var array
     */
    protected $data;

    /**
     * Sets properties onto the evaluator object
     * @param DotbBean $bean The bean being used for evaluation
     * @param string $name Name of the field being evaluated
     * @param array $data Data used in various functions
     */
    public function init(\DotbBean $bean, $name, array $data)
    {
        $this->setBean($bean);
        $this->setName($name);
        $this->setData($data);
    }

    /**
     * Sets a bean onto this object
     * @param DotbBean $bean The bean being used for evaluation
     */
    public function setBean(\DotbBean $bean)
    {
        $this->bean = $bean;
    }

    /**
     * Gets the bean that is set on this object
     * @return DotbBean
     */
    public function getBean()
    {
        return $this->bean;
    }

    /**
     * Sets the name of the field used for evaluation onto this object
     * @param string $name Name of the field being evaluated
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the name of the field used for evaluation
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the data used for evaluations on this object
     * @param array $data Data used in various functions
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Returns the data used for evaluations on this object
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Gets the current user object
     * @return User
     */
    protected function getCurrentUser()
    {
        global $current_user;
        return $current_user;
    }

    /**
     * Determines whether an object has the necessary setup to be checked
     * @return boolean
     */
    protected function isCheckable()
    {
        return isset($this->data[$this->name]) && isset($this->bean->{$this->name});
    }

    /**
     * Checks if a field exists on the bean to be checked
     * @return boolean
     */
    protected function hasProperty()
    {
        return property_exists($this->bean, $this->name);
    }
}
