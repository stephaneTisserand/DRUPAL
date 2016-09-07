#!/bin/sh

# Set up some variables
export CURRENTPATH=${PWD}
export ROLLBACKFILE=$CURRENTPATH/../scripts/rollback-dgddi.yml

# Proceed post-deploy (backups)
../bin/drupal chain --file=$ROLLBACKFILE -y
echo "OK: Successfully rollbacked!"
