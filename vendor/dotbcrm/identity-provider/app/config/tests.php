<?php


/* @var array $params here */
require __DIR__ . '/parameters.php';

$config['db']['db.options'] = [
    'driver' => $params['db_driver'],
    'host' => $params['db_host'],
    'port' => $params['db_port'],
    'dbname' => $params['db_name'],
    'user' => $params['db_user'],
    'password' => $params['db_password'],
    'charset' => $params['db_charset'],
];

$config['logdir'] = $params['logdir'];

$config['passwordHash'] = isset($params['passwordHash']) ? $params['passwordHash'] : [];

$config['monolog'] = isset($params['monolog']) ? $params['monolog'] : [];

$config['sts'] = isset($params['sts']) ? $params['sts'] : [];

$config['idm'] = isset($params['idm']) ? $params['idm'] : [];

$config['session.storage.options'] = isset($params['session.storage.options']) ? $params['session.storage.options'] : [];

$config['twig'] = $params['twig'] ?? [];

$config['discovery'] = $params['discovery'] ?? [];

$config['recaptcha'] = [
    'sitekey' => $params['recaptcha']['sitekey'] ?? '',
    'secretkey' => $params['recaptcha']['secretkey'] ?? '',
];

$config['honeypot'] = [
    'name' => $params['honeypot']['name'],
];
