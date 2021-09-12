<?php


class ForecastWorksheetsExportApi extends ExportApi
{
    /**
     * This function registers the Rest api
     */
    public function registerApiRest()
    {
        return array(
            'exportGet' => array(
                'reqType' => 'GET',
                'path' => array('ForecastWorksheets', 'export'),
                'pathVars' => array('module', ''),
                'method' => 'export',
                'rawReply' => true,
                'allowDownloadCookie' => true,
                'shortHelp' => 'Returns a record set in CSV format along with HTTP headers to indicate content type.',
                'longHelp' => 'include/api/help/module_export_get_help.html',
            ),
        );
    }

    public function export(ServiceBase $api, array $args = array())
    {
        ob_start();
        // Load up a seed bean
        $seed = BeanFactory::newBean('ForecastWorksheets');

        if (!$seed->ACLAccess('list')) {
            throw new DotbApiExceptionNotAuthorized('No access to view records for module: ' . $seed->object_name);
        }

        $args['timeperiod_id'] = isset($args['timeperiod_id']) ? $args['timeperiod_id'] : TimePeriod::getCurrentId();
        $args['user_id'] = isset($args['user_id']) ? $args['user_id'] : $api->user->id;
        if (!isset($args['filters'])) {
            $args['filters'] = array();
        } elseif (!is_array($args['filters'])) {
            $args['filters'] = array($args['filters']);
        }
        // don't allow encoding to html for data used in export
        $args['encode_to_html'] = false;

        // base file and class name
        $file = 'include/DotbForecasting/Export/Individual.php';
        $klass = 'DotbForecasting_Export_Individual';

        // check for a custom file exists
        DotbAutoLoader::requireWithCustom($file);
        $klass = DotbAutoLoader::customClass($klass);
        // create the class
        /* @var $obj DotbForecasting_Export_AbstractExport */
        $obj = new $klass($args);

        $content = $obj->process($api);
        ob_end_clean();

        return $this->doExport($api, $obj->getFilename(), $content);
    }
}
