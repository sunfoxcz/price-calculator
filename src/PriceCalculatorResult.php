<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator;

use Nette\SmartObject;

/**
 * @property IPriceCalculator $calculator
 * @property float $basePrice
 * @property IDiscount|NULL $discount
 * @property float $price
 * @property float $vatRate
 * @property float $vat
 * @property float $priceVat
 */
final class PriceCalculatorResult
{
	use SmartObject;

	/**
	 * @var IPriceCalculator
	 */
	protected $calculator;

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
	protected $vat = 0.0;

	/**
	 * @var float
	 */
	protected $priceVat = 0.0;

	public function __construct(
		IPriceCalculator $calculator,
		float $basePrice,
		?IDiscount $discount,
		float $price,
		float $vatRate,
		float $vat,
		float $priceVat
	) {
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
	 */
	public function getCalculator(): IPriceCalculator
	{
		return $this->calculator;
	}

	/**
	 * Get price without VAT and discount.
	 */
	public function getBasePrice(): float
	{
		return $this->basePrice;
	}

	/**
	 * Get discount in percent without VAT.
	 */
	public function getDiscount(): ?IDiscount
	{
		return $this->discount;
	}

	/**
	 * Get price after discount without VAT.
	 */
	public function getPrice(): float
	{
		return $this->price;
	}

	/**
	 * Get VAT rate in percent.
	 */
	public function getVatRate(): float
	{
		return $this->vatRate;
	}

	/**
	 * Get VAT value.
	 */
	public function getVat(): float
	{
		return $this->vat;
	}

	/**
	 * Get price after discount with VAT.
	 */
	public function getPriceVat(): float
	{
		return $this->priceVat;
	}

	/**
	 * Return all prices as array.
	 *
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return [
			'basePrice' => $this->basePrice,
			'discount' => $this->discount ? $this->discount->getValue() : 0.0,
			'price' => $this->price,
			'vatRate' => $this->vatRate,
			'vat' => $this->vat,
			'priceVat' => $this->priceVat,
		];
	}
}
