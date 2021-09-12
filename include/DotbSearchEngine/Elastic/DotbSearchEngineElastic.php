<?php


use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;
use Dotbcrm\Dotbcrm\SearchEngine\Capability\GlobalSearch\GlobalSearchCapable;
use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\ResultSet;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;

/**
 *
 * Wrapper around new GlobalSearch framework, replaces previous logic.
 *
 *                      !!! DEPRECATION WARNING !!!
 *
 * All code in include/DotbSearchEngine is going to be deprecated in a future
 * release. Do not use any of its APIs for code customizations as there will be
 * no guarantee of support and/or functionality for it. Use the new framework
 * located in the directories src/SearchEngine and src/Elasticsearch.
 *
 * @deprecated
 */
class DotbSearchEngineElastic extends DotbSearchEngineAbstractBase
{
    /**
     * @var GlobalSearchCapable
     */
    protected $engine;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * Ctor
     * @param array $options
     * @param GlobalSearchCapable $engine
     * @param LoggerManager $logger
     */
    public function __construct($options = array(), GlobalSearchCapable $engine = null, LoggerManager $logger = null)
    {
        $this->options = $options;
        $this->engine = $engine ?: SearchEngine::getInstance('GlobalSearch')->getEngine();
        parent::__construct($logger);
    }

    /**
     * {@inheritdoc}
     *
     * @return DotbSeachEngineElasticResultSet|null
     */
    public function search($query, $offset = 0, $limit = 20, $options = array())
    {
        global $current_user;

        if (!$this->engine->isAvailable()) {
            return null;
        }

        $this->engine->term($query);
        $this->engine->offset($offset);
        $this->engine->limit($limit);
        $this->engine->highlighter(true);
        $this->engine->fieldBoost(true);

        // set module filter
        if (!empty($options['moduleFilter'])) {
            $this->engine->from($options['moduleFilter']);
        }

        $filters = array();

        if (isset($options['my_items']) && $options['my_items'] !== false) {
            if (empty($current_user->id)) {
                return null;
            }

            $ownerField = Mapping::PREFIX_COMMON . 'owner_id.owner';
            $filters[] = new \Elastica\Query\Term(array(
                $ownerField => $current_user->id,
            ));
        }

        // TODO - range filter
        if (isset($options['filter']) && $options['filter']['type'] == 'range') {
        }

        if (isset($options['favorites']) && $options['favorites'] == 2) {
            if (empty($current_user->id)) {
                return null;
            }

            $favField = Mapping::PREFIX_COMMON . 'user_favorites.agg';
            $filters[] = new \Elastica\Query\Term(array(
                $favField => $current_user->id,
            ));
        }

        // TODO - sort options
        if (isset($options['sort']) && is_array($options['sort'])) {
            foreach ($options['sort'] as $sort) {
            }
        }

        $this->engine->setFilters($filters);
        return $this->createResultSet($this->engine->search());
    }

    /**
     * Wrapper method transforming ResultSet into old format
     * @param ResultSet $resultSet
     * @return DotbSeachEngineElasticResult
     */
    protected function createResultSet(ResultSet $resultSet)
    {
        $res = new DotbSeachEngineElasticResultSet($resultSet->getResultSet());
        $resParser = $resultSet->getResultParser();
        if (isset($resParser)) {
            $res->setResultParser($resParser);
        }
        return $res;
    }

    /**
     * {@inheritdoc}
     */
    public function indexBean($bean, $batch = true)
    {
        $this->logger->deprecated('DotbSearchEngineElastic::indexBean is deprecated and no longer available');
    }

    /**
     * {@inheritdoc}
     */
    public function delete(DotbBean $bean)
    {
        $this->logger->deprecated('DotbSearchEngineElastic::delete is deprecated and no longer available');
    }

    /**
     * {@inheritdoc}
     */
    public function bulkInsert(array $docs)
    {
        $this->logger->deprecated('DotbSearchEngineElastic::bulkInsert is deprecated and no longer available');
    }

    /**
     * {@inheritdoc}
     */
    public function createIndexDocument($bean, $searchFields = null)
    {
        $this->logger->deprecated('DotbSearchEngineElastic::createIndexDocument is deprecated and no longer available');
    }

    /**
     * {@inheritdoc}
     */
    public function getServerStatus()
    {
        global $app_strings, $dotb_config;
        $isValid = $this->engine->isAvailable(true);
        $status = $isValid ? $app_strings['LBL_EMAIL_SUCCESS'] : $app_strings['ERR_ELASTIC_TEST_FAILED'];
        return array('valid' => $isValid, 'status' => $status);
    }

    /**
     * {@inheritdoc}
     */
    public function createIndex($recreate = false, $modules = array())
    {
        $this->logger->deprecated('DotbSearchEngineElastic::createIndex is deprecated and no longer available');
    }

    /**
     * {@inheritdoc}
     */
    public function isTypeFtsEnabled($type)
    {
        $this->logger->deprecated('DotbSearchEngineElastic::isTypeFtsEnabled is deprecated');
        return in_array($type, $this->engine->getStudioSupportedTypes());
    }
}
