<?php

class changeModuleIcon extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'get_change_module_icon' => array(
                'reqType' => 'GET',
                'path' => array('get_change_module_icon'),
                'pathVars' => array(''),
                'method' => 'getChangeModuleIcon',
                'shortHelp' => '',
                'longHelp' => '',
            ),
            'set_change_module_icon' => array(
                'reqType' => 'PUT',
                'path' => array('set_change_module_icon'),
                'pathVars' => array(''),
                'method' => 'setChangeModuleIcon',
                'shortHelp' => '',
                'longHelp' => '',
            ),
        );
    }

    function getChangeModuleIcon(ServiceBase $api, array $args)
    {
        global $beanList;
        $listBeanIcon = array(
            'Calendar' => 'Calendar',
            'all_tasks' => 'all_tasks',
            'archived_emails' => 'archived_emails',
            'direct_reports' => 'direct_reports',
            'billing_quotes' => 'billing_quotes',
            'contacts_sms' => 'contacts_sms',
        );

        foreach ($beanList as $key => $value)
            if (empty($listBeanIcon[$key])) $listBeanIcon[$key] = $key;

        $result = array();
        $data = file_get_contents('custom/include/module_icon.json');
        if (empty($data)) {
            foreach ($listBeanIcon as $key => $value) {
                $result[$key] = "";
            }
        } else {
            $data = json_decode($data, true);
            foreach ($listBeanIcon as $key => $value)
                if (empty($data[$key])) $data[$key] = "";
            return $data;
        }
        return $result;
    }

    function setChangeModuleIcon(ServiceBase $api, array $args)
    {
        file_put_contents('custom/include/module_icon.json', json_encode($args['data']));
        return array("success" => 1);
    }

}