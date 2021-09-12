<?php



abstract class PMSEFilterApi extends FilterApi
{
    /**
     * @var String Define the PA module name
     */
    public $apiRoute = '';
    /**
     * @var String Define field that storage Target Module
     */
    public static $filterModuleField = '';

    /**
     * Return $apiRoute value
     * @return String
     */
    public function getApiRoute() {
        return $this->apiRoute;
    }

    /**
     * Returns $filterModuleField value
     * @return String
     */
    public static function getFilterModuleField() {
        return static::$filterModuleField;
    }


    /**
     * @inheritdoc
     */
    public function registerApiRest()
    {
        return array(
            'filterModuleAll' => array(
                'reqType' => 'GET',
                'path' => array($this->getApiRoute()),
                'pathVars' => array('module'),
                'method' => 'filterList',
                'jsonParams' => array('filter'),
                'shortHelp' => 'List of all records in this module',
                'longHelp' => 'include/api/help/module_filter_get_help.html',
                'exceptions' => array(
                    'DotbApiExceptionNotFound',
                    'DotbApiExceptionError',
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionNotAuthorized',
                ),
            ),
        );
    }

    /**
     * @inheritdoc
     */
    protected static function addFilters(array $filterDefs, DotbQuery_Builder_Where $where, DotbQuery $q) {
        // Adding new filter to respect ACL PA Target module
        $newFilter = array(
            self::getFilterModuleField() => array(
                '$in' => DotbACL::filterModuleList(PMSEEngineUtils::getSupportedModules(), 'access', true)
            )
        );
        $filterDefs[] = $newFilter;
        parent::addFilters($filterDefs, $where, $q);
    }
}
