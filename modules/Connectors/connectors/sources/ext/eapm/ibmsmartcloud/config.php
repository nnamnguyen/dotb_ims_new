<?php



$config = array (
  'name' => 'IBM SmartCloud',
  'eapm' => array(
    'enabled' => true,
    'only' => true,
  ),
  'order' => 14,
  'properties' => array (
      'oauth_consumer_key' => '',
      'oauth_consumer_secret' => '',
  ),
  'encrypt_properties' => array (
      'oauth_consumer_secret',
  ),
);
