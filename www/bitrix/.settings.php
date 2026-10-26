<?php
// Provision this file outside the web root; never commit deployment credentials.
$deploymentCredentials = require '/etc/bitrix/credentials.php';
foreach (array('crypto_key', 'db_host', 'db_name', 'db_user', 'db_password') as $credentialName) {
    if (!is_array($deploymentCredentials) || !isset($deploymentCredentials[$credentialName])
        || !is_string($deploymentCredentials[$credentialName]) || $deploymentCredentials[$credentialName] === ''
        || strpos($deploymentCredentials[$credentialName], 'YOUR_') === 0) {
        throw new RuntimeException('Missing required external Bitrix credential: ' . $credentialName);
    }
}

return array (
  'utf_mode' =>
  array (
    'value' => true,
    'readonly' => true,
  ),
  'cache_flags' =>
  array (
    'value' =>
    array (
      'config_options' => 3600,
      'site_domain' => 3600,
    ),
    'readonly' => false,
  ),
  'cookies' =>
  array (
    'value' =>
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
  'exception_handling' =>
  array (
    'value' =>
    array (
      'debug' => false,
      'handled_errors_types' => 4437,
      'exception_errors_types' => 4437,
      'ignore_silence' => false,
      'assertion_throws_exception' => true,
      'assertion_error_type' => 256,
      'log' => array (
          'settings' =>
          array (
            'file' => '/var/log/php/exceptions.log',
            'log_size' => 1000000,
        ),
      ),
    ),
    'readonly' => false,
  ),
  'crypto' => 
  array (
    'value' => 
    array (
        'crypto_key' => $deploymentCredentials['crypto_key'],
    ),
    'readonly' => true,
  ),
  'connections' =>
  array (
    'value' =>
    array (
      'default' =>
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
        'host' => $deploymentCredentials['db_host'],
        'database' => $deploymentCredentials['db_name'],
        'login'    => $deploymentCredentials['db_user'],
        'password' => $deploymentCredentials['db_password'],
        'options' => 2,
      ),
    ),
    'readonly' => true,
  )
);
