<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;

use Nette\SmartObject;

/**
 * @property float $basePrice
 * @property IDiscount|NULL $discount
 * @property float $price
 * @property float $vatRate
 * @property float $priceVat
 * @property float $decimalPoints
 */
final class PriceCalculator implements IPriceCalculator
{
	use SmartObject;

	/**
	 * @var float
	 */
	protected $basePrice = 0.0;

	/**
	 * @var IDiscount|NULL
	 */
	protected $discount;

	/**
	 * @var float
	 */
	protected $price = 0.0;

	/**
	 * @var float
	 */
	protected $vatRate = 0.0;

	/**
	 * @var float
	 */
	protected $priceVat = 0.0;

	/**
	 * @var int
	 */
	protected $decimalPoints = 2;

	/**
	 * @var string
	 */
	protected $calculateFrom = self::FROM_BASEPRICE;

	public function __construct(float $vatRate = 0.0, float $basePrice = 0.0, ?IDiscount $discount = NULL)
	{
		$this->setVatRate($vatRate);
		$this->setBasePrice($basePrice);
		$this->setDiscount($discount);
	}

	/**
	 * Get price without VAT and discount.
	 */
	public function getBasePrice(): float
	{
		return $this->basePrice;
	}

	/**
	 * Set price without VAT and discount.
	 */
	public function setBasePrice(float $value): self
	{
		$this->basePrice = $value;
		$this->calculateFrom = self::FROM_BASEPRICE;
		return $this;
	}

	/**
	 * Get discount in percent without VAT.
	 */
	public function getDiscount(): IDiscount
	{
		return $this->discount;
	}

	/**
	 * Set discount instance.
	 */
	public function setDiscount(?IDiscount $discount): self
	{
		$this->discount = $discount;
		return $this;
	}

	/**
	 * Set amount discount.
	 */
	public function setAmountDiscount(float $value): self
	{
		$this->discount = new Discount\AmountDiscount($value);
		return $this;
	}

	/**
	 * Set percent discount.
	 */
	public function setPercentDiscount(float $value): self
	{
		$this->discount = new Discount\PercentDiscount($value);
		return $this;
	}

	/**
	 * Get price after discount without VAT.
	 */
	public function getPrice(): float
	{
		return $this->price;
	}

	/**
	 * Set price after discount without VAT.
	 */
	public function setPrice(float $value): self
	{
		$this->price = $value;
		$this->calculateFrom = self::FROM_PRICE;
		return $this;
	}

	/**
	 * Get VAT rate in percent.
	 */
	public function getVatRate(): float
	{
		return $this->vatRate;
	}

	/**
	 * Set VAT rate in percent.
	 */
	public function setVatRate(float $value): self
	{
		$this->vatRate = $value;
		return $this;
	}

	/**
	 * Get price after discount with VAT.
	 */
	public function getPriceVat(): float
	{
		return $this->priceVat;
	}

	/**
	 * Set price after discount with VAT.
	 */
	public function setPriceVat(float $value): self
	{
		$this->priceVat = $value;
		$this->calculateFrom = self::FROM_PRICEVAT;
		return $this;
	}

	/**
	 * Get decimal point for rounding.
	 */
	public function getDecimalPoints(): float
	{
		return $this->decimalPoints;
	}

	/**
	 * Set decimal point for rounding.
	 */
	public function setDecimalPoints(int $value): self
	{
		$this->decimalPoints = $value;
		return $this;
	}

	/**
	 * Calculate prices and return result.
	 */
	public function calculate(): PriceCalculatorResult
	{
		$basePrice = round($this->basePrice, $this->decimalPoints);
		$price = round($this->price, $this->decimalPoints);
		$priceVat = round($this->priceVat, $this->decimalPoints);

		if ($this->calculateFrom === self::FROM_BASEPRICE) {
			$price = round($this->discount ? $this->discount->addDiscount($basePrice) : $basePrice, $this->decimalPoints);
			$priceVat = round($price * ($this->vatRate / 100 + 1), $this->decimalPoints);
		} elseif ($this->calculateFrom === self::FROM_PRICE) {
			$basePrice = $this->discount ? round($this->discount->removeDiscount($price), $this->decimalPoints) : $price;
			$priceVat = round($price * ($this->vatRate / 100 + 1), $this->decimalPoints);
		} elseif ($this->calculateFrom === self::FROM_PRICEVAT) {
			$price = round($priceVat / ($this->vatRate / 100 + 1), $this->decimalPoints);
			$basePrice = $this->discount ? round($this->discount->removeDiscount($price), $this->decimalPoints) : $price;
		}

		$vat = $priceVat - $price;

		return new PriceCalculatorResult(
			$this, $basePrice, $this->discount, $price, $this->vatRate, $vat, $priceVat
		);
	}
}
