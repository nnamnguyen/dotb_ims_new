<?php



/**
 * Bean visibility manager
 * @api
 */
class BeanVisibility
{
    /**
     * List of strategies to apply to this bean
     * @var DotbVisibility[]
     */
    protected $strategies = array();

    /**
     * Parent bean
     * @var DotbBean
     */
    protected $bean;

    /**
     * Loaded Strategies
     * @var array
     */
    protected $loadedStrategies = array();

    /**
     * @param DotbBean $bean
     * @param array $metadata
     */
    public function __construct(DotbBean $bean, array $metadata)
    {
        $this->bean = $bean;
        foreach ($metadata as $visclass => $data) {
            if ($data === false) {
                continue;
            }
            $this->addStrategy($visclass, $data);
        }
    }

    /**
     * Add the strategy to the list
     * @param string $strategy Strategy class name
     * @param mixed $data Strategy params
     */
    public function addStrategy($strategy, $data = null)
    {
        $this->strategies[] = new $strategy($this->bean, $data);
        /*
         *  because PHP will allow $strategy to be an object and instantiate a new version of
         *  itself in the above line we need to check if it is an object before we save it to the
         *  loadedStrategies array
         */
        $strategyName = is_object($strategy) ? get_class($strategy) : $strategy;
        $this->loadedStrategies[$strategyName] = true;
    }

    /**
     * Add visibility clauses to the FROM part of the query
     * @param string $query
     * @param array|null $options
     * @return string Modified query
     *
     * @deprecated Use DotbQuery and BeanVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityFrom(&$query, $options = array())
    {
        foreach ($this->strategies as $strategy) {
            $strategy->setOptions($options)->addVisibilityFrom($query);
        }
        return $query;
    }

    /**
     * Add visibility clauses to the WHERE part of the query
     * @param string $query
     * @param array|null $options
     * @return string Modified query
     *
     * @deprecated Use DotbQuery and BeanVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityWhere(&$query, $options = array())
    {
        foreach($this->strategies as $strategy) {
            $strategy->setOptions($options)->addVisibilityWhere($query);
        }
        return $query;
    }

    /**
     * Add visibility clauses to the FROM part of DotbQuery
     * @param DotbQuery $query
     * @param array|null $options
     * @return DotbQuery Modified DotbQuery
     *
     * @deprecated Use BeanVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityFromQuery(DotbQuery $query, $options = array())
    {
        foreach($this->strategies as $strategy) {
            $strategy->setOptions($options)->addVisibilityFromQuery($query);
        }
        return $query;
    }

    /**
     * Add visibility clauses to the WHERE part of DotbQuery
     * @param DotbQuery $query
     * @param array|null $options
     * @return DotbQuery Modified DotbQuery
     *
     * @deprecated Use BeanVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityWhereQuery(DotbQuery $query, $options = array())
    {
        foreach($this->strategies as $strategy) {
            $strategy->setOptions($options)->addVisibilityWhereQuery($query);
        }
        return $query;
    }

    /**
     * Add visibility clauses to DotbQuery
     *
     * @param DotbQuery $query
     * @param array $options
     */
    public function addVisibilityQuery(DotbQuery $query, $options = array())
    {
        foreach ($this->strategies as $strategy) {
            $strategy->setOptions($options)->addVisibilityQuery($query);
        }
    }

    /**
     * Check if the Strategy has been loaded
     * @param string $name
     * @return boolean
     */
    public function isLoaded($name)
    {
        return isset($this->loadedStrategies[$name]);
    }

    /**
     * Get strategy objects
     * @return array
     */
    public function getStrategies()
    {
        return $this->strategies;
    }

    /**
     * Called before the bean is indexed so that any calculated attributes can updated.
     * Propagates to all registered strategies.
     * @return void
     * @deprecated
     */
    public function beforeSseIndexing()
    {
        $GLOBALS['log']->deprecated("BeanVisibility::beforeSseIndexing is deprecated !");
    }

    /**
     * Apply DotbSearchEngine visibility filters.
     * @param DotbSearchEngineInterface $engine Dotb search engine object
     * @param mixed $filter Current filter used as base
     * @return mixed
     * @deprecated
     */
    public function addSseVisibilityFilter(DotbSearchEngineInterface $engine, $filter)
    {
        $GLOBALS['log']->deprecated("BeanVisibility::addSseVisibilityFilter is deprecated !");
        return $filter;
    }
}

