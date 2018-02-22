#!/bin/bash
if [ "$TRAVIS_BRANCH" == "master" ]; then
  curl -s "https://forge.laravel.com/servers/183115/sites/488203/deploy/http?token=$FORGE_TOKEN"
fi
