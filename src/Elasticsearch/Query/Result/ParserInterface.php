<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Result;

/**
 *
 * Result parser interface which can be attached to the
 * Result(Set) objects to perform additional parsing on
 * the results coming back from Elasticsearch queries.
 *
 */
interface ParserInterface
{
    /**
     * Parse the _source valuse from Result and
     * return the parsed _source array
     *
     * @param \Elastica\Result $result
     * @return array
     */
    public function parseSource(\Elastica\Result $result);

    /**
     * Parse the _highlights from Result and
     * return the parsed _highlight array
     *
     * @param Result $result
     * @return array
     */
    public function parseHighlights(\Elastica\Result $result);
}
