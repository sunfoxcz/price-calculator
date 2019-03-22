<?php declare(strict_types=1);

namespace Sunfox\Tests;

use Nette\Configurator;
use Nette\DI\Container;
use Sunfox\PriceCalculator\PriceCalculator;
use Tester;
use Tester\Assert;
use Sunfox\PriceCalculator\PriceCalculatorFactory;
use Sunfox\PriceCalculator\DI\PriceCalculatorExtension;

require_once __DIR__ . '/bootstrap.php';

final class PriceCalculatorExtensionTest extends Tester\TestCase
{
	protected function createContainer(): Container
	{
		$config = new Configurator();
		$config->setTempDirectory(TEMP_DIR);
		PriceCalculatorExtension::register($config);

		return $config->createContainer();
	}

	public function testDI(): void
	{
		$dic = $this->createContainer();

		Assert::type(PriceCalculatorFactory::class, $dic->getService('priceCalculator.factory'));
		Assert::type(PriceCalculator::class, $dic->getService('priceCalculator.factory')->create());
	}
}

(new PriceCalculatorExtensionTest)->run();
