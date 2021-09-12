<?php


class ForecastsModuleApi extends ModuleApi
{
    public function registerApiRest()
    {
        return array(
            'create' => array(
                'reqType' => 'POST',
                'path' => array('Forecasts'),
                'pathVars' => array('module'),
                'method' => 'createRecord',
                'shortHelp' => 'This method creates a new record of the specified type',
                'longHelp' => 'include/api/help/module_new_help.html',
            ),
        );
    }

    public function createRecord(ServiceBase $api, array $args)
    {
        if (!DotbACL::checkAccess('Forecasts', 'edit')) {
            throw new DotbApiExceptionNotAuthorized('No access to edit records for module: Forecasts');
        }

        $obj = $this->getClass($args);
        return $obj->save();
    }

    /**
     * Get the Committed Class
     *
     * @param array $args
     * @return DotbForecasting_Committed
     */
    protected function getClass(array $args)
    {
        // base file and class name
        $file = 'include/DotbForecasting/Committed.php';
        $klass = 'DotbForecasting_Committed';

        // check for a custom file exists
        DotbAutoLoader::requireWithCustom($file);
        $klass = DotbAutoLoader::customClass($klass);
        // create the class

        /* @var $obj DotbForecasting_AbstractForecast */
        $obj = new $klass($args);

        return $obj;
    }
}
