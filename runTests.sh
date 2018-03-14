#!/bin/bash

rm -rf tests/tmp
rm -rf tests/output
composer dump-autoload

vendor/bin/tester tests -s -p php -c tests/php.ini
