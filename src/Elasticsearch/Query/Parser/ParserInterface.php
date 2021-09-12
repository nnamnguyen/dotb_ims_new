<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Query\Parser;

/**
 *
 * Parser Interface
 *
 */
interface ParserInterface
{
    /**
     * Parse the given terms
     * @param string $terms the query terms to be parsed
     * @return mixed return false if it cannot be parsed, otherwise return the parsed boolean expression.
     */
    public function parse($terms);
}
