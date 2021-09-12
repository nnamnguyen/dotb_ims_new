<?php

class OncallCallCenter extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'oncall_webhook' => array(
                'reqType' => 'GET',
                'path' => array('oncall', 'webhook'),
                'pathVars' => array(''),
                'method' => 'webhook',
                'noLoginRequired' => true,
            ),
            'oncall_webhook_' => array(
                'reqType' => 'POST',
                'path' => array('oncall', 'webhook'),
                'pathVars' => array(''),
                'method' => 'webhook',
                'noLoginRequired' => true,
            )
        );
    }

    function webhook(ServiceBase $api, array $args)
    {
//        include 'custom/include/serverSocket/socket.io.class.php';
//        $socket = new SocketIO('18.140.92.134', 3001);
        $GLOBALS['log']->fatal($args);

        /**
         * call out
         * source ext
         * destination 091324
         */

        /**
         * call in
         * source 091233
         * des ext
         */

        /**
         * ext -> user_id
         */


//        $socket->send(array(
//            'receiver_id' => 'user_id',
//            'data' => $args
//        ));
    }
}