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
		if ($this->calculateFrom === self::FROM_BASEPRICE) {
            [$basePrice, $price, $priceVat] = $this->calculateFromBasePrice();
		} elseif ($this->calculateFrom === self::FROM_PRICE) {
            [$basePrice, $price, $priceVat] = $this->calculateFromPrice();
		} elseif ($this->calculateFrom === self::FROM_PRICEVAT) {
            [$basePrice, $price, $priceVat] = $this->calculateFromPriceVat();
		}

		return new PriceCalculatorResult(
			$this, $basePrice, $this->discount, $price, $this->vatRate, $priceVat - $price, $priceVat
		);
	}

    private function calculateFromBasePrice(): array
    {
        $basePrice = $this->round($this->basePrice);
        $price = $this->round($this->discount ? $this->discount->addDiscount($basePrice) : $basePrice);
        $priceVat = $this->round($price * ($this->vatRate / 100 + 1));

        return [$basePrice, $price, $priceVat];
	}

    private function calculateFromPrice(): array
    {
        $price = $this->round($this->price);
        $basePrice = $this->discount ? $this->round($this->discount->removeDiscount($price)) : $price;
        $priceVat = $this->round($price * ($this->vatRate / 100 + 1));

        return [$basePrice, $price, $priceVat];
    }

    private function calculateFromPriceVat(): array
    {
        $priceVat = $this->round($this->priceVat);
        $price = $this->round($priceVat / ($this->vatRate / 100 + 1));
        $basePrice = $this->discount ? $this->round($this->discount->removeDiscount($price)) : $price;

        return [$basePrice, $price, $priceVat];
    }

    private function round(float $price): float
    {
        return round($price, $this->decimalPoints);
	}
}
