<?php


$dotb_config['site_url'] = 'http://behat-tests-mango-ldap';
$dotb_config['verify_client_ip'] = false;
$dotb_config['logger']['channels']['authentication'] = array('level' => 'debug', 'processors' => ['backtrace']);

$dotb_config['idm_mode']['enabled'] = false;
