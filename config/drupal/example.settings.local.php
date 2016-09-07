<?php

// Define ROOT PATH
$rootpath = '/var/www/html';

// Set up Trusted Hosts
$settings['trusted_host_patterns'] = array(
  '^dgddi\.loc$',
);

// Enable file based configuration storage (see: https://www.drupal.org/node/2416555)
//$settings['bootstrap_config_storage'] = array('Drupal\Core\Config\BootstrapConfigStorageFactory', 'getFileStorage');

$config_directories['local'] = $rootpath . '/config/drupal/local/';
$config_directories['deploy'] = $rootpath . '/config/drupal/deploy/';
$config_directories[CONFIG_SYNC_DIRECTORY] = $rootpath . '/config/drupal/sync/';

// Set up Database credentials
$databases['default']['default'] = array (
  'database' => 'dbpostgres',
  'username' => 'dbusr',
  'password' => 'dbpwd',
  'prefix' => 'drupal_',
  'host' => 'postgres',
  'port' => '5432',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\pgsql',
  'driver' => 'pgsql',
);

$settings['hash_salt'] = '9wLTZXw8QhT60Y-iJHUgINHcFyaFgKnqV2OQj4vGu25R0ZDGSu9F1vwc4SEfO7dVIsnuNbS5jA';
$settings['install_profile'] = 'minimal';