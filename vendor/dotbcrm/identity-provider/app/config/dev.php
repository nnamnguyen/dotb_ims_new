<?php


// we extend the prod.php
require_once __DIR__ . '/prod.php';

$config['debug'] = true;

$config['monolog']['monolog.level'] = \Monolog\Logger::INFO;

$config['twig']['twig.options'] = ['cache' => false];
