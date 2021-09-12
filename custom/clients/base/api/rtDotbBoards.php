<?php

if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class rtDotbBoards extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'validateLicense' => array(
                'reqType' => 'GET',
                'path' => array('rtDotbBoards', 'validate', '?'),
                'pathVars' => array('', '', 'key'),
                'method' => 'validateLicense',
            ),
            'verifyLicense' => array(
                'reqType' => 'GET',
                'path' => array('rtDotbBoards', 'verify'),
                'pathVars' => array('', '', ''),
                'method' => 'verifyLicense',
            ),
            'licenseKey' => array(
                'reqType' => 'GET',
                'path' => array('rtDotbBoards', 'licKey'),
                'pathVars' => array('', ''),
                'method' => 'licenseKey',
            ),
        );
    }

    public function validateLicense($api, $args)
    {
        return true;
    }


    public function verifyLicense()
    {
        return true;
    }

    public function licenseKey()
    {
        return 'dotb_key';
    }
}
