#!/bin/sh

# Set up some variables
export CURRENTPATH=${PWD}
export POSTDEPLOYFILE=$CURRENTPATH/../scripts/post-deploy-dgddi.yml
export DEPLOYFILE=$CURRENTPATH/../scripts/deploy-dgddi.yml
export ROLLBACKFILE=$CURRENTPATH/../scripts/rollback-dgddi.yml

# Proceed post-deploy (backups)
../bin/drupal chain --file=$POSTDEPLOYFILE -y

if [ $? -eq 0 ]; then
    # Proceed DB updates
    ../bin/drush/drush updb -y

    # Check status & rollback
    if [ $? -eq 0 ]; then
        echo "OK: All DB update steps successfully passed!"

        # Proceed post-deploy (backups)
        ../bin/drupal chain --file=$DEPLOYFILE -y

        if [ $? -eq 0 ]; then
            echo "OK: All update steps successfully passed!"
        else
            echo "FAIL: Updates - Rollback in progress..."
            ../bin/drupal chain --file=$ROLLBACKFILE -y
            echo "OK: Successfully rollbacked!"
        fi

    else
        echo "FAIL: DB updates - Rollback in progress..."
        ../bin/drupal chain --file=$ROLLBACKFILE -y
        echo "OK: Successfully rollbacked!"
    fi
else
    echo "post-deploy script failed: abort execution."
fi