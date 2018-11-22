#!/bin/bash

DEPLOY_READY=$(wget http://production-review-tool.herokuapp.com/api/checkReadyToDeploy?app_name=$CIRCLE_PROJECT_REPONAME -q -O -)
[[ $DEPLOY_READY = *'"success":true'* ]] && exit 0 || echo "There are rejected commits"
exit 1
