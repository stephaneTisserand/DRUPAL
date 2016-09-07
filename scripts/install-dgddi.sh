#!/bin/sh

# The Drupal Console way
#export CURRENTPATH=${PWD}
#export DEPLOYFILE=$CURRENTPATH/../scripts/deploy-dgddi.yml
#../bin/drupal chain --file=$DEPLOYFILE

# The Drush way
drush sql-dump > ../data/db/dgddi_backup.sql
drush config-export local
drush updb
drush config-import deploy -y
drush cr all