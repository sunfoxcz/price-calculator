<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;


interface IPriceCalculator
{
	const FROM_BASEPRICE = 'basePrice',
		FROM_PRICE = 'price',
		FROM_PRICEVAT = 'priceVat';


	/**
	 * Get price without VAT and discount.
	 *
	 * @return float
	 */
	public function getBasePrice();

	/**
	 * Set price without VAT and discount.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setBasePrice($value);

	/**
	 * Get discount in percent without VAT.
	 *
	 * @return float
	 */
	public function getDiscount();

	/**
	 * Set discount in percent without VAT.
	 *
	 * @param IDiscount
	 * @return IPriceCalculator
	 */
	public function setDiscount(IDiscount $discount = NULL);

	/**
	 * Get price after discount without VAT.
	 *
	 * @return float
	 */
	public function getPrice();

	/**
	 * Set price after discount without VAT.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setPrice($value);

	/**
	 * Get VAT rate in percent.
	 *
	 * @return float
	 */
	public function getVatRate();

	/**
	 * Set VAT rate in percent.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setVatRate($value);

	/**
	 * Get price after discount with VAT.
	 *
	 * @return float
	 */
	public function getPriceVat();

	/**
	 * Set price after discount with VAT.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setPriceVat($value);

	/**
	 * Get decimal point for rounding.
	 *
	 * @return float
	 */
	public function getDecimalPoints();

	/**
	 * Set decimal point for rounding.
	 *
	 * @param int
	 * @return IPriceCalculator
	 */
	public function setDecimalPoints($value);

	/**
	 * Calculate prices and return result.
	 *
	 * @return PriceCalculatorResult
	 */
	public function calculate();

}
