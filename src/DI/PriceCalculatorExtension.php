<?php

namespace Sunfox\PriceCalculator\DI;

use Nette;
use Nette\DI\Config;
use Nette\DI\Compiler;
use Sunfox\PriceCalculator\PriceCalculator;


class PriceCalculatorExtension extends Nette\DI\CompilerExtension
{
	/**
	 * @var array
	 */
	private $defaults = [
		'calculatorClass' => 'Sunfox\PriceCalculator\PriceCalculator',
	];


	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('factory'))
					->setClass('Sunfox\PriceCalculator\PriceCalculatorFactory', [$config]);
	}

	/**
	 * @param Nette\Configurator $config
	 */
	public static function register(Nette\Configurator $config)
	{
		$config->onCompile[] = function ($config, Compiler $compiler) {
			$compiler->addExtension('priceCalculator', new PriceCalculatorExtension);
		};
	}

}
