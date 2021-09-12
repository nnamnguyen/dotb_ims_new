<?php



class OpportunitiesEnumApi extends ModuleApi
{
    public function registerApiRest()
    {
        return array(
            'enum' => array(
                'reqType' => 'GET',
                'path' => array('Opportunities', 'enum', '?'),
                'pathVars' => array('module', 'enum', 'field'),
                'method' => 'getEnumValues',
                'shortHelp' => 'This method returns enum values for a specified field',
                'longHelp' => 'include/api/help/module_enum_get_help.html',
            ),
        );
    }

    public function getEnumValues(ServiceBase $api, array $args)
    {
        // if the field is not opps_view_by, go up to the parent
        if ($args['field'] !== 'opps_view_by') {
            return parent::getEnumValues($api, $args);
        } else {
            global $app_list_strings, $app_strings, $current_language;
            $value = $app_list_strings['opps_config_view_by_options_dom'];
            $value['Opportunities'] = $app_list_strings['moduleList']['Opportunities'];
            $value['RevenueLineItems'] = $app_list_strings['moduleList']['Opportunities'] .
                ' ' . $app_strings['LBL_DNB_AND'] . ' ';

            if (isset($app_list_strings['moduleList']['RevenueLineItems'])) {
                $value['RevenueLineItems'] .= $app_list_strings['moduleList']['RevenueLineItems'];
            } else {
                // when it's not enabled, the RLI module is not in the moduleList, so we need to
                // pull it from the module lang file
                $moduleLang = return_module_language($current_language, 'RevenueLineItems');
                $value['RevenueLineItems'] .= $moduleLang['LBL_MODULE_NAME'];
            }

            generateEtagHeader(md5(serialize($value)), 3600);
            return $value;
        }

        // opps_view_by

    }
}
