<?php

namespace Sunfox\Tests;

use Nette;
use Tester;
use Tester\Assert;
use Sunfox\PriceCalculator\PriceCalculatorFactory;
use Sunfox\PriceCalculator\DI\PriceCalculatorExtension;


require_once __DIR__ . '/bootstrap.php';


class PriceCalculatorExtensionTest extends Tester\TestCase
{

	/**
	 * @return Nette\DI\Container
	 */
	protected function createContainer()
	{
		$config = new Nette\Configurator();
		$config->setTempDirectory(TEMP_DIR);
		PriceCalculatorExtension::register($config);
		// $config->addConfig(__DIR__ . '/files/config.neon', $config::NONE);

		return $config->createContainer();
	}

	public function testDI()
	{
		$dic = $this->createContainer();

		Assert::true($dic->getService('priceCalculator.factory') instanceof PriceCalculatorFactory);
	}

}


$test = new PriceCalculatorExtensionTest;
$test->run();
