<?php


$dotb_config['site_url'] = 'http://behat-tests-mango-oidc.idm-ns-localhost';
$dotb_config['verify_client_ip'] = false;
$dotb_config['passwordsetting']['SystemGeneratedPasswordON'] = '0';

$dotb_config['idm_mode']['enabled'] = true;
$dotb_config['idm_mode']['clientId'] = 'mangoOIDCClientId';
$dotb_config['idm_mode']['clientSecret'] = 'mangoOIDCClientSecret';
$dotb_config['idm_mode']['stsUrl'] = 'http://sts.dotbcrm.local'; // or just http://sts.namespace
$dotb_config['idm_mode']['idpUrl'] = 'http://login.dotbcrm.local'; // or just http://idp.namespace
$dotb_config['idm_mode']['stsKeySetId'] = 'mangoOIDCKeySet';
$dotb_config['idm_mode']['http_client']['retry_count'] = 0;
$dotb_config['idm_mode']['http_client']['delay_strategy'] = 'linear';
$dotb_config['idm_mode']['tid'] = 'srn:cloud:iam:eu:0000000001:tenant';
$dotb_config['idm_mode']['crmOAuthScope'] = 'https://apis.dotbcrm.com/auth/crm';
$dotb_config['idm_mode']['requestedOAuthScopes'] = [
    'offline',
    'https://apis.dotbcrm.com/auth/crm',
    'profile',
    'email',
    'address',
    'phone',
];
$dotb_config['idm_mode']['cloudConsoleUrl'] = 'http://console.dotbcrm.local';
$dotb_config['idm_mode']['cloudConsoleRoutes']['passwordManagement'] = 'password-management';
$dotb_config['idm_mode']['cloudConsoleRoutes']['userCreate'] = 'user-create';
$dotb_config['idm_mode']['cloudConsoleRoutes']['userProfile'] = 'user-profile';
$dotb_config['idm_mode']['cloudConsoleRoutes']['forgotPassword'] = 'forgot-password';
