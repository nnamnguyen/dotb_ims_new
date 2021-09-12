<?php


// This class is used for the Manager Views
class DotbForecasting_Manager extends DotbForecasting_AbstractForecast implements DotbForecasting_ForecastSaveInterface
{

    /**
     * Class Constructor
     *
     * @param array $args       Service Arguments
     */
    public function __construct($args)
    {
        // set the isManager Flag just incase we need it
        $this->isManager = true;

        parent::__construct($args);

        // set the default data timeperiod to the set timeperiod
        $this->defaultData['timeperiod_id'] = $this->getArg('timeperiod_id');
    }

    /**
     * Run all the tasks we need to process get the data back
     *
     * @deprecated @see ForecastManagerWorksheetsFilterApi
     * @return array
     */
    public function process()
    {
        return array();
    }

    /**
     * Save the Manager Worksheet, This method is deprecated and should be done though use of
     * the ForecastManagerWorksheet bean
     *
     * @deprecated
     * @return string
     */
    public function save()
    {
        return '';
    }
}
