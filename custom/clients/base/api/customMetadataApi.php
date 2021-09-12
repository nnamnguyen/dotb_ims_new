<?php

/**
 * Created by PhpStorm.
 * User: corina.bretan
 * Date: 24.04.2018
 * Time: 16:17
 */
class customMetadataApi extends MetadataApi
{

    public function registerApiRest()
    {
        return array(
            'getPublicMetadata' =>  array(
                'reqType' => 'GET',
                'path' => array('metadata','public'),
                'pathVars'=> array(''),
                'method' => 'getPublicMetadata',
                'shortHelp' => 'This method will return the metadata needed when not logged in',
                'longHelp' => 'include/api/html/metadata_all_help.html',
                'noLoginRequired' => true,
                'noEtag' => true,
                'ignoreMetaHash' => true,
                'ignoreSystemStatusError' => true,
            ),
        );
    }
    public function getPublicMetadata(ServiceBase $api, array $args)
    {
        $public_metadata =  parent::getPublicMetadata($api, $args);
        $public_metadata['config']['trial_expire_date'] = $GLOBALS['license']->settings['license_trial_expire_day'];
        return $public_metadata;
    }
}
