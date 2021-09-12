<?php


use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy;
use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy\AllowAll;
use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy\DenyAll;
use Dotbcrm\Dotbcrm\Bean\Visibility\Strategy\TeamSecurity\Denormalized;
use Dotbcrm\Dotbcrm\DependencyInjection\Container;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State;

/**
 * Team security visibility
 */
class TeamSecurity extends NormalizedTeamSecurity
{
    /**
     * @var bool
     */
    private $preferDenormalized;

    /**
     * @var User
     */
    private $user;

    /**
     * @var bool
     */
    private $table;

    /**
     * @var Strategy
     */
    private $strategy;

    /**
     * @var DBManager
     */
    private $db;

    public function __construct(DotbBean $bean, $params = null)
    {
        global $current_user;

        parent::__construct($bean, $params);

        $this->user = $current_user;
        $this->db = DBManagerFactory::getInstance();
    }

    public function setOptions($options)
    {
        parent::setOptions($options);

        $this->preferDenormalized = !empty($this->options['use_denorm']);
        $this->table = isset($this->options['table_alias'])
            ? $this->options['table_alias'] : $this->bean->getTableName();
        $this->strategy = null;

        return $this;
    }

    public function addVisibilityFrom(&$query)
    {
        $query = $this->getStrategy()->applyToFrom($this->db, $query, $this->table);

        return $query;
    }

    public function addVisibilityWhere(&$query)
    {
        $query = $this->getStrategy()->applyToWhere($this->db, $query, $this->table);

        return $query;
    }

    public function addVisibilityQuery(DotbQuery $query)
    {
        $this->getStrategy()->applyToQuery($query, $this->table);
    }

    private function getStrategy()
    {
        if ($this->strategy) {
            return $this->strategy;
        }

        return $this->strategy = $this->detectStrategy();
    }

    private function detectStrategy()
    {
        if (!$this->user) {
            return new DenyAll();
        }

        if (!$this->isTeamSecurityApplicable()) {
            return new AllowAll();
        }

        if (!empty($this->options['use_denorm'])) {
            $state = Container::getInstance()->get(State::class);

            if ($state->isAvailable()) {
                return new Denormalized($state->getActiveTable(), $this->user);
            }
        }

        return (new NormalizedTeamSecurity($this->bean))->setOptions($this->options);
    }
}
