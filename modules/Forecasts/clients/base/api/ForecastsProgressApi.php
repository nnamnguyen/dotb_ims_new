<?php




class ForecastsProgressApi extends ModuleApi
{

    /**
     * uuid for the selected user
     *
     * @var string
     */
	protected $user_id;
    /**
     * uuid for the current/selected timeperiod
     *
     * @var string
     */
	protected $timeperiod_id;
    /**
     * Opportunity Bean used to create the opportunity queries
     *
     * @var Opportunity
     */
	protected $opportunity;
    /**
     * array of sales stages to denote as closed('lost')
     *
     * @var array
     */
    protected $sales_stage_lost = Array();
    /**
     * array of sales stages to denote as closed('won')
     *
     * @var array
     */
    protected $sales_stage_won = Array();

    /**
     * Rest Api Registration Method
     *
     * @return array
     */
    public function registerApiRest()
    {
        return array(
            'progressRep' => array(
                'reqType'   => 'GET',
                'path'      => array('Forecasts', '?', 'progressRep', '?'),
                'pathVars'  => array('', 'timeperiod_id', '', 'user_id'),
                'method'    => 'progressRep',
                'shortHelp' => 'Projected Rep data',
                'longHelp' => 'modules/Forecasts/clients/base/api/help/ForecastProgressRepApi.html',
            ),
            'progressManager' => array(
                'reqType'   => 'GET',
                'path'      => array('Forecasts', '?', 'progressManager', '?'),
                'pathVars'  => array('', 'timeperiod_id', '', 'user_id'),
                'method'    => 'progressManager',
                'shortHelp' => 'Progress Manager data',
                'longHelp' => 'modules/Forecasts/clients/base/api/help/ForecastProgressManagerApi.html',
            )
        );
    }

    /**
     * loads data and passes back an array to communicate data that may be missing.  The array is the same
     *
     * @param ServiceBase $api
     * @param array $args
     * @return array
     */
    public function progressRep(ServiceBase $api, array $args)
    {
        $args['user_id'] = clean_string($args["user_id"]);
        $args['timeperiod_id'] = clean_string($args["timeperiod_id"]);

        // base file and class name
        $file = 'include/DotbForecasting/Progress/Individual.php';
        $klass = 'DotbForecasting_Progress_Individual';

        // check for a custom file exists
        DotbAutoLoader::requireWithCustom($file);
        $klass = DotbAutoLoader::customClass($klass);
        // create the class

        /* @var $obj DotbForecasting_AbstractForecast */
        $obj = new $klass($args);
        return $obj->process();
	}

    /**
     * loads data and passes back an array to communicate data that may be missing.  The array is the same
     *
     * @param ServiceBase $api
     * @param array $args
     * @return array
     */
    public function progressManager(ServiceBase $api, array $args)
    {
        $args['user_id'] = clean_string($args["user_id"]);
        $args['timeperiod_id'] = clean_string($args["timeperiod_id"]);

        // base file and class name
        $file = 'include/DotbForecasting/Progress/Manager.php';
        $klass = 'DotbForecasting_Progress_Manager';

        // check for a custom file exists
        DotbAutoLoader::requireWithCustom($file);
        $klass = DotbAutoLoader::customClass($klass);
        // create the class

        /* @var $obj DotbForecasting_AbstractForecast */
        $obj = new $klass($args);
        return $obj->process();
	}
}
