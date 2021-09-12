<?php

use GuzzleHttp\Psr7\Request;

require_once __DIR__ . '/guzzlehttp/vendor/autoload.php';

class KTRequest
{
    function test()
    {
        $client = new GuzzleHttp\Client();
        $request = new Request('GET', 'http://httpbin.org');
        $promise = $client->sendAsync($request);
        $promise->wait(false);
    }
}

$a = new KTRequest();
$a->test();