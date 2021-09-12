<?php

$hook_array['before_retrieve'][] = array (
    1,
    'DRI_Workflows\ConnectorHelper::checkLicense',
    'modules/DRI_Workflows/ConnectorHelper.php',
    'DRI_Workflows\ConnectorHelper',
    'checkLicenseBeanHook'
);

$hook_array['before_save'][] = array (
    1,
    'DRI_Workflows\ConnectorHelper::checkLicense',
    'modules/DRI_Workflows/ConnectorHelper.php',
    'DRI_Workflows\ConnectorHelper',
    'checkLicenseBeanHook'
);

$hook_array['before_delete'][] = array (
    1,
    'DRI_Workflows\ConnectorHelper::checkLicense',
    'modules/DRI_Workflows/ConnectorHelper.php',
    'DRI_Workflows\ConnectorHelper',
    'checkLicenseBeanHook'
);
