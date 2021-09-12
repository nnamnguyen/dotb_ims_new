<?php

class defaultPresetImport extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'get-default-preset-import' => array(
                'reqType' => 'GET',
                'path' => array('get-default-preset-import'),
                'pathVars' => array(''),
                'method' => 'getDefaultPresetImport',
                'shortHelp' => '',
                'longHelp' => '',
            ),
            'set-default-preset-import' => array(
                'reqType' => 'PUT',
                'path' => array('set-default-preset-import'),
                'pathVars' => array(''),
                'method' => 'setDefaultPresetImport',
                'shortHelp' => '',
                'longHelp' => '',
            ),
        );
    }

    function getDefaultPresetImport(ServiceBase $api, array $args)
    {
        $admin = new Administration();
        $admin->retrieveSettings();

        //load import mapping record
        $sql = "select id, name, module from import_maps WHERE deleted <> 1 ANd is_published = 'yes'";
        $rs = $GLOBALS['db']->query($sql);
        $mappingLeadArr = array('none' => '');
        $mappingContactArr = array('none' => '');
        $mappingProspectArr = array('none' => '');
        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            if ($row['module'] == 'Leads') $mappingLeadArr[$row['id']] = $row['name'];
            if ($row['module'] == 'Contacts') $mappingContactArr[$row['id']] = $row['name'];
            if ($row['module'] == 'Prospects') $mappingProspectArr[$row['id']] = $row['name'];
        }
        $mappingLeadDefault = $admin->settings['default_mapping_lead'];
        $mappingContactDefault = $admin->settings['default_mapping_contact'];
        $mappinpProspectDefault = $admin->settings['default_mapping_prospect'];

        return array(
            'lead' => array(
                'default' => $mappingLeadDefault,
                'option' => $mappingLeadArr
            ),
            'contact' => array(
                'default' => $mappingContactDefault,
                'option' => $mappingContactArr
            ),
            'prospect' => array(
                'default' => $mappinpProspectDefault,
                'option' => $mappingProspectArr
            ),
        );
    }

    function setDefaultPresetImport(ServiceBase $api, $args)
    {
        $admin = new Administration();
        $admin->retrieveSettings();
        $admin->saveSetting('default', 'mapping_lead', $args['default_mapping_lead']);
        $admin->saveSetting('default', 'mapping_contact', $args['default_mapping_contact']);
        $admin->saveSetting('default', 'mapping_prospect', $args['default_mapping_prospect']);

        return array("success" => 1);
    }
}