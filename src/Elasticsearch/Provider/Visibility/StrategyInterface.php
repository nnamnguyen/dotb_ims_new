<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility;

use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Analysis\AnalysisBuilder;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use DotbBean;
use User;

/**
 *
 * Visibility strategy interface
 *
 */
interface StrategyInterface
{
    /**
     * Build Elasticsearch analysis settings
     * @param AnalysisBuilder $analysisBuilder
     * @param Visibility $provider
     */
    public function elasticBuildAnalysis(AnalysisBuilder $analysisBuilder, Visibility $provider);

    /**
     * Build Elasticsearch mapping
     * @param Mapping $mapping
     * @param Visibility $provider
     */
    public function elasticBuildMapping(Mapping $mapping, Visibility $provider);

    /**
     * Process document before its being indexed
     * @param Document $document
     * @param DotbBean $bean
     * @param Visibility $provider
     */
    public function elasticProcessDocumentPreIndex(Document $document, DotbBean $bean, Visibility $provider);

    /**
     * Bean index fields to be indexed
     * @param string $module
     * @param Visibility $provider
     * @return array
     */
    public function elasticGetBeanIndexFields($module, Visibility $provider);

    /**
     * Add visibility filters
     * @param User $user
     * @param \Elastica\Query\BoolQuery $filter
     * @param Visibility $provider
     */
    public function elasticAddFilters(User $user, \Elastica\Query\BoolQuery $filter, Visibility $provider);
}
