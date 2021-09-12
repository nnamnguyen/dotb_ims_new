<?php
$count_config = count($_POST['user_id']);
for($i = 0; $i < ($count_config - 1); $i++){
    $callcenter_config[$i]['user_id'] = $_POST['user_id'][$i];
    $callcenter_config[$i]['ip'] = $_POST['ip'][$i];
    $callcenter_config[$i]['ext'] = $_POST['ext'][$i];
    $callcenter_config[$i]['chanel'] = $_POST['chanel'][$i];
    $callcenter_config[$i]['context'] = $_POST['context'][$i];
}

$admin = new Administration();
$admin->retrieveSettings();
$admin->saveSetting('default', 'callcenter_config', json_encode($callcenter_config));

echo 1;