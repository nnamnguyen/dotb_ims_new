<?php

class StelCallCenter extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'stel_webhook' => array(
                'reqType' => 'GET',
                'path' => array('stel', 'webhook'),
                'pathVars' => array(''),
                'method' => 'webhook',
                'noLoginRequired' => true,
            )
        );
    }

    function webhook(ServiceBase $api, array $args)
    {
        return array('success'=>1);
    }
}