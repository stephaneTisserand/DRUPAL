#!/bin/sh

# Proceed post-deploy (backups)
../bin/drush si --account-name=admin --account-pass=admin -y
../bin/drupal module:install dgddi_deploy -y
