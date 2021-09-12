<?php


use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Analysis\AnalysisBuilder;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\StrategyInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Visibility;

/**
 * Class EmailsVisibility
 *
 * Additional visibility check for the Emails module.
 */
class EmailsVisibility extends DotbVisibility implements StrategyInterface
{
    /**
     * Draft emails are only accessible by their assigned user, administrators, and developers.
     *
     * {@inheritdoc}
     */
    public function addVisibilityWhere(&$query)
    {
        if (!$this->isUserAnAdmin($GLOBALS['current_user'])) {
            $alias = $this->getOption('table_alias');
            $ownerWhere = $this->bean->getOwnerWhere($GLOBALS['current_user']->id, $alias);

            if (empty($alias)) {
                $alias = $this->bean->getTableName();
            }

            $where = "({$alias}.state<>" . $GLOBALS['db']->quoted(Email::STATE_DRAFT) .
                " OR ({$alias}.state=" . $GLOBALS['db']->quoted(Email::STATE_DRAFT) . " AND{$ownerWhere}))";
            $query = empty($query) ? $where : "{$query} AND {$where}";
        }

        return $query;
    }

    /**
     * Draft emails are only accessible by their assigned user, administrators, and developers.
     *
     * {@inheritdoc}
     */
    public function addVisibilityWhereQuery(DotbQuery $query)
    {
        $where = null;
        $this->addVisibilityWhere($where);

        if (!empty($where)) {
            $query->where()->queryAnd()->addRaw($where);
        }

        return $query;
    }

    /**
     * No special analyzers are needed.
     *
     * {@inheritdoc}
     */
    public function elasticBuildAnalysis(AnalysisBuilder $analysisBuilder, Visibility $provider)
    {
    }

    /**
     * Creates a field for the {@link Email::$state} property in the ElasticSearch index.
     *
     * {@inheritdoc}
     */
    public function elasticBuildMapping(Mapping $mapping, Visibility $provider)
    {
        $property = new MultiFieldProperty();
        $property->setType('keyword');
        $mapping->addModuleField('state', 'emails_state', $property);
    }

    /**
     * The {@link Email::$state} property is already set. No additional work is needed.
     *
     * {@inheritdoc}
     */
    public function elasticProcessDocumentPreIndex(Document $document, DotbBean $bean, Visibility $provider)
    {
    }

    /**
     * Allows the {@link Email::$state} property to be retrieved directly from the database to improve indexing
     * performance.
     *
     * {@inheritdoc}
     */
    public function elasticGetBeanIndexFields($module, Visibility $provider)
    {
        return ['state' => 'enum'];
    }

    /**
     * Draft emails are only accessible by their assigned user, administrators, and developers.
     *
     * {@inheritdoc}
     */
    public function elasticAddFilters(User $user, \Elastica\Query\BoolQuery $filter, Visibility $provider)
    {
        if (!$this->isUserAnAdmin($user)) {
            $draftFilter = new \Elastica\Query\BoolQuery();
            $draftFilter->addMust($provider->createFilter('EmailsState', ['state' => Email::STATE_DRAFT]));
            $draftFilter->addMust($provider->createFilter('Owner', ['user' => $user]));

            $nonDraftFilter = new \Elastica\Query\BoolQuery();
            $nonDraftFilter->addMustNot($provider->createFilter('EmailsState', ['state' => Email::STATE_DRAFT]));

            $visibilityFilter = new \Elastica\Query\BoolQuery();
            $visibilityFilter->addShould($draftFilter);
            $visibilityFilter->addShould($nonDraftFilter);

            $filter->addMust($visibilityFilter);
        }
    }

    /**
     * Is the current user an administrator or developer for the Emails module?
     *
     * @param User $user
     * @return bool
     */
    private function isUserAnAdmin(User $user)
    {
        return $user->isAdminForModule('Emails') || $user->isDeveloperForModule('Emails');
    }
}
