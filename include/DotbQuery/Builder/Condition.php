<?php


class DotbQuery_Builder_Condition
{
    /**
     * @var string
     */
    public $operator;
    /**
     * @var DotbQuery_Builder_Field_Condition
     */
    public $field;
    /**
     * @var array
     */
    public $values = array();
    /**
     * @var bool|DotbBean
     */
    public $bean = false;
    /**
     * @var bool
     */
    public $isNull = false;
    /**
     * @var bool
     */
    public $notNull = false;

    /**
     * @var DotbQuery
     */
    public $query;

    /**
     * @var bool
     */
    protected $isAclIgnored;

    public function __construct(DotbQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @param string $operator
     * @return DotbQuery_Builder_Condition
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * @param array $values
     * @return DotbQuery_Builder_Condition
     */
    public function setValues($values)
    {
        if (is_array($values) && count($values) == 1 && key($values) === '$field') {
            $values = new DotbQuery_Builder_Field(current($values), $this->query);
        } else {
            $this->field->verifyCondition($values, $this->query);
        }
        $this->values = $values;
        return $this;
    }

    /**
     * @param string $field
     * @return DotbQuery_Builder_Condition
     */
    public function setField($field)
    {
        $this->field = new DotbQuery_Builder_Field_Condition($field, $this->query);
        return $this;
    }

    /**
     * @param DotbBean $bean
     */
    public function setBean(DotbBean $bean)
    {
        $this->bean = $bean;
    }

    /**
     * @return DotbQuery_Builder_Condition
     */
    public function isNull()
    {
        $this->isNull = true;
        return $this;
    }

    /**
     * @return DotbQuery_Builder_Condition
     */
    public function notNull()
    {
        $this->notNull = true;
        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * Marks condition as ignoring ACL
     */
    public function ignoreAcl()
    {
        $this->isAclIgnored = true;
    }

    /**
     * Checks
     */
    public function isAclIgnored()
    {
        return $this->isAclIgnored;
    }
}
