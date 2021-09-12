<?php



$config = array (
  'name' => 'LotusLive',
  'eapm' => array(
    'enabled' => true,
    'only' => true,
  ),
  'order' => 16,
  'properties' => array (
      'oauth_consumer_key' => '',
      'oauth_consumer_secret' => '',
  ),
  'encrypt_properties' => array (
      'oauth_consumer_secret',
  ),
);
