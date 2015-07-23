<?php

namespace Sunfox\PriceCalculator;

use Nette;


class PriceCalculatorResult extends Nette\Object
{
	/** @var IPriceCalculator */
	protected $calculator;

	/** @var float */
	protected $basePrice = 0.0;

	/** @var float */
	protected $reduction = 0.0;

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
	public function __construct(IPriceCalculator $calculator, $basePrice, $reduction,
								$price, $vatRate, $vat, $priceVat)
	{
		$this->calculator = $calculator;
		$this->basePrice = $basePrice;
		$this->reduction = $reduction;
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
	 * Get price without VAT and reduction.
	 *
	 * @return float
	 */
	public function getBasePrice()
	{
		return $this->basePrice;
	}

	/**
	 * Get reduction in percent without VAT.
	 *
	 * @return float
	 */
	public function getReduction()
	{
		return $this->reduction;
	}

	/**
	 * Get price after reduction without VAT.
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
	 * Get price after reduction with VAT.
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
			'reduction' => $this->reduction,
			'price' => $this->price,
			'vatRate' => $this->vatRate,
			'vat' => $this->vat,
			'priceVat' => $this->priceVat,
		];
	}

}
