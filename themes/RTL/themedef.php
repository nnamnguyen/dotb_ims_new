<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

 
$themedef = array(
    'name'  => "Right to Left",
    'description' => "A Right to Left Theme",
    'directionality' => 'rtl',
    'parentTheme' => 'RacerX',
    'version' => array(
        'regex_matches' => array('\d{1,2}(\.\d+){2}(\.\d)?'),
        ),
    'group_tabs' => true,
    );
