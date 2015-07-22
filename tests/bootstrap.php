<?php

// The Nette Tester command-line runner can be
// invoked through the command: ../vendor/bin/tester .

if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer update --dev`';
	exit(1);
}


require __DIR__ . '/../src/PriceCalculator/PriceCalculatorInterface.php';
require __DIR__ . '/../src/PriceCalculator/PriceCalculator.php';
require __DIR__ . '/../src/PriceCalculator/PriceCalculatorFactoryInterface.php';
require __DIR__ . '/../src/PriceCalculator/PriceCalculatorFactory.php';
require __DIR__ . '/../src/PriceCalculator/PriceCalculatorResult.php';


Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');


// create temporary directory
define('TEMP_DIR', __DIR__ . '/tmp/' . getmypid());
@mkdir(dirname(TEMP_DIR)); // @ - directory may already exist
Tester\Helpers::purge(TEMP_DIR);
