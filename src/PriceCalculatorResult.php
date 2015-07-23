<?php

namespace Sunfox\PriceCalculator;

use Nette;


final class PriceCalculatorResult extends Nette\Object
{
	/** @var PriceCalculatorInterface */
	private $calculator;

	/** @var float */
	private $basePrice = 0.0;

	/** @var float */
	private $reduction = 0.0;

	/** @var float */
	private $price = 0.0;

	/** @var float */
	private $vatRate = 0.0;

	/** @var float */
	private $vat = 0.0;

	/** @var float */
	private $priceVat = 0.0;


	public function __construct(PriceCalculatorInterface $calculator, $basePrice, $reduction,
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

	public function getCalculator()
	{
		return $this->calculator;
	}

	public function getBasePrice()
	{
		return $this->basePrice;
	}

	public function getReduction()
	{
		return $this->reduction;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getVatRate()
	{
		return $this->vatRate;
	}

	public function getVat()
	{
		return $this->vat;
	}

	public function getPriceVat()
	{
		return $this->priceVat;
	}

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
