<?php


class DotbForecasting_Export_Individual extends DotbForecasting_Export_AbstractExport
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
        $file = 'modules/ForecastWorksheets/clients/base/api/ForecastWorksheetsFilterApi.php';
        $klass = 'ForecastWorksheetsFilterApi';
        DotbAutoLoader::requireWithCustom('include/api/RestService.php');
        DotbAutoLoader::requireWithCustom($file);
        $klass = DotbAutoLoader::customClass($klass);

        /* @var $obj ForecastWorksheetsFilterApi */
        $obj = new $klass();

        $api = new RestService();
        $api->user = $GLOBALS['current_user'];
        $data = $obj->forecastWorksheetsGet(
            $api,
            array(
                'module' => 'ForecastWorksheets',
                'timeperiod_id' => $this->getArg('timeperiod_id'),
                'user_id' => $this->getArg('user_id')
            )
        );

        $fields_array = array(
            'date_closed' => 'date_closed',
            'sales_stage' => 'sales_stage',
            'name' => 'name',
            'commit_stage' => 'commit_stage',
            'probability' => 'probability',
        );

        $admin = BeanFactory::newBean('Administration');
        $settings = $admin->getConfigForModule('Forecasts');

        if ($settings['show_worksheet_best']) {
            $fields_array['best_case'] = 'best_case';
        }

        if ($settings['show_worksheet_likely']) {
            $fields_array['likely_case'] = 'likely_case';
        }

        if ($settings['show_worksheet_worst']) {
            $fields_array['worst_case'] = 'worst_case';
        }

        $seed = BeanFactory::newBean('ForecastWorksheets');

        return $this->getContent($data['records'], $seed, $fields_array, 'commit_stage', $this->getArg('filters'));
    }


    /**
     * getFilename
     *
     * @return string name of the filename to export contents into
     */
    public function getFilename()
    {
        return sprintf("%s_rep_forecast", parent::getFilename());
    }

}
