<?php



class TimePeriodsFilterApi extends FilterApi
{
    public function registerApiRest()
    {
        return array(
            'filterModuleGet' => array(
                'reqType' => 'GET',
                'path' => array('TimePeriods', 'filter'),
                'pathVars' => array('module', ''),
                'method' => 'filterList',
                'jsonParams' => array('filter'),
                'shortHelp' => 'Lists filtered records.',
                'longHelp' => 'include/api/help/module_filter_get_help.html',
                'exceptions' => array(
                    'DotbApiExceptionNotFound',
                    'DotbApiExceptionError',
                    'DotbApiExceptionInvalidParameter',
                    'DotbApiExceptionNotAuthorized',
                ),
            ),
            'filterModuleAll' => array(
                'reqType' => 'GET',
                'path' => array('TimePeriods'),
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

    public function filterList(ServiceBase $api, array $args, $acl = 'list')
    {
        $forecastSettings = Forecast::getSettings();
        if ($forecastSettings['is_setup'] === 1 && !isset($args['use_generic_timeperiods'])) {
            return parent::filterList($api, $args, $acl);
        }

        // since forecast is not setup, we more than likely don't have timeperiods, so grab the default 3
        $tp = BeanFactory::newBean('TimePeriods');
        $data = array();
        $data['next_offset'] = -1;
        $data['records'] = array();
        $app_list_strings = return_app_list_strings_language($GLOBALS['current_language']);
        $options = $app_list_strings['generic_timeperiod_options'];

        foreach ($options as $duration => $name) {
            $data['records'][] = array_merge(
                array(
                    'id' => $duration,
                    'name' => $name,
                ),
                $tp->getGenericStartEndByDuration($duration)
            );
        }

        return $data;
    }
}
