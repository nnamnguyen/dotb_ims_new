<?php





/**
 * Collection API
 */
class RelateCollectionApi extends CollectionApi
{
    /** {@inheritDoc} */
    protected static $sourceKey = '_link';

    /** @var RelateApi */
    protected $relateApi;

    /**
     * Primary bean corresponding to the current API arguments.
     *
     * We need to pass it to DotbApi::getFieldsFromArgs() from within parent::getSourceArguments(),
     * but generic collection interface does not operate primary bean
     *
     * @var DotbBean
     */
    protected $bean;

    /**
     * Registers API
     *
     * @return array
     * @codeCoverageIgnore
     */
    public function registerApiRest()
    {
        return array(
            'getCollection' => array(
                'reqType' => 'GET',
                'path' => array('<module>', '?', 'collection', '?'),
                'pathVars' => array('module', 'record', '', 'collection_name'),
                'method' => 'getCollection',
                'shortHelp' => 'Lists collection records.',
                'longHelp' => 'include/api/help/module_record_collection_collection_name_get_help.html',
            ),
            'getCollectionCount' => array(
                'reqType' => 'GET',
                'path' => array('<module>', '?', 'collection', '?', 'count'),
                'pathVars' => array('module', 'record', '', 'collection_name', ''),
                'method' => 'getCollectionCount',
                'shortHelp' => 'Counts collection records.',
                'longHelp' => 'include/api/help/module_record_collection_collection_name_count_get_help.html',
            ),
        );
    }

    /** {@inheritDoc} */
    protected function getCollectionDefinition(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array('module', 'collection_name'));
        $bean = $this->bean = BeanFactory::newBean($args['module']);

        $definition = new RelateCollectionDefinition($bean, $args['collection_name']);

        return $definition;
    }

    /** {@inheritDoc} */
    protected function getSourceData(ServiceBase $api, $source, array $args)
    {
        $args['link_name'] = $source;
        return $this->getRelateApi()->filterRelated($api, $args);
    }

    /** {@inheritDoc} */
    protected function getSourceCount(ServiceBase $api, $source, array $args)
    {
        $args['link_name'] = $source;
        return $this->getRelateApi()->filterRelatedCount($api, $args);
    }

    /** {@inheritDoc} */
    protected function getDefaultLimit()
    {
        global $dotb_config;
        global $log;

        if (empty($dotb_config['list_max_entries_per_subpanel'])) {
            $log->warn('Default subpanel entry limit is not configured');
            return 5;
        }

        return $dotb_config['list_max_entries_per_subpanel'];
    }

    /**
     * Lazily loads Relate API
     *
     * @return RelateApi
     */
    protected function getRelateApi()
    {
        if (!$this->relateApi) {
            $this->relateApi = new RelateApi();
        }

        return $this->relateApi;
    }
}
