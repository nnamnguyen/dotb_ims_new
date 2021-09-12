<?php


/**
 * Generic interface all sublcasses must implement in order to be pluggable with FTS.
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
interface DotbSearchEngineInterface
{
    /**
     *
     * Perform a search against the Full Text Search Engine
     *
     * @abstract
     * @param $query
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function search($query, $offset = 0, $limit = 20);

    /**
     * Pass in a bean and go through the list of fields to pass to the engine
     *
     * @abstract
     * @param $bean
     * @return void
     */
    public function indexBean($bean, $batched = TRUE);

    /**
     *
     * Delete a bean from the Full Text Search Engine
     *
     * @abstract
     * @param $bean
     * @return void
     */
    public function delete(DotbBean $bean);


    /**
     * Perform bulk inserts on serveral documents to mitigate performance issues.
     *
     * @abstract
     *
     */
    public function bulkInsert(array $docs);

    /**
     * Create the index document that will be sent to the IR System.
     *
     * @abstract
     * @param DotbBean}stdClass $bean
     * @param array|null $searchFields
     */
    public function createIndexDocument($bean, $searchFields = null);

    /**
     * Return info about the server status.
     *
     * @abstract
     * @return array valid: indicates if the connection was successful. status: text to display to the end user
     */
    public function getServerStatus();

    /**
     * Create the index
     *
     * @abstract
     * @param boolean $recreate OPTIONAL Deletes index first if already exists (default = false)
     *
     */
    public function createIndex($recreate = false);

    /**
     *
     * Given a field type, determine whether this type can be enabled for full text search.
     *
     * @abstract
     * @param string $type Dotb field type
     * @return boolean whether the field type can be enabled for full text search
     */
    public function isTypeFtsEnabled($type);
}

/**
 *  Interface to access results from a FTS search.  Is composed of zero or more DotbSearchEngineResult objects.
 *  @deprecated
 */
interface DotbSearchEngineResultSet extends Iterator, Countable
{
    /**
     * Get the total hits found by the search criteria.
     *
     * @abstract
     * @return int
     */
    public function getTotalHits();

    /**
     * Get the total amount of time the search took to complete.
     *
     * @abstract
     * @return int
     */
    public function getTotalTime();

    /**
     * Return facets associated with this search.
     *
     * @return array
     */
    public function getFacets();

    /**
     * Return the facet results for the modules used in the search.
     *
     * @abstract
     */
    public function getModuleFacet();

}

/**
 * Interface for a single FTS result.
 * @deprecated
 */
interface DotbSearchEngineResult
{
    /**
     * Get the id of the result
     *
     * @abstract
     * @return String The id of the result, typically a DotbBean id.
     */
    public function getId();

    /**
     * Get the module name of the result
     *
     * @abstract
     * @return String
     *
     */
    public function getModule();

    /**
     * Get the translated module name of the result
     * @abstract
     * @return String
     */
    public function getModuleName();

    /**
     * Get the summary text of the result
     * @abstract
     * @return String
     */
    public function getSummaryText();

    /**
     * Return the highlighted text of a hit with the field name as the key
     *
     * @abstract
     *
     */
    public function getHighlightedHitText();


    /**
     * Never called within the view but helpful for debugging purposes.
     *
     * @abstract
     *
     */
    public function __toString();

}
