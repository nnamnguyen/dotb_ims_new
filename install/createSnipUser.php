<?php

if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');


installLog("creating new user for Snip");

$snip = DotbSNIP::getInstance();
$snip->getSnipUser();

?>
