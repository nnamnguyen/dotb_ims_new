<?php


class DotbForecasting_Export_Manager extends DotbForecasting_Export_AbstractExport
{
    /**
     * Constructor
     *
     * @param array $args
     */
    public function __construct($args)
    {
        parent::__construct($args);
    }

    public function process()
    {
        // fetch the data from the filter end point
        $file = 'modules/ForecastManagerWorksheets/clients/base/api/ForecastManagerWorksheetsFilterApi.php';
        $klass = 'ForecastManagerWorksheetsFilterApi';
        DotbAutoLoader::requireWithCustom('include/api/RestService.php');
        DotbAutoLoader::requireWithCustom($file);
        $klass = DotbAutoLoader::customClass($klass);

        /* @var $obj ForecastManagerWorksheetsFilterApi */
        $obj = new $klass();

        $api = new RestService();
        $api->user = $GLOBALS['current_user'];
        $data = $obj->ForecastManagerWorksheetsGet(
            $api,
            array(
                'module' => 'ForecastManagerWorksheets',
                'timeperiod_id' => $this->getArg('timeperiod_id'),
                'user_id' => $this->getArg('user_id')
            )
        );
        $data = $data['records'];

        $fields_array = array(
            'quota'=>'quota',
            'name'=>'name'
        );

        $admin = BeanFactory::newBean('Administration');
        $settings = $admin->getConfigForModule('Forecasts');

        if ($settings['show_worksheet_worst']) {
            $fields_array['worst_case'] = 'worst_case';
            $fields_array['worst_case_adjusted'] = 'worst_case_adjusted';
        }

        if ($settings['show_worksheet_likely']) {
            $fields_array['likely_case'] = 'likely_case';
            $fields_array['likely_case_adjusted'] = 'likely_case_adjusted';
        }

        if ($settings['show_worksheet_best']) {
            $fields_array['best_case'] = 'best_case';
            $fields_array['best_case_adjusted'] = 'best_case_adjusted';
        }

        $seed = BeanFactory::newBean('ForecastManagerWorksheets');

        return $this->getContent($data, $seed, $fields_array);
    }


    /**
     * getFilename
     *
     * @return string name of the filename to export contents into
     */
    public function getFilename()
    {
        return sprintf("%s_manager_forecast", parent::getFilename());
    }

}
