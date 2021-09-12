<?php
$dictionary['OAuthKey'] = array('table' => 'oauth_consumer',
    'favorites'=>false,
    'comment' => 'OAuth consumer keys',
    'audited'=>false,
    'fields' => array (
          'c_key' =>
          array (
            'name' => 'c_key',
            'vname' => 'LBL_CONSKEY',
            'type' => 'varchar',
            'required' => true,
            'comment' => 'Consumer public key',
            'importable' => 'required',
            'massupdate' => 0,
            'reportable'=>false,
            'studio' => 'hidden',
          ),
          'c_secret' =>
          array (
            'name' => 'c_secret',
            'vname' => 'LBL_CONSSECRET',
            'type' => 'varchar',
              'required' => true,
            'comment' => 'Consumer secret key',
            'importable' => 'required',
            'massupdate' => 0,
            'reportable'=>false,
            'studio' => 'hidden',
          ),
          'tokens' =>
          array (
            'name' => 'tokens',
            'type' => 'link',
            'relationship' => 'consumer_tokens',
            'module'=>'OAuthTokens',
            'bean_name'=>'OAuthToken',
            'source'=>'non-db',
            'vname'=>'LBL_TOKENS',
          ),
          'oauth_type' =>
          array (
            'name' => 'oauth_type',
            'type' => 'enum',
            'options' => 'oauth_type_dom',
            'len' => 50,
            'comment' => 'Is this client an OAuth1 or OAuth2 client',
            'default'=>'oauth1',
            'vname'=>'LBL_OAUTH_TYPE',
          ),
          'client_type' =>
          array (
            'name' => 'client_type',
            'type' => 'enum',
            'options' => 'oauth_client_type_dom',
            'len' => 50,
            'comment' => 'What type of client does this key belong to, mobile, portal, UI or other.',
            'default' => 'user',
            'vname'=>'LBL_CLIENT_TYPE',
            'dependency'=>'equal($oauth_type,"oauth2")',
          ),
    ),
    'acls' => array('DotbACLAdminOnly' => true, 'DotbACLOAuthKeys' => true),
    'indices' => array (
       //array('name' =>'ckey', 'type' =>'unique', 'fields'=>array('c_key')),
       array('name' => 'idx_oauthkey_name', 'type' => 'index', 'fields' => array('name')),
       array('name' => 'idx_oauthkey_client_type', 'type' => 'index', 'fields' => array('client_type')),
    )
);
if (!class_exists('VardefManager')){
}
VardefManager::createVardef('OAuthKeys','OAuthKey', array('basic','assignable'));
