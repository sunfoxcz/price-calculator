<?php

namespace Sunfox\PriceCalculator;

use Nette;


class PriceCalculatorFactory extends Nette\Object
{
	/** @var string */
	protected $class;


	public function __construct($class = 'Sunfox\PriceCalculator\PriceCalculator')
	{
		$this->class = $class;
	}

	public function create()
	{
		return new $this->class;
	}

	public function getClass()
	{
		return $this->class;
	}

	public function setClass($class)
	{
		$this->class = $class;
	}

}
