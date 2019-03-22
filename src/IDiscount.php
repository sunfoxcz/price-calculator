<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;

interface IDiscount
{
	/**
	 * Get discount value.
	 *
	 * @return float
	 */
	public function getValue();

	/**
	 * Set discount value.
	 *
	 * @param int|float
	 * @return IDiscount
	 */
	public function setValue($value);

	/**
	 * Returns price after discount.
	 * @param float
	 * @return float
	 */
	public function addDiscount($price);

	/**
	 * Returns price before discount.
	 * @param float
	 * @return float
	 */
	public function removeDiscount($price);
}
