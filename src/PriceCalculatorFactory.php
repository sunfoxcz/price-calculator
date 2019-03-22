<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;

class PriceCalculatorFactory
{
	/**
	 * @var string
	 */
	protected $class;

	/**
	 * @param string Class name with full namespace.
	 */
	public function __construct($class = 'Sunfox\PriceCalculator\PriceCalculator')
	{
		$this->class = $class;
	}

	/**
	 * Create and return PriceCalculator instance.
	 *
	 * @return IPriceCalculator
	 */
	public function create()
	{
		return new $this->class;
	}

	/**
	 * Get class name.
	 *
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 * Set class name.
	 *
	 * @param string $class
	 *
	 * @return PriceCalculatorFactory
	 */
	public function setClass($class)
	{
		$this->class = $class;
		return $this;
	}
}
