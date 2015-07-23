#!/bin/bash

rm -rf tests/tmp
rm -rf tests/output
composer dump-autoload

php code-checker/src/code-checker.php --short-arrays -d src
vendor/bin/tester tests -s -p php
