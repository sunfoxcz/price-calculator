<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;

final class PriceCalculatorFactory
{
	private string $class;

	/**
	 * Accepts class name with full namespace.
	 */
	public function __construct(string $class = PriceCalculator::class)
	{
		$this->class = $class;
	}

	/**
	 * Create and return PriceCalculator instance.
	 */
	public function create(): IPriceCalculator
	{
		return new $this->class;
	}

	/**
	 * Get class name.
	 */
	public function getClass(): string
	{
		return $this->class;
	}

	/**
	 * Set class name.
	 */
	public function setClass(string $class): self
	{
		$this->class = $class;
		return $this;
	}
}
