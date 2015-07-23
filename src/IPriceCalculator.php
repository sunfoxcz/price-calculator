<?php

namespace Sunfox\PriceCalculator;


interface IPriceCalculator
{
	const FROM_BASEPRICE = 'basePrice',
		FROM_PRICE = 'price',
		FROM_PRICEVAT = 'priceVat';


	/**
	 * Get price without VAT and reduction.
	 *
	 * @return float
	 */
	public function getBasePrice();

	/**
	 * Set price without VAT and reduction.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setBasePrice($value);

	/**
	 * Get reduction in percent without VAT.
	 *
	 * @return float
	 */
	public function getReduction();

	/**
	 * Set reduction in percent without VAT.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setReduction($value);

	/**
	 * Get price after reduction without VAT.
	 *
	 * @return float
	 */
	public function getPrice();

	/**
	 * Set price after reduction without VAT.
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
	 * Get price after reduction with VAT.
	 *
	 * @return float
	 */
	public function getPriceVat();

	/**
	 * Set price after reduction with VAT.
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
