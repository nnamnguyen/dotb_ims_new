<?php

class CapLeadAPIP extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'get_access_token_p' => array(
                'reqType' => 'GET',
                'path' => array('get_api_access_token'),
                'pathVars' => array(),
                'method' => 'getAccessToken',
                'noLoginRequired' => true,
            ),
            'cap_lead_p' => array(
                'reqType' => 'POST',
                'path' => array('cap_lead_v2'),
                'pathVars' => array(),
                'method' => 'capLeadAPI',
                'noLoginRequired' => true
            ),
        );
    }

    function getAccessToken(ServiceBase $api, array $args)
    {
        require_once 'custom/include/KTEncrypt.php';
        $kte = new KTEncrypt();
        $result = $GLOBALS['db']->query("select id from oauth_consumer where c_key='{$args['key']}' and c_secret='{$args['secret']}' and deleted=0");
        if ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            return array('success' => 1, 'expired' => time() + 3600, 'access_token' => $kte->encode('api_token_valid:' . time(), 'dotb@123'));
        }
        return array('success' => 0);
    }

    function capLeadAPI(ServiceBase $api, array $args)
    {
        /**
        * add by TKT
        * check valid access token
        */
        require_once 'custom/include/KTEncrypt.php';
        $kte = new KTEncrypt();
        if (empty($args['access_token'])) return array('success' => 0);
        $tmp = $kte->decode($args['access_token'], 'dotb@123');
        $tmp = explode(':', $tmp);
        if (count($tmp) != 2 || $tmp[0] != 'api_token_valid') return array('success' => 0, 'code' => '101', 'message' => 'Invalid access token');
        if (time() > ((int)$tmp[1] + 3600)) return array('success' => 0, 'code' => '102', 'message' => 'Session Timeout');

        $_POST = $args;
        include_once('custom/include/capLead.php');
    }
}
