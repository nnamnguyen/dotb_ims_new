<?php



/**
 * This class is an adapter to the existing DotbSpot/UnifiedSearch capabilities and is the default
 * search engine if no other external engines have been configured.
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
class DotbSearchEngine implements DotbSearchEngineInterface
{
    public function search($query, $offset = 0, $limit = 20, $options = array() )
    {
        $dotbSpot = new DotbSpot();
        return $dotbSpot->search($query, $offset, $limit, $options);

    }

    /**
     * No-op
     *
     * @param $bean
     */
    public function indexBean($bean, $batched = TRUE) {}

    /**
     * No-op
     *
     * @param $bean
     */
    public function delete(DotbBean $bean) {}


    /**
     * No-op
     */
    public function bulkInsert(array $docs) {}

    /**
     * No-op
     */
    public function createIndexDocument($bean, $searchFields = null) {}

    /**
     * No-op
     */
    public function getServerStatus() {}

    /**
     * No-op
     */
    public function createIndex($recreate = false){}

    /**
     *
     * Given a field type, determine whether this type can be enabled for full text search.
     *
     * @abstract
     * @param string $type Dotb field type
     * @return boolean whether the field type can be enabled for full text search
     */
    public function isTypeFtsEnabled($type)
    {
        return false;
    }

}
