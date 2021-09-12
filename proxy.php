<?php
$filter_request = curl_init($_POST['url']);
curl_setopt($filter_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
curl_setopt($filter_request, CURLOPT_CUSTOMREQUEST, $_POST['method']);
curl_setopt($filter_request, CURLOPT_HEADER, false);
curl_setopt($filter_request, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($filter_request, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($filter_request, CURLOPT_FOLLOWLOCATION, 0);

if (!empty($_POST['token'])) {
    curl_setopt($filter_request, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "oauth-token: " . $_POST['token']
    ));
} else {
    curl_setopt($filter_request, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));
}


if (!empty($_POST['data'])) {
    curl_setopt($filter_request, CURLOPT_POSTFIELDS, $_POST['data']);
}

$filter_response = curl_exec($filter_request);
ob_clean();
header("Access-Control-Allow-Origin: *");
echo $filter_response;
exit;
