<?php


use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy;

/**
 * Base class for visibility implementations
 * @api
 */
abstract class DotbVisibility implements Strategy
{
    /**
     * Bean context
     * @var DotbBean
     */
    protected $bean;

    /**
     * Strategy params
     * @var mixed
     */
    protected $params;

    /**
     * @var LoggerManager
     */
    protected $log;

    /**
     * Options for this run
     * @var array|null
     */
    protected $options;

    /**
     * @param DotbBean $bean
     * @param mixed $params Strategy params
     */
    public function __construct(DotbBean $bean, $params = null)
    {
        $this->bean = $bean;
        $this->params = $params;
        $this->log = LoggerManager::getLogger();
    }

    /**
     * Add visibility clauses to the FROM part of the query
     * @param string $query
     * @return string
     *
     * @deprecated Use DotbQuery and DotbVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityFrom(&$query)
    {
        return $query;
    }

    /**
     * Add visibility clauses to the WHERE part of the query
     * @param string $query
     * @return string
     *
     * @deprecated Use DotbQuery and DotbVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityWhere(&$query)
    {
        return $query;
    }

    /**
     * Add visibility clauses to the FROM part of DotbQuery
     * @param DotbQuery $query
     * @return DotbQuery
     *
     * @deprecated Implement DotbVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityFromQuery(DotbQuery $query)
    {
        return $query;
    }

    /**
     * Add visibility clauses to the WHERE part of DotbQuery
     * @param DotbQuery $query
     * @return DotbQuery
     *
     * @deprecated Implement DotbVisibility::addVisibilityQuery() instead
     */
    public function addVisibilityWhereQuery(DotbQuery $query)
    {
        return $query;
    }

    /**
     * Add visibility to DotbQuery
     *
     * @param DotbQuery $query
     */
    public function addVisibilityQuery(DotbQuery $query)
    {
        $this->addVisibilityFromQuery($query);
        $this->addVisibilityWhereQuery($query);
    }

    /**
     * {@inheritDoc}
     */
    public function applyToFrom(DBManager $db, $query, $table)
    {
        $this->options['table_alias'] = $table;
        return $this->addVisibilityFrom($query);
    }

    /**
     * {@inheritDoc}
     */
    public function applyToWhere(DBManager $db, $query, $table)
    {
        $this->options['table_alias'] = $table;
        return $this->addVisibilityWhere($query);
    }

    /**
     * {@inheritDoc}
     */
    public function applyToQuery(DotbQuery $query, $table)
    {
        $this->options['table_alias'] = $table;
        $this->addVisibilityQuery($query);
    }

    /**
     * Get visibility option
     * @param string $name
     * @param mixed $default Default value if option not set
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        if (isset($this->options[$name])) {
            return $this->options[$name];
        }

        if ($name === 'action' && $default !== null) {
            $GLOBALS['log']->warn('Relying on the default action in DotbVisibility is discouraged');
        }

        return $default;
    }

    /**
     * Set visibility options
     * @param array|null $options
     * @return DotbVisibility
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Called before the bean is indexed so that any calculated attributes can
     * updated. Override to implement visibility related attribute updates
     * before the bean is indexed.
     * @return void
     * @deprecated
     */
    public function beforeSseIndexing()
    {
        $GLOBALS['log']->deprecated("DotbVisibility::beforeSseIndexing is deprecated !");
    }

    /**
     * Apply visibility filters for DotbSearchEngine
     * @param DotbSearchEngineInterface $engine Dotb search engine objects
     * @param mixed $filter
     * @return mixed
     * @deprecated
     */
    public function addSseVisibilityFilter(DotbSearchEngineInterface $engine, $filter)
    {
        $GLOBALS['log']->deprecated("DotbVisibility::addSseVisibilityFilter is deprecated !");
        return $filter;
    }
}
