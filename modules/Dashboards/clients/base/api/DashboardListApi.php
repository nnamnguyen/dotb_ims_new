<?php



class DashboardListApi extends FilterApi
{
    protected static $mandatory_fields = array(
        'id',
        'name',
        'view_name'
    );

    /**
     * Rest Api Registration Method
     *
     * @return array
     */
    public function registerApiRest()
    {
        return array(
            'getDashboardsForModule' => array(
                'reqType' => 'GET',
                'minVersion' => '10',
                'maxVersion' => '10',
                'path' => array('Dashboards', '<module>'),
                'pathVars' => array('', 'module'),
                'method' => 'getDashboards',
                'shortHelp' => 'Get dashboards for a module',
                'longHelp' => 'include/api/help/get_dashboards.html',
                'cacheEtag' => true,
                'exceptions' => array(
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionError',
                    'DotbApiExceptionNotAuthorized',
                ),
            ),
            'getDashboardsForHome' => array(
                'reqType' => 'GET',
                'minVersion' => '10',
                'maxVersion' => '10',
                'path' => array('Dashboards'),
                'pathVars' => array(''),
                'method' => 'getDashboards',
                'shortHelp' => 'Get dashboards for home',
                'longHelp' => 'include/api/help/get_home_dashboards.html',
                'exceptions' => array(
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionError',
                    'DotbApiExceptionNotAuthorized',
                ),
            ),
            'getDashboardsForActivities' => array(
                'reqType' => 'GET',
                'minVersion' => '10',
                'maxVersion' => '10',
                'path' => array('Dashboards', 'Activities'),
                'pathVars' => array('', 'module'),
                'method' => 'getDashboards',
                'shortHelp' => 'Get dashboards for activity stream',
                'longHelp' => 'include/api/help/get_activities_dashboards.html',
                'cacheEtag' => true,
                'exceptions' => array(
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionError',
                    'DotbApiExceptionNotAuthorized',
                ),
            ),
        );
    }

    /**
     * Get the dashboards for the current user
     *
     * 'view' is deprecated because it's reserved db word.
     * Some old API (before 7.2.0) can use 'view'.
     * Because of that API will use 'view' as 'view_name' if 'view_name' isn't present.
     *
     * @param ServiceBase $api      The Api Class
     * @param array $args           Service Call Arguments
     * @return mixed
     * @throws DotbApiExceptionError If retrieving a predefined filter failed.
     * @throws DotbApiExceptionInvalidParameter If any arguments are invalid.
     * @throws DotbApiExceptionNotAuthorized If we lack ACL access.
     */
    public function getDashboards(ServiceBase $api, array $args)
    {
        if (empty($args['filter']) || !is_array($args['filter'])) {
            $args['filter'] = array();
        }

        // Tack on some required filters.
        $module = empty($args['module']) ? 'Home' : $args['module'];
        $args['filter'][]['dashboard_module'] = $module;

        $args['module'] = 'Dashboards';

        if (isset($args['view']) && !isset($args['view_name'])) {
            $args['view_name'] = $args['view'];
        }

        if (!empty($args['view_name'])) {
            $args['filter'][]['view_name'] = $args['view_name'];
        }
        $args['fields'] = 'id,name,view_name';

        $ret = $this->filterList($api, $args);

        // Add dashboard URL's
        foreach ($ret['records'] as $idx => $dashboard) {
            $ret['records'][$idx]['url'] = $api->getResourceURI('Dashboards/'.$dashboard['id']);
        }

        return $ret;
    }

    /**
     * Redefine the getoptions to pull in the correct Dashboard filters
     */
    protected function parseArguments(ServiceBase $api, array $args, DotbBean $seed = null)
    {
        if (!isset($args['order_by'])) {
            $args['order_by'] = 'date_entered:DESC';
        }
        $options = parent::parseArguments($api, $args, $seed);
        
        return $options;
    }

    /**
     *
     * The view parameter (in combination with view_name) is already in
     * use for Dashboards. The field list is never created from a
     * viewdef for dashboards anyway so we should remove it.
     *
     * @see DotbApi::getFieldsFromArgs()
     */
    protected function getFieldsFromArgs(
        ServiceBase $api,
        array $args,
        DotbBean $bean = null,
        $viewName = 'view',
        &$displayParams = array()
    ) {
        if (isset($args['view'])) {
            unset($args['view']);
        }
        return parent::getFieldsFromArgs($api, $args, $bean, $viewName, $displayParams);
    }
}
