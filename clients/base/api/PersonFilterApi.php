<?php



class PersonFilterApi extends FilterApi {
    public function registerApiRest() {
        return array(
            'UserSearch' => array(
                'reqType' => 'GET',
                'path' => array('Users'),
                'jsonParams' => array('filter'),
                'pathVars' => array('module_list'),
                'method' => 'filterList',
                'shortHelp' => 'Search User records',
                'longHelp' => 'include/api/help/module_filter_get_help.html',
                'exceptions' => array(
                    // Thrown in filterList and filterListSetup
                    'DotbApiExceptionInvalidParameter',
                    // Thrown in filterListSetup and parseArguments
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionError',
                )
            ),
            'EmployeeSearch' => array(
                'reqType' => 'GET',
                'path' => array('Employees'),
                'jsonParams' => array('filter'),
                'pathVars' => array('module_list'),
                'method' => 'filterList',
                'shortHelp' => 'Search Employee records',
                'longHelp' => 'include/api/help/module_filter_get_help.html',
                'exceptions' => array(
                    // Thrown in filterList and filterListSetup
                    'DotbApiExceptionInvalidParameter',
                    // Thrown in filterListSetup and parseArguments
                    'DotbApiExceptionNotAuthorized',
                    'DotbApiExceptionError',
                )
            ),
        );
    }

    /**
     * {@inheritDoc}
     *
     * If $args['q'] is provided, run a global search instead of filtering.
     * Also applies default filters depending on what module is passed.
     *
     * @param ServiceBase $api The REST API object.
     * @param array $args REST API arguments.
     * @param string $acl Which type of ACL to check.
     * @return array The REST response as a PHP array.
     * @throws DotbApiExceptionError If retrieving a predefined filter failed.
     * @throws DotbApiExceptionInvalidParameter If any arguments are invalid.
     * @throws DotbApiExceptionNotAuthorized If we lack ACL access.
     */
    public function filterList(ServiceBase $api, array $args, $acl = 'list')
    {
        if (!empty($args['q'])) {
            return $this->globalSearch($api, $args);
        }

        $args['module'] = $args['module_list'];

        $api->action = 'list';
        list($args, $q, $options, $seed) = $this->filterListSetup($api, $args);

        $this->getCustomWhereForModule($args['module_list'], $q);

        return $this->runQuery($api, $args, $q, $options, $seed);
    }

    /**
     * This function is the global search
     * @param ServiceBase $api The API class of the request
     * @param array $args The arguments array passed in from the API
     * @return array result set
     */
    public function globalSearch(ServiceBase $api, array $args) {
        $api->action = 'list';
        // This is required to keep the loadFromRow() function in the bean from making our day harder than it already is.
        $GLOBALS['disable_date_format'] = true;
        $search = new UnifiedSearchApi();
        $options = $search->parseSearchOptions($api,$args);
        $options['custom_where'] = $this->getCustomWhereForModule($args['module_list']);

        $searchEngine = new DotbSpot();
        $options['resortResults'] = true;
        $recordSet = $search->globalSearchSpot($api,$args,$searchEngine,$options);
        
        return $recordSet;
    }

    /**
     * Gets the proper query where clause to use to prevent special user types from
     * being returned in the result
     * 
     * @param string $module The name of the module we are looking for
     * @return string
     */
    protected function getCustomWhereForModule($module, $query = null) {
        if ($query instanceof DotbQuery) {
            if ($module == 'Employees') {
                $query->where()->equals('employee_status', 'Active')->equals('show_on_employees','1');
                return;
            }
            $query->where()->equals('status', 'Active')->equals('portal_only', '0');
            return;
        }

        if ($module == 'Employees') {
            return "users.employee_status = 'Active' AND users.show_on_employees = 1";
        }
        
        return "users.status = 'Active' AND users.portal_only = 0";
    }
}
