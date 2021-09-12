<?php



class ForecastManagerWorksheetsApi extends DotbApi
{
    public function registerApiRest()
    {
        //Extend with test method
        return array(
            'forecastManagerWorksheetAssignQuota' => array(
                'reqType' => 'POST',
                'path' => array('ForecastManagerWorksheets', 'assignQuota'),
                'pathVars' => array('module', 'action'),
                'method' => 'assignQuota',
                'shortHelp' => 'Assign the Quota for Users with out actually committing',
                'longHelp' => 'modules/Forecasts/clients/base/api/help/ForecastWorksheetManagerAssignQuota.html',
            )
        );
    }

    /**
     * Run the assign Quota Code.
     *
     * @param ServiceBase $api          API Service
     * @param array $args               Args from the XHR Call
     * @return array
     */
    public function assignQuota(ServiceBase $api, array $args = array())
    {
        /* @var $mgr_worksheet ForecastManagerWorksheet */
        $mgr_worksheet = $this->getBean($args['module']);
        $ret = $mgr_worksheet->assignQuota($args['user_id'], $args['timeperiod_id']);
        return array('success' => $ret);
    }

    /**
     * Utility method to get a bean
     *
     * @param string $module
     * @return DotbBean
     */
    protected function getBean($module)
    {
        return BeanFactory::newBean($module);
    }
}
