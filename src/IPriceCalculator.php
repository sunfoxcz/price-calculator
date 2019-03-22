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
	 */
	public function setBasePrice(float $value): IPriceCalculator;

	/**
	 * Get discount in percent without VAT.
	 */
	public function getDiscount(): IDiscount;

	/**
	 * Set discount in percent without VAT.
	 */
	public function setDiscount(?IDiscount $discount): IPriceCalculator;

	/**
	 * Get price after discount without VAT.
	 */
	public function getPrice(): float;

	/**
	 * Set price after discount without VAT.
	 */
	public function setPrice(float $value): IPriceCalculator;

	/**
	 * Get VAT rate in percent.
	 */
	public function getVatRate(): float;

	/**
	 * Set VAT rate in percent.
	 */
	public function setVatRate(float $value): IPriceCalculator;

	/**
	 * Get price after discount with VAT.
	 */
	public function getPriceVat(): float;

	/**
	 * Set price after discount with VAT.
	 */
	public function setPriceVat(float $value): IPriceCalculator;

	/**
	 * Get decimal point for rounding.
	 */
	public function getDecimalPoints(): float;

	/**
	 * Set decimal point for rounding.
	 */
	public function setDecimalPoints(int $value): IPriceCalculator;

	/**
	 * Calculate prices and return result.
	 */
	public function calculate(): PriceCalculatorResult;
}
