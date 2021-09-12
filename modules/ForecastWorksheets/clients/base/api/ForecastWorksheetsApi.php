<?php



class ForecastWorksheetsApi extends DotbApi
{

    public function registerApiRest()
    {
        return array(
            'forecastWorksheetSave' => array(
                'reqType' => 'PUT',
                'path' => array('ForecastWorksheets', '?'),
                'pathVars' => array('module', 'record'),
                'method' => 'forecastWorksheetSave',
                'shortHelp' => 'Updates a ForecastWorksheet model',
                'longHelp' => 'modules/Forecasts/clients/base/api/help/ForecastWorksheetPut.html',
            ),
        );
    }

    /**
     * This method handles saving data for the /ForecastsWorksheet REST endpoint
     *
     * @param ServiceBase $api The API class of the request, used in cases where the API changes how the fields are pulled from the args array.
     * @param array $args The arguments array passed in from the API
     * @return array Worksheet data entries
     * @throws DotbApiExceptionNotAuthorized
     */
    public function forecastWorksheetSave(ServiceBase $api, array $args)
    {
        $obj = $this->getClass($args);
        $bean = $obj->save();

        return $this->formatBean($api, $args, $bean);
    }


    /**
     * @param array $args
     * @return DotbForecasting_Individual
     */
    protected function getClass(array $args)
    {
        // base file and class name
        $file = 'include/DotbForecasting/Individual.php';
        $klass = 'DotbForecasting_Individual';

        // check for a custom file exists
        DotbAutoLoader::requireWithCustom($file);
        $klass = DotbAutoLoader::customClass($klass);
        // create the class

        /* @var $obj DotbForecasting_AbstractForecast */
        $obj = new $klass($args);

        return $obj;
    }
}
