<?php
if(!empty($_GET['filename'])){
    require_once 'custom/include/guzzlehttp/vendor/autoload.php';
    $client = new GuzzleHttp\Client(array(
        'cookies' => true
    ));
    $response = $client->request('GET', 'https://42.112.210.63:8443/recapi?filename=' . $_GET['filename'], array(
        'verify' => false,
        'headers' => array(
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36',
            'Upgrade-Insecure-Requests' => 1,
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'en-US,en;q=0.9,lb;q=0.8',
            'Connection' => 'keep-alive'
        ),
        'auth' => ['cdrapi', 'cdrapi123', 'digest'],
        'sink' => 'result.wav'
    ));

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=" . $_GET['filename']);
    header("Content-Transfer-Encoding: binary");
    readfile('result.wav');
    unlink('result.wav');   
}
