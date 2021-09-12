<?php

// Enrico Simonetti
// enricosimonetti.com
// 2018-10-19 on 8.0.0 with MySQL

// Run with: ./bin/dotbcrm activitystream:cleanup

$commandregistry = Dotbcrm\Dotbcrm\Console\CommandRegistry\CommandRegistry::getInstance();
$commandregistry->addCommands(array(new Dotbcrm\Dotbcrm\custom\Console\Command\ActivityStreamCleanup\ActivityStreamCleanupCommand()));
