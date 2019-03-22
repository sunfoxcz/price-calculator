<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;

interface IDiscount
{
	/**
	 * Get discount value.
	 */
	public function getValue(): float;

	/**
	 * Set discount value.
	 */
	public function setValue(float $value): IDiscount;

	/**
	 * Returns price after discount.
	 */
	public function addDiscount(float $price): float;

	/**
	 * Returns price before discount.
	 */
	public function removeDiscount(float $price): float;
}
