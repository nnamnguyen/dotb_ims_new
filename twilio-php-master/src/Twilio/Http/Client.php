<?php


namespace Twilio\Http;
require_once 'twilio-php-master/src/Twilio/Rest/Lookups/V1.php';
require_once 'twilio-php-master/src/Twilio/Rest/Lookups.php';

interface Client {
    public function request($method, $url, $params = array(), $data = array(),
                            $headers = array(), $user = null, $password = null,
                            $timeout = null);
}