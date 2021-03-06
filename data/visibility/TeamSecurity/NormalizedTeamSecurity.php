<?php


use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\StrategyInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Visibility;
use Dotbcrm\Dotbcrm\Elasticsearch\Analysis\AnalysisBuilder;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;

/**
 * Team security visibility
 */
class NormalizedTeamSecurity extends DotbVisibility implements StrategyInterface
{
    /**
     * $dotb_config base key for performance profile
     * @var string
     */
    const CONFIG_PERF_KEY = "perfProfile.TeamSecurity.%s";

    /**
     * Default teamSet prefetch count
     * @var integer
     */
    const TEAMSET_PREFETCH_MAX = 500;

    /**
     * Get team security `join` as a `IN()` condition.
     * @param string $current_user_id
     * @return string
     */
    protected function getCondition($current_user_id)
    {
        $team_table_alias = 'team_memberships';
        $table_alias = $this->getOption('table_alias');
        if (!empty($table_alias)) {
            $team_table_alias = $this->bean->db->getValidDBName($team_table_alias.$table_alias, true, 'table');
        } else {
            $table_alias = $this->bean->table_name;
        }

        $inClause = $this->getInCondition($current_user_id, $team_table_alias);
        return " {$table_alias}.team_set_id IN ({$inClause}) ";
    }

    /**
     * Get IN condition clause
     * @param string $currentUserId Current user id
     * @param string $teamTableAlias Team table alias
     * @return string IN clause
     */
    protected function getInCondition($currentUserId, $teamTableAlias)
    {
        $usePrefetch = false;
        if ($this->getOption('teamset_prefetch')) {
            $teamSets = TeamSet::getTeamSetIdsForUser($currentUserId);
            $count = count($teamSets);
            if ($count <= $this->getOption('teamset_prefetch_max', self::TEAMSET_PREFETCH_MAX)) {
                $usePrefetch = true;
            } else {
                $this->log->warn("TeamSetPrefetch max reached for user {$currentUserId} --> {$count}");
            }
        }

        if ($usePrefetch) {
            if ($count) {
                return implode(',', array_map(array($this->bean->db, 'quoted'), $teamSets));
            } else {
                return 'NULL';
            }
        } else {
            return "select tst.team_set_id from team_sets_teams tst
                    INNER JOIN team_memberships {$teamTableAlias} ON tst.team_id = {$teamTableAlias}.team_id
                    AND {$teamTableAlias}.user_id = '$currentUserId'
                    AND {$teamTableAlias}.deleted = 0";
        }
    }

    /**
     * Get team security as a JOIN clause
     * @param string $current_user_id
     * @return string
     *
     * @see static::join(), should be kept synced
     */
    protected function getJoin($current_user_id)
    {
        $team_table_alias = 'team_memberships';
        $table_alias = $this->getOption('table_alias');
        $table_name = $this->bean->table_name;

        if ($table_alias && $table_alias !== $table_name) {
            $team_table_alias = $this->bean->db->getValidDBName($team_table_alias.$table_alias, true, 'table');
        } else {
            $table_alias = $table_name;
        }

        $tf_alias = $this->bean->db->getValidDBName($table_alias . '_tf', true, 'alias');
        $query = " INNER JOIN (select tst.team_set_id from team_sets_teams tst";
        $query .= " INNER JOIN team_memberships {$team_table_alias} ON tst.team_id = {$team_table_alias}.team_id
                    AND {$team_table_alias}.user_id = '$current_user_id'
                    AND {$team_table_alias}.deleted=0 group by tst.team_set_id) {$tf_alias} on {$tf_alias}.team_set_id  = {$table_alias}.team_set_id ";
        if ($this->getOption('join_teams')) {
            $query .= " INNER JOIN teams ON teams.id = {$team_table_alias}.team_id AND teams.deleted=0 ";
        }
        return $query;
    }

    /**
     * Joins visibility condition to the query
     *
     * @param DotbQuery $query
     * @param string $user_id
     *
     * @see static::getJoin(), should be kept synced
     * @throws DotbQueryException
     * @throws Exception
     */
    protected function join(DotbQuery $query, $user_id)
    {
        $team_table_alias = 'team_memberships';
        $table_alias = $this->getOption('table_alias');
        if (!empty($table_alias)) {
            $team_table_alias = $this->bean->db->getValidDBName(
                $team_table_alias.$table_alias,
                true,
                'table'
            );
        } else {
            $table_alias = $this->bean->table_name;
        }

        $tf_alias = $this->bean->db->getValidDBName($table_alias . '_tf', true, 'alias');
        $conn = $this->bean->db->getConnection();
        $subQuery = $conn->createQueryBuilder();
        $subQuery
            ->select('tst.team_set_id')
            ->from('team_sets_teams', 'tst')
            ->join(
                'tst',
                'team_memberships',
                $team_table_alias,
                $subQuery->expr()->andX(
                    $team_table_alias . '.team_id = tst.team_id',
                    $team_table_alias . '.user_id = ' . $subQuery->createPositionalParameter($user_id),
                    $team_table_alias . '.deleted = 0'
                )
            )
            ->groupBy('tst.team_set_id');

        $query->joinTable(
            $subQuery,
            array(
                'alias' => $tf_alias,
            )
        )->on()->equalsField($tf_alias . '.team_set_id', $table_alias . '.team_set_id');

        if ($this->getOption('join_teams')) {
            $query->joinTable('teams')
                ->on()
                ->equalsField('teams.id', $team_table_alias . '.team_id')
                ->equals('teams.deleted', 0);
        }
    }

    /**
     * Check if we need WHERE condition
     * @return boolean
     */
    protected function useCondition()
    {
        return $this->getOption('as_condition') || $this->getOption('where_condition');
    }

    /**
     * {@inheritdoc}
     */
    public function addVisibilityFrom(&$query)
    {
        // We'll get it on where clause
        if ($this->useCondition()) {
            return $query;
        }

        $this->addVisibility($query);
        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function addVisibilityWhere(&$query)
    {
        if (!$this->useCondition()) {
            return $query;
        }

        $this->addVisibility($query);
        return $query;
    }

    /**
     * Add visibility query
     * @param string $query
     *
     * @see static::addVisibilityQuery(), should be kept synced
     */
    protected function addVisibility(&$query)
    {
        if (!$this->isTeamSecurityApplicable()) {
            return;
        }

        $current_user_id = empty($GLOBALS['current_user']) ? '' : $GLOBALS['current_user']->id;

        if ($this->useCondition()) {
            $cond = $this->getCondition($current_user_id);
            if ($query) {
                $query .= " AND ".ltrim($cond);
            } else {
                $query = $cond;
            }
        } else {
            $query .= $this->getJoin($current_user_id);
        }
    }

    /**
     * Add visibility query
     *
     * @param DotbQuery $query
     *
     * @see static::addVisibility(), should be kept synced
     */
    public function addVisibilityQuery(DotbQuery $query)
    {
        // Support portal will never respect Teams, even if they do earn more than them even while raising the teamsets
        if (isset($_SESSION['type']) && $_SESSION['type'] === 'support_portal') {
            return;
        }

        if (!$this->isTeamSecurityApplicable()) {
            return;
        }

        $current_user_id = empty($GLOBALS['current_user']) ? '' : $GLOBALS['current_user']->id;

        if ($this->useCondition()) {
            $cond = $this->getCondition($current_user_id);
            $query->whereRaw($cond);
        } else {
            $this->join($query, $current_user_id);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addVisibilityFromQuery(DotbQuery $dotbQuery, array $options = array())
    {
        // We'll get it on where clause
        if ($this->useCondition()) {
            return $dotbQuery;
        }

        if ($this->useCondition()) {
            $table_alias = $this->getOption('table_alias');
            if (empty($dotbQuery->join[$table_alias])) {
                return $dotbQuery;
            }
            $join = $dotbQuery->join[$table_alias];
            $join->query = $dotbQuery;
            $add_join = '';
            $this->addVisibility($add_join);
            if (!empty($add_join)) {
                $join->on()->queryAnd()->addRaw($add_join);
            }
        } else {
            $this->addVisibilityQuery($dotbQuery);
        }

        return $dotbQuery;
    }

    /**
     * {@inheritdoc}
     */
    public function addVisibilityWhereQuery(DotbQuery $dotbQuery, array $options = array())
    {
        if (!$this->useCondition()) {
            return $dotbQuery;
        }

        $cond = '';
        $this->addVisibility($cond);
        if (!empty($cond)) {
            $dotbQuery->whereRaw($cond);
        }
        return $dotbQuery;
    }

    /**
     * Verifies if team security needs to be applied. Note that if the
     * $current_user is not set we still apply team security. This does
     * not make any sense by itself as the result will always be negative
     * (no access).
     * @return bool True if team security needs to be applied
     */
    protected function isTeamSecurityApplicable()
    {
        global $current_user;

        // Support portal will never respect Teams, even if they do earn more than them even while raising the teamsets
        if (isset($_SESSION['type']) && $_SESSION['type'] === 'support_portal') {
            return false;
        }

        if ($this->bean->module_dir == 'WorkFlow'  // copied from old team security clause
            || $this->bean->disable_row_level_security
            || (!empty($current_user) && $current_user->isAdminForModule($this->bean->module_dir))
        ) {
            return false;
        }
        //Add By Lap Nguyen - Cho ph??p user search Lead/Student ??? m???i center
        $allowed_module = ['Leads', 'Contacts'];
        if(in_array($this->bean->module_name, $allowed_module))
            return false;
        //END By Lap nguyen
        return true;
    }

    /**
     * Override for performance tuning per module using `$dotb_config`.
     * {@inheritdoc}
     */
    public function setOptions($options)
    {
        parent::setOptions($options);

        // Ability to skip perf profile - use with caution
        if (!$this->getOption('skip_perf_profile')) {
            $options = empty($this->options) ? array() : $this->options;
            $this->options = $this->getTuningOptions($options);
        }

        return $this;
    }

    /**
     * BETA functionality - use at your own risk
     *
     * Get performance tuning options from $dotb_config. If non
     * available fallback to default tuning options using DBAL.
     * @param array $options
     * @return array
     */
    protected function getTuningOptions(array $options)
    {
        // module specific config
        $configKey = sprintf(self::CONFIG_PERF_KEY, $this->bean->module_dir);
        $tune = DotbConfig::getInstance()->get($configKey, array());

        // if no module specific config, try default config
        $configKey = sprintf(self::CONFIG_PERF_KEY, 'default');
        if (empty($tune)) {
            $tune = DotbConfig::getInstance()->get($configKey, array());
        }

        // if still empty use stock DBAL profile
        if (empty($tune)) {
            $tune = $this->bean->db->getDefaultPerfProfile('TeamSecurity');
        }

        // passed in $options will win from tuning config
        return array_merge($tune, $options);
    }

    /**
     * Override getOption to make sure we use any performance tuning defined in $dotb_config.
     * {@inheritdoc}
     */
    public function getOption($name, $default = null)
    {
        //if parameter is not defined, make sure the tuning options have been loaded prior to calling parent
        if (!isset($this->options[$name])) {
            //send in the defined options or a blank array.
            $options = !empty($this->options) ? $this->options : array();
            $this->options = $this->getTuningOptions($options);
        }

        return parent::getOption($name, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function elasticBuildAnalysis(AnalysisBuilder $analysisBuilder, Visibility $provider)
    {
        // no special analyzers needed
    }

    /**
     * {@inheritdoc}
     */
    public function elasticBuildMapping(Mapping $mapping, Visibility $provider)
    {
        $property = new MultiFieldProperty();
        $property->setType('keyword');
        $mapping->addModuleField('team_set_id', 'set', $property);
    }

    /**
     * {@inheritdoc}
     */
    public function elasticProcessDocumentPreIndex(Document $document, DotbBean $bean, Visibility $provider)
    {
        // team_set_id is retrieved as a bean field directly, nothing to do here
    }

    /**
     * {@inheritdoc}
     */
    public function elasticGetBeanIndexFields($module, Visibility $provider)
    {
        // nominate team_set_id field to be retrievable directly
        return array('team_set_id' => 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function elasticAddFilters(User $user, \Elastica\Query\BoolQuery $filter, Visibility $provider)
    {
        if ($this->isTeamSecurityApplicable()) {
            $filter->addMust($provider->createFilter('TeamSet', [
                'user' => $user,
                'module' => $this->bean->module_name,
            ]));
        }
    }
}
