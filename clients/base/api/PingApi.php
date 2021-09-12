<?php


// A simple example class
class PingApi extends DotbApi {
    public function registerApiRest() {
        return array(
            'ping' => array(
                'reqType' => 'GET',
                'path' => array('ping'),
                'pathVars' => array(''),
                'method' => 'ping',
                'shortHelp' => 'An example API only responds with pong',
                'longHelp' => 'include/api/help/ping_get_help.html',
            ),
            'pingWithTime' => array(
                'reqType' => 'GET',
                'path' => array('ping', 'whattimeisit'),
                'pathVars' => array('', 'sub_method'),
                'method' => 'ping',
                'shortHelp' => 'An example API only responds with the current time in server format.',
                'longHelp' => 'include/api/help/ping_whattimeisit_get_help.html',
            ),
        );
    }

    public function registerApiSoap() {
        return array(
            'functions' => array(
                'ping' => array(
                    'methodName' => 'ping',
                    'requestVars' => array(
                    ),
                    'returnVars' => array(
                        'xsd:string',
                    ),
                    'method' => 'ping',
                    'shortHelp' => 'Sample/test API that only responds with pong',
                ),
                'pingWithTime' => array(
                    'methodName' => 'pingTime',
                    'requestVars' => array(
                    ),
                    'extraVars' => array(
                        'sub_method' => 'whattimeisit',
                    ),
                    'returnVars' => array(
                        'xsd:string',
                    ),
                    'method' => 'ping',
                    'shortHelp' => 'Sample/test API that responds with the curernt date/time',
                ),
            ),
            'types' => array(),
        );
    }

    public function ping(ServiceBase $api, array $args)
    {
        if ( isset($args['sub_method']) && $args['sub_method'] == 'whattimeisit' ) {
            $dt = new DotbDateTime();
            $td = new TimeDate();
            return $td->asIso($dt);
        }

        // Just a normal ping request
        return 'pong';
    }

}
