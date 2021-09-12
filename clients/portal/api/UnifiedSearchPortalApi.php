<?php


class UnifiedSearchPortalApi extends UnifiedSearchApi {
    /**
     * This function is used to determine the search engine to use
     * @param ServiceBase $api The API class of the request
     * @param array $args The arguments array passed in from the API
     * @param $options array An array of options to pass through to the search engine, they get translated to the $searchOptions array so you can see exactly what gets passed through
     * @return string name of the Search Engine
     */
    protected function determineDotbSearchEngine(ServiceBase $api, array $args, array $options)
    {
        return 'DotbSearchEngine';
    }
}
