<?php





/**
 * Module collection API
 */
class ModuleCollectionApi extends CollectionApi
{
    /** {@inheritDoc} */
    protected static $sourceKey = '_module';

    /** @var FilterApi */
    protected $filterApi;

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
                'path' => array('collection', '?'),
                'pathVars' => array('', 'collection_name'),
                'method' => 'getCollection',
                'shortHelp' => 'Lists collection records.',
                'longHelp' => 'include/api/help/collection_collection_name_get_help.html',
                'exceptions' => array(
                    'DotbApiExceptionNotFound',
                    'DotbApiExceptionError',
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionNotAuthorized',
                ),
            ),
            'getCollectionCount' => array(
                'reqType' => 'GET',
                'path' => array('collection', '?', 'count'),
                'pathVars' => array('', 'collection_name', ''),
                'method' => 'getCollectionCount',
                'shortHelp' => 'Counts collection records.',
                'longHelp' => 'include/api/help/collection_collection_name_count_get_help.html',
                'exceptions' => array(
                    'DotbApiExceptionNotFound',
                    'DotbApiExceptionError',
                    'DotbApiExceptionNotAuthorized',
                ),
            ),
        );
    }

    /** {@inheritDoc} */
    protected function getCollectionDefinition(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array('collection_name'));

        $definition = new ModuleCollectionDefinition($args['collection_name']);

        return $definition;
    }

    /** {@inheritDoc} */
    protected function getSourceData(ServiceBase $api, $source, array $args)
    {
        $args['module'] = $source;
        return $this->getFilterApi()->filterList($api, $args);
    }

    /** {@inheritDoc} */
    protected function getSourceCount(ServiceBase $api, $source, array $args)
    {
        $args['module'] = $source;
        return $this->getFilterApi()->filterListCount($api, $args);
    }

    /** {@inheritDoc} */
    protected function getDefaultLimit()
    {
        return $this->getFilterApi()->getDefaultLimit();
    }

    /**
     * Lazily loads Filter API
     *
     * @return FilterApi
     */
    protected function getFilterApi()
    {
        if (!$this->filterApi) {
            $this->filterApi = new FilterApi();
        }

        return $this->filterApi;
    }
}
