<?php

namespace Sunfox\PriceCalculator;

use Nette;


class PriceCalculator extends Nette\Object implements IPriceCalculator
{
	/** @var float */
	protected $basePrice = 0.0;

	/** @var float */
	protected $discount = 0.0;

	/** @var float */
	protected $price = 0.0;

	/** @var float */
	protected $vatRate = 0.0;

	/** @var float */
	protected $priceVat = 0.0;

	/** @var int */
	protected $decimalPoints = 2;

	/** @var string */
	protected $calculateFrom = self::FROM_BASEPRICE;


	/**
	 * @param int|float VAT rate
	 * @param int|float Price without VAT and discount
	 * @param int|float Discount without VAT
	 */
	public function __construct($vatRate = 0.0, $basePrice = 0.0, $discount = 0.0)
	{
		$this->setVatRate($vatRate);
		$this->setBasePrice($basePrice);
		$this->setDiscount($discount);
	}

	/**
	 * Get price without VAT and discount.
	 *
	 * @return float
	 */
	public function getBasePrice()
	{
		return $this->basePrice;
	}

	/**
	 * Set price without VAT and discount.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setBasePrice($value)
	{
		$this->basePrice = (float) $value;
		$this->calculateFrom = self::FROM_BASEPRICE;
		return $this;
	}

	/**
	 * Get discount in percent without VAT.
	 *
	 * @return float
	 */
	public function getDiscount()
	{
		return $this->discount;
	}

	/**
	 * Set discount in percent without VAT.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setDiscount($value)
	{
		$this->discount = (float) $value;
		return $this;
	}

	/**
	 * Get price after discount without VAT.
	 *
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Set price after discount without VAT.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setPrice($value)
	{
		$this->price = (float) $value;
		$this->calculateFrom = self::FROM_PRICE;
		return $this;
	}

	/**
	 * Get VAT rate in percent.
	 *
	 * @return float
	 */
	public function getVatRate()
	{
		return $this->vatRate;
	}

	/**
	 * Set VAT rate in percent.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setVatRate($value)
	{
		$this->vatRate = (float) $value;
		return $this;
	}

	/**
	 * Get price after discount with VAT.
	 *
	 * @return float
	 */
	public function getPriceVat()
	{
		return $this->priceVat;
	}

	/**
	 * Set price after discount with VAT.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setPriceVat($value)
	{
		$this->priceVat = (float) $value;
		$this->calculateFrom = self::FROM_PRICEVAT;
		return $this;
	}

	/**
	 * Get decimal point for rounding.
	 *
	 * @return float
	 */
	public function getDecimalPoints()
	{
		return $this->decimalPoints;
	}

	/**
	 * Set decimal point for rounding.
	 *
	 * @param int
	 * @return IPriceCalculator
	 */
	public function setDecimalPoints($value)
	{
		$this->decimalPoints = (int) $value;
		return $this;
	}

	/**
	 * Calculate prices and return result.
	 *
	 * @return PriceCalculatorResult
	 */
	public function calculate()
	{
		$basePrice = round($this->basePrice, $this->decimalPoints);
		$price = round($this->price, $this->decimalPoints);
		$priceVat = round($this->priceVat, $this->decimalPoints);

		if ($this->calculateFrom === self::FROM_BASEPRICE) {
			$price = round($basePrice * (1 - $this->discount / 100), $this->decimalPoints);
			$priceVat = round($price * ($this->vatRate / 100 + 1), $this->decimalPoints);
		} elseif ($this->calculateFrom === self::FROM_PRICE) {
			$basePrice = $this->discount ? round($price / (1 - $this->discount / 100), $this->decimalPoints) : $price;
			$priceVat = round($price * ($this->vatRate / 100 + 1), $this->decimalPoints);
		} elseif ($this->calculateFrom === self::FROM_PRICEVAT) {
			$price = round($priceVat / ($this->vatRate / 100 + 1), $this->decimalPoints);
			$basePrice = $this->discount ? round($price / (1 - $this->discount / 100), $this->decimalPoints) : $price;
		}

		$vat = $priceVat - $price;

		return new PriceCalculatorResult(
			$this, $basePrice, $this->discount, $price, $this->vatRate, $vat, $priceVat
		);
	}

}
