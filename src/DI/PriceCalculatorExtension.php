<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator\DI;

use Nette\Configurator;
use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Sunfox\PriceCalculator\PriceCalculator;
use Sunfox\PriceCalculator\PriceCalculatorFactory;

final class PriceCalculatorExtension extends CompilerExtension
{
	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'calculatorClass' => Expect::string(PriceCalculator::class),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('factory'))
			->setFactory(PriceCalculatorFactory::class, [$this->config->calculatorClass]);
	}

	public static function register(Configurator $config): void
	{
		$config->onCompile[] = function (Configurator $config, Compiler $compiler): void {
			$compiler->addExtension('priceCalculator', new self);
		};
	}
}
