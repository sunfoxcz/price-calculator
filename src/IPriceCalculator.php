<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;

interface IPriceCalculator
{
	public const FROM_BASEPRICE = 'basePrice';
	public const FROM_PRICE = 'price';
	public const FROM_PRICEVAT = 'priceVat';

	/**
	 * Get price without VAT and discount.
	 */
	public function getBasePrice(): float;

	/**
	 * Set price without VAT and discount.
	 *
	 * @return IPriceCalculator
	 */
	public function setBasePrice(float $value);

	/**
	 * Get discount in percent without VAT.
	 */
	public function getDiscount(): IDiscount;

	/**
	 * Set discount in percent without VAT.
	 *
	 * @return IPriceCalculator
	 */
	public function setDiscount(?IDiscount $discount);

	/**
	 * Get price after discount without VAT.
	 */
	public function getPrice(): float;

	/**
	 * Set price after discount without VAT.
	 *
	 * @return IPriceCalculator
	 */
	public function setPrice(float $value);

	/**
	 * Get VAT rate in percent.
	 */
	public function getVatRate(): float;

	/**
	 * Set VAT rate in percent.
	 *
	 * @return IPriceCalculator
	 */
	public function setVatRate(float $value);

	/**
	 * Get price after discount with VAT.
	 */
	public function getPriceVat(): float;

	/**
	 * Set price after discount with VAT.
	 *
	 * @return IPriceCalculator
	 */
	public function setPriceVat(float $value);

	/**
	 * Get decimal point for rounding.
	 */
	public function getDecimalPoints(): float;

	/**
	 * Set decimal point for rounding.
	 *
	 * @return IPriceCalculator
	 */
	public function setDecimalPoints(int $value);

	/**
	 * Calculate prices and return result.
	 */
	public function calculate(): PriceCalculatorResult;
}
