<?php

namespace Sunfox\PriceCalculator;

use Nette;


/**
 * @property IPriceCalculator $calculator
 * @property float $basePrice
 * @property float $discount
 * @property float $price
 * @property float $vatRate
 * @property float $vat
 * @property float $priceVat
 */
class PriceCalculatorResult
{
	use Nette\SmartObject;

	/** @var IPriceCalculator */
	protected $calculator;

	/** @var float */
	protected $basePrice = 0.0;

	/** @var float */
	protected $discount = 0.0;

	/** @var float */
	protected $price = 0.0;

	/** @var float */
	protected $vatRate = 0.0;

	/** @var float */
	protected $vat = 0.0;

	/** @var float */
	protected $priceVat = 0.0;


	/**
	 * @param IPriceCalculator
	 * @param float
	 * @param float
	 * @param float
	 * @param float
	 * @param float
	 * @param float
	 */
	public function __construct(IPriceCalculator $calculator, $basePrice, IDiscount $discount = NULL,
								$price, $vatRate, $vat, $priceVat)
	{
		$this->calculator = $calculator;
		$this->basePrice = $basePrice;
		$this->discount = $discount;
		$this->price = $price;
		$this->vatRate = $vatRate;
		$this->vat = $vat;
		$this->priceVat = $priceVat;
	}

	/**
	 * Return PriceCalculator instance.
	 *
	 * @return IPriceCalculator
	 */
	public function getCalculator()
	{
		return $this->calculator;
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
	 * Get discount in percent without VAT.
	 *
	 * @return float
	 */
	public function getDiscount()
	{
		return $this->discount;
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
	 * Get VAT rate in percent.
	 *
	 * @return float
	 */
	public function getVatRate()
	{
		return $this->vatRate;
	}

	/**
	 * Get VAT value.
	 *
	 * @return float
	 */
	public function getVat()
	{
		return $this->vat;
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
	 * Return all prices as array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		return [
			'basePrice' => $this->basePrice,
			'discount' => $this->discount ? $this->discount->value : 0.0,
			'price' => $this->price,
			'vatRate' => $this->vatRate,
			'vat' => $this->vat,
			'priceVat' => $this->priceVat,
		];
	}

}
