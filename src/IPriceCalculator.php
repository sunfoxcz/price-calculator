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
	public function setBasePrice(float $value): self;

	/**
	 * Get discount in percent without VAT.
	 */
	public function getDiscount(): IDiscount;

	/**
	 * Set discount in percent without VAT.
	 */
	public function setDiscount(?IDiscount $discount): self;

	/**
	 * Get price after discount without VAT.
	 */
	public function getPrice(): float;

	/**
	 * Set price after discount without VAT.
	 */
	public function setPrice(float $value): self;

	/**
	 * Get VAT rate in percent.
	 */
	public function getVatRate(): float;

	/**
	 * Set VAT rate in percent.
	 */
	public function setVatRate(float $value): self;

	/**
	 * Get price after discount with VAT.
	 */
	public function getPriceVat(): float;

	/**
	 * Set price after discount with VAT.
	 */
	public function setPriceVat(float $value): self;

	/**
	 * Get decimal point for rounding.
	 */
	public function getDecimalPoints(): float;

	/**
	 * Set decimal point for rounding.
	 */
	public function setDecimalPoints(int $value): self;

	/**
	 * Calculate prices and return result.
	 */
	public function calculate(): PriceCalculatorResult;
}
