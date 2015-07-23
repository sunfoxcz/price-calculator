<?php

namespace Sunfox\PriceCalculator;

use Nette;


class PriceCalculator extends Nette\Object implements PriceCalculatorInterface
{
	/** @var float */
	protected $basePrice = 0.0;

	/** @var float */
	protected $reduction = 0.0;

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


	public function __construct($vatRate = 0.0, $basePrice = 0.0, $reduction = 0.0)
	{
		$this->setVatRate($vatRate);
		$this->setBasePrice($basePrice);
		$this->setReduction($reduction);
	}

	public function getBasePrice()
	{
		return $this->basePrice;
	}

	public function setBasePrice($value)
	{
		$this->basePrice = (float) $value;
		$this->calculateFrom = self::FROM_BASEPRICE;
		return $this;
	}

	public function getReduction()
	{
		return $this->reduction;
	}

	public function setReduction($value)
	{
		$this->reduction = (float) $value;
		return $this;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($value)
	{
		$this->price = (float) $value;
		$this->calculateFrom = self::FROM_PRICE;
		return $this;
	}

	public function getVatRate()
	{
		return $this->vatRate;
	}

	public function setVatRate($value)
	{
		$this->vatRate = (float) $value;
		return $this;
	}

	public function getPriceVat()
	{
		return $this->priceVat;
	}

	public function setPriceVat($value)
	{
		$this->priceVat = (float) $value;
		$this->calculateFrom = self::FROM_PRICEVAT;
		return $this;
	}

	public function getDecimalPoints()
	{
		return $this->decimalPoints;
	}

	public function setDecimalPoints($value)
	{
		$this->decimalPoints = (int) $value;
	}

	public function calculate()
	{
		$basePrice = round($this->basePrice, $this->decimalPoints);
		$price = round($this->price, $this->decimalPoints);
		$priceVat = round($this->priceVat, $this->decimalPoints);

		if ($this->calculateFrom === self::FROM_BASEPRICE) {
			$price = round($basePrice * (1 - $this->reduction/100), $this->decimalPoints);
			$priceVat = round($price * ($this->vatRate/100 + 1), $this->decimalPoints);
		} elseif ($this->calculateFrom === self::FROM_PRICE) {
			$basePrice = $this->reduction ? round($price / (1 - $this->reduction/100), $this->decimalPoints) : $price;
			$priceVat = round($price * ($this->vatRate/100 + 1), $this->decimalPoints);
		} elseif ($this->calculateFrom === self::FROM_PRICEVAT) {
			$price = round($priceVat / ($this->vatRate/100 + 1), $this->decimalPoints);
			$basePrice = $this->reduction ? round($price / (1 - $this->reduction/100), $this->decimalPoints) : $price;
		}

		$vat = $priceVat - $price;

		return new PriceCalculatorResult(
			$this, $basePrice, $this->reduction, $price, $this->vatRate, $vat, $priceVat
		);
	}

}
