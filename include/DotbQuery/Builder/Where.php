<?php


abstract class DotbQuery_Builder_Where
{
    /**
     * @var DotbQuery_Builder_Field_Raw|null
     */
    public $raw = null;

    /**
     * @var DotbQuery_Builder_Condition[]
     */
    public $conditions = array();

    /**
     * @var DotbQuery
     */
    public $query = false;

    /**
     * Constructor
     *
     * @param DotbQuery $query
     * @throws DotbQueryException
     */
    public function __construct(DotbQuery $query)
    {
        $this->query = $query;
    }

    /**
     * Returns the operator for joining conditions
     *
     * @return string
     */
    abstract public function operator();

    /**
     * Generic condition
     *
     * @param string $field Field name
     * @param string $operator Operator
     * @param mixed $value Value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function condition($field, $operator, $value, DotbBean $bean = null)
    {
        $condition = new DotbQuery_Builder_Condition($this->query);
        $condition->setOperator($operator)
            ->setField($field)
            ->setValues($value);
        if ($bean) {
            $condition->setBean($bean);
        }
        $this->add($condition);
        return $this;
    }

    /**
     * @param string $field Field name
     * @param mixed $value Value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function equals($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, '=', $value, $bean);
    }

    /**
     * Creates a condition for two fields to check equality
     *
     * @param string $field1
     * @param string $field2
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function equalsField($field1, $field2, DotbBean $bean = null)
    {
        return $this->equals($field1, array(
            '$field' => $field2,
        ), $bean);
    }

    /**
     * Creates a condition to check not equals
     *
     * @param string $field
     * @param string $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function notEquals($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, '!=', $value, $bean);
    }

    /**
     * Creates a condition for two fields to check non-equality
     *
     * @param string $field1
     * @param string $field2
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function notEqualsField($field1, $field2, DotbBean $bean = null)
    {
        return $this->notEquals($field1, array(
            '$field' => $field2,
        ), $bean);
    }

    /**
     * Sets an empty where query portion onto the where object. Delegates this
     * to the DBManagers since Oracle has to handle empty differently than all
     * other DBs.
     * @param mixed $field The field
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function isEmpty($field, DotbBean $bean = null)
    {
        $this->query->getDBManager()->setEmptyWhere($this, $field, $bean);
        return $this;
    }

    /**
     * Sets a not empty where query portion onto the where object. Delegates this
     * to the DBManagers since Oracle has to handle empty differently than all
     * other DBs.
     * @param mixed $field The field
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function isNotEmpty($field, DotbBean $bean = null)
    {
        $this->query->getDBManager()->setNotEmptyWhere($this, $field, $bean);
        return $this;
    }

    /**
     * @param $field
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function isNull($field, DotbBean $bean = null)
    {
        $condition = new DotbQuery_Builder_Condition($this->query);
        $condition->setField($field)->isNull();
        if ($bean) {
            $condition->setBean($bean);
        }
        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * @param $field
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function notNull($field, DotbBean $bean = null)
    {
        $condition = new DotbQuery_Builder_Condition($this->query);
        $condition->setField($field)->notNull();
        if ($bean) {
            $condition->setBean($bean);
        }
        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function contains($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, 'CONTAINS', $value, $bean);
    }

    /**
     * @param $field
     * @param $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function notContains($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, 'DOES NOT CONTAIN', $value, $bean);
    }

    /**
     * @param $field
     * @param $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function starts($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, 'STARTS', $value, $bean);
    }

    /**
     * Creates a condition like field LIKE '%value';
     *
     * @param string $field
     * @param string $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function ends($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, 'ENDS', $value, $bean);
    }

    /**
     * @param $field
     * @param array|DotbQuery $vals
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function in($field, $vals, DotbBean $bean = null)
    {
        $isNull = false;
        if (is_array($vals)) {
            $isNull = in_array('', $vals);
        }

        if ($isNull) {
            $vals = array_filter($vals, 'strlen');
            if (count($vals) > 0) {
                $where = $this->queryOr();
                $where->isNull($field, $bean);
                $where->in($field, $vals, $bean);
            } else {
                $this->isNull($field, $bean);
            }
            return $this;
        }
        return $this->condition($field, 'IN', $vals, $bean);
    }

    /**
     * @param $field
     * @param array|DotbQuery $vals
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function notIn($field, $vals, DotbBean $bean = null)
    {
        $isNull = in_array('', $vals);
        if ($isNull) {
            $vals = array_filter($vals, 'strlen');
            if (count($vals) > 0) {
                $where = $this->queryAnd();
                $where->notNull($field, $bean);
                $where->notIn($field, $vals, $bean);
            } else {
                $this->notNull($field, $bean);
            }
            return $this;
        }
        return $this->condition($field, 'NOT IN', $vals, $bean);
    }

    /**
     * @param $field
     * @param $min
     * @param $max
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function between($field, $min, $max, DotbBean $bean = null)
    {
        return $this->condition($field, 'BETWEEN', array('min' => $min, 'max' => $max), $bean);
    }

    /**
     * @param $field
     * @param $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function lt($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, '<', $value, $bean);
    }

    /**
     * @param $field
     * @param $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function lte($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, '<=', $value, $bean);
    }

    /**
     * @param $field
     * @param $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function gt($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, '>', $value, $bean);
    }

    /**
     * @param $field
     * @param $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function gte($field, $value, DotbBean $bean = null)
    {
        return $this->condition($field, '>=', $value, $bean);
    }

    /**
     * Given a date range expression it builds greater and lower than conditions
     *
     * @param string $field
     * @param string $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function dateRange($field, $value, DotbBean $bean = null)
    {
        //Gets us an array with "from/to" dates, each set to very beginning or end of day as appropriate
        $timeDate = $this->timeDateInstance();
        $dates = $timeDate->parseDateRange($value, null, true);
        if (is_array($dates)) {
            $where = $this->queryAnd();
            $type = '';
            if ($bean) {
                $type = $bean->getFieldDefinition($field);
                $type = !empty($type['type']) ? $type['type'] : '';
            }
            if (!$type) {
                $where->lte($field, $timeDate->asDb($dates[1]), $bean);
                $where->gte($field, $timeDate->asDb($dates[0]), $bean);
            } else {
                $where->lte($field, $timeDate->asDbType($dates[1], $type), $bean);
                $where->gte($field, $timeDate->asDbType($dates[0], $type), $bean);
            }
        }
        return $this;
    }

    /**
     * Creates a condition to check if the field value matches the pattern
     *
     * Use this method only in case if the pattern is expected to contain arbitrary wildcards.
     * Otherwise, use starts(), ends() or contains().
     *
     * @param string $field
     * @param string $pattern
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function like($field, $pattern, DotbBean $bean = null)
    {
        return $this->condition($field, 'LIKE', $pattern, $bean);
    }

    /**
     * Creates a condition to check if the field value does not match the pattern
     *
     * Use this method only in case if the pattern is expected to contain arbitrary wildcards.
     * Otherwise, use notContains().
     *
     * @param string $field
     * @param string $pattern
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     */
    public function notLike($field, $pattern, DotbBean $bean = null)
    {
        return $this->condition($field, 'NOT LIKE', $pattern, $bean);
    }

    /**
     * We need to mock TimeDate object for tests
     *
     * @return TimeDate
     */
    protected function timeDateInstance()
    {
        return TimeDate::getInstance();
    }

    /**
     * Between filter for Date fields. We can't use $between because we need to convert the right bound date
     *
     * @param string $field
     * @param array $value
     * @param DotbBean|null $bean DotbBean, optional
     *
     * @return $this
     * @throws DotbApiExceptionInvalidParameter If invalid dates
     */
    public function dateBetween($field, $value, DotbBean $bean = null)
    {
        //Skip filter if a value is empty
        if (empty($value[0]) || empty($value[1])) {
            return $this;
        }
        //The empty value can be a string `null`
        if ($value[0] === 'null' || $value[1] === 'null') {
            return $this;
        }
        $leftDate = date_parse($value[0]);
        $rightDate = date_parse($value[1]);
        if (!empty($leftDate['errors']) || !empty($rightDate['errors'])) {
            throw new DotbQueryException('$dateBetween requires two valid dates');
        }
        //The right date must cover the full day
        $rightDate = date(
            "Y-m-d H:i:s",
            mktime(23, 59, 59, $rightDate['month'], $rightDate['day'], $rightDate['year'])
        );
        $leftDate = date(
            "Y-m-d H:i:s",
            mktime(0, 0, 0, $leftDate['month'], $leftDate['day'], $leftDate['year'])
        );
        return $this->gte($field, $leftDate, $bean)
                    ->lte($field, $rightDate, $bean);
    }

    /**
     * @param string $sql
     */
    public function addRaw($sql)
    {
        global $log;

        if ($this->raw !== null) {
            $log->fatal(sprintf(
                'The raw expression \'%s\' in DotbQuery WHERE is being overwritten with \'%s\'',
                $this->raw->field,
                $sql
            ));
        }

        $this->raw = new DotbQuery_Builder_Field_Raw($sql, $this->query);
    }

    /**
     * @param mixed $condition
     */
    public function add($condition)
    {
        $this->conditions[] = $condition;
    }

    /**
     * @return DotbQuery_Builder_Andwhere
     */
    public function queryAnd()
    {
        $where = new DotbQuery_Builder_Andwhere($this->query);
        $this->conditions[] = $where;
        return $where;
    }

    /**
     * @return DotbQuery_Builder_Orwhere
     */
    public function queryOr()
    {
        $where = new DotbQuery_Builder_Orwhere($this->query);
        $this->conditions[] = $where;
        return $where;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

}
