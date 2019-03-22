<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator\DI;

use Nette\Configurator;
use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;
use Sunfox\PriceCalculator\PriceCalculator;
use Sunfox\PriceCalculator\PriceCalculatorFactory;

final class PriceCalculatorExtension extends CompilerExtension
{
	/**
	 * @var string[]
	 */
	private $defaults = [
		'calculatorClass' => PriceCalculator::class,
	];

	public function loadConfiguration(): void
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('factory'))
			->setFactory(PriceCalculatorFactory::class, [$config['calculatorClass']]);
	}

	public static function register(Configurator $config): void
	{
		$config->onCompile[] = function (Configurator $config, Compiler $compiler): void {
			$compiler->addExtension('priceCalculator', new self);
		};
	}
}
