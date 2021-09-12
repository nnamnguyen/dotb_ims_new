<?php


/**
 * @internal
 */
class DotbQuery_Builder_Join
{
    /**
     * @var array
     */
    public $options = array();

    /**
     * @var null|string|DotbQuery
     */
    public $table;

    /**
     * @var null|DotbQuery_Builder_Where
     */
    public $on;

    /**
     * @var bool|string
     */
    public $raw = false;

    /**
     * @var bool|string
     */
    public $linkName = false;

    /**
     * @var bool|DotbQuery
     */
    public $query = false;

    /**
     * @var bool|DotbBean
     */
    public $bean = false;

    public $relatedJoin = false;

    /**
     * @var string
     */
    public $relationshipTableAlias;

    /**
     * Create the JOIN Object
     * @param string $table
     * @param array $options
     * @throws DotbQueryException
     */
    public function __construct($table, array $options = array())
    {
        if (!is_string($table) && !isset($options['alias'])) {
            throw new DotbQueryException('Joined sub-query must have alias');
        }

        // Set the table to JOIN on
        $this->table = $table;
        $this->bean = !empty($options['bean']) ? $options['bean'] : false;
        unset($options['bean']);
        $this->relatedJoin = !empty($options['relatedJoin']) ? $options['relatedJoin'] : false;
        unset($options['relatedJoin']);
        $this->options = array_merge(array(
            'joinType' => 'INNER',
        ), $options);
    }

    /**
     * Sets and returns the ON criteria
     *
     * @return DotbQuery_Builder_Andwhere
     * @throws DotbQueryException
     */
    public function on()
    {
        if (isset($this->on)) {
            if (!$this->on instanceof DotbQuery_Builder_Andwhere) {
                throw new DotbQueryException(sprintf(
                    'Cannot change the top level ON operator from %s to %s',
                    $this->on->operator(),
                    'AND'
                ));
            }
        } else {
            $this->on = new DotbQuery_Builder_Andwhere($this->query, $this->bean);
        }

        return $this->on;
    }

    /**
     * Sets and returns the ON criteria
     *
     * @return object this
     * @throws DotbQueryException
     */
    public function onOr()
    {
        if (isset($this->on)) {
            if (!$this->on instanceof DotbQuery_Builder_Orwhere) {
                throw new DotbQueryException(sprintf(
                    'Cannot change the top level ON operator from %s to %s',
                    $this->on->operator(),
                    'OR'
                ));
            }
        } else {
            $this->on = new DotbQuery_Builder_Orwhere($this->query, $this->bean);
        }

        return $this->on;
    }

    /**
     * Add a string of Raw SQL
     * @param string $sql
     * @return DotbQuery_Builder_Join
     */
    public function addRaw($sql)
    {
        $this->raw = $sql;
        return $this;
    }

    /**
     * Add a string that is a link name from vardefs
     * @param string $linkName
     * @return DotbQuery_Builder_Join
     */
    public function addLinkName($linkName)
    {
        $this->linkName = $linkName;
        return $this;
    }

    /**
     * Return name of the join table
     * @return string
     */
    public function joinName()
    {
        if (!empty($this->options['alias'])) {
            return $this->options['alias'];
        }
        return $this->table;
    }

    public function join($link, $options = array())
    {
        $options['relatedJoin'] = $this->options['alias'];
        return $this->query->join($link, $options);
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
