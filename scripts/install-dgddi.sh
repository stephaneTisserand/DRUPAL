﻿#!/bin/sh

# Proceed post-deploy (backups)
../bin/drush si --account-name=admin --account-pass=admin --site-name="Gestion de contenu DGDDI" --site-mail="do-not-replay@dgddi.fr" --locale=fr -y
../bin/drupal module:install dgddi_deploy -y
