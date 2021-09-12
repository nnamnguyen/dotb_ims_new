<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Highlighter;

/**
 *
 * Highlighter Interface
 *
 */
interface HighlighterInterface
{
    /**
     * Build highlighter properties
     * @return array
     */
    public function build();
}
