#!/usr/bin/env bash
SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )
ROOTPATH="$SCRIPTPATH/../../"

$ROOTPATH/vendor/bin/phpunit -c Tests/Build/phpunit.xml