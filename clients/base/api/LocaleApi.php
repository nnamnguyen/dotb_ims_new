<?php


class LocaleApi extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'retrieve' => array(
                'reqType' => 'GET',
                'path' => array('locale'),
                'pathVars' => array(),
                'method' => 'localeOptions',
                'shortHelp' => 'Gets locale options so UI can populate the corresponding dropdowns',
                'longHelp' => 'include/api/help/locale_options_get_help.html',
                'ignoreMetaHash' => true,
                'keepSession' => true,
            ),
        );
    }

    public function localeOptions(ServiceBase $api, array $args)
    {
        global $locale, $dotb_config;
        return array(
            'timepref' => $dotb_config['time_formats'],
            'datepref' => $dotb_config['date_formats'],
            'default_locale_name_format' => $locale->getUsableLocaleNameOptions($dotb_config['name_formats']),
            'timezone' => TimeDate::getTimezoneList(),
        );
    }

}

