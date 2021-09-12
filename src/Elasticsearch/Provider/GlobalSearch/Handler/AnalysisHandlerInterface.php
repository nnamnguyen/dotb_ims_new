<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

use Dotbcrm\Dotbcrm\Elasticsearch\Analysis\AnalysisBuilder;

/**
 *
 * Analysis builder capable handler
 *
 */
interface AnalysisHandlerInterface extends HandlerInterface
{
    /**
     * Build analysis
     * @param AnalysisBuilder $builder
     */
    public function buildAnalysis(AnalysisBuilder $builder);
}
