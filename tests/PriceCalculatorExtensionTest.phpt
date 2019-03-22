<?php declare(strict_types=1);

namespace Sunfox\PriceCalculatorTests;

use Nette\Configurator;
use Nette\DI\Container;
use Sunfox\PriceCalculator\PriceCalculator;
use Sunfox\PriceCalculatorTests\Mocks\PriceCalculatorMock;
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

	public function testCustomCalculatorClass(): void
	{
		$factory = new PriceCalculatorFactory(PriceCalculatorMock::class);

		Assert::same(PriceCalculatorMock::class, $factory->getClass());
		Assert::same($factory, $factory->setClass(PriceCalculatorMock::class));
		Assert::type(PriceCalculatorMock::class, $factory->create());
	}
}

(new PriceCalculatorExtensionTest)->run();
