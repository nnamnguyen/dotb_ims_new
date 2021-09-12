<?php


use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\StrategyInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility\Visibility;
use Dotbcrm\Dotbcrm\Elasticsearch\Analysis\AnalysisBuilder;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;

/**
 * Class KBVisibility
 * Additional visibility check for KB.
 */
class KBVisibility extends DotbVisibility implements StrategyInterface
{
    /**
     * {@inheritDoc}
     * Used in \DotbBean::create_new_list_query
     */
    public function addVisibilityWhere(&$query)
    {
        $addon = $this->getWhereVisibilityRaw();
        if (!empty($addon)) {
            if (!empty($query)) {
                $query .= " AND $addon";
            } else {
                $query = $addon;
            }
        }
        return $query;
    }

    /**
     * Create additional query for `where` part, if needed.
     * @return string Additional query or empty string.
     */
    protected function getWhereVisibilityRaw()
    {
        $db = DBManagerFactory::getInstance();
        if (!method_exists($this->bean, 'getPublishedStatuses') || !$this->shouldCheckVisibility()) {
            return '';
        } else {
            $statuses = $this->bean->getPublishedStatuses();
            foreach ($statuses as $_ => $status) {
                $statuses[$_] = $db->quoted($status);
            }
            $statuses = implode(',', $statuses);
            $ow = new OwnerVisibility($this->bean, $this->params);
            $addon = '';
            $ow->addVisibilityWhere($addon);
            return "({$addon} OR {$this->bean->table_name}.status IN ($statuses))";
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addVisibilityWhereQuery(DotbQuery $query)
    {
        $addon = $this->getWhereVisibilityRaw();
        if (!empty($addon)) {
            $query->whereRaw($addon);
        }
        return $query;
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
        $mapping->addModuleField('status', 'kbvis', $property);

        $property = new MultiFieldProperty();
        $property->setType('integer');
        $mapping->addModuleField('active_rev', 'kbvis', $property);

        $property = new MultiFieldProperty();
        $property->setType('keyword');
        $mapping->addModuleField('language', 'kbvis', $property);
    }

    /**
     * {@inheritdoc}
     */
    public function elasticProcessDocumentPreIndex(Document $document, DotbBean $bean, Visibility $provider)
    {
        // nothing to do here
    }

    /**
     * {@inheritdoc}
     */
    public function elasticGetBeanIndexFields($module, Visibility $provider)
    {
        return array('status' => 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function elasticAddFilters(User $user, \Elastica\Query\BoolQuery $filter, Visibility $provider)
    {
        if (!$this->shouldCheckVisibility()) {
            return;
        }

        // create owner filter
        $ownerFilter = $provider->createFilter('Owner', ['user' => $user]);

        if ($statuses = $this->getPublishedStatuses()) {
            $combo = new \Elastica\Query\BoolQuery();
            $combo->addShould($provider->createFilter('KBStatus', [
                'published_statuses' => $statuses,
                'module' => $this->bean->module_name,
            ]));
            $combo->addShould($ownerFilter);
            $filter->addMust($combo);
        } else {
            $filter->addMust($ownerFilter);
        }

        $filter->addShould($provider->createFilter('KBActiveRevision', [
            'module' => $this->bean->module_name,
        ]));
    }

    /**
     * Get published statuses
     * @return array
     */
    protected function getPublishedStatuses()
    {
        if (!method_exists($this->bean, 'getPublishedStatuses')) {
            return array();
        }
        return $this->bean->getPublishedStatuses();
    }

    /**
     * Check whether we need to check visibility
     * @return bool Return true if need to check, false otherwise.
     */
    protected function shouldCheckVisibility()
    {
        $currentUser = $GLOBALS['current_user'];
        $portalUserId = BeanFactory::newBean('Users')->retrieve_user_id('DotbCustomerSupportPortalUser');
        return $currentUser->id == $portalUserId;
    }
}
