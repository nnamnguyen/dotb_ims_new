<?php


$dotb_config['site_url'] = 'http://behat-tests-mango';
$dotb_config['verify_client_ip'] = false;
$dotb_config['passwordsetting']['userexpiration'] = '1';
$dotb_config['passwordsetting']['userexpirationtime'] = '90';
$dotb_config['passwordsetting']['SystemGeneratedPasswordON'] = '0';
$dotb_config['logger']['channels']['authentication'] = array('level' => 'debug', 'processors' => ['backtrace']);
