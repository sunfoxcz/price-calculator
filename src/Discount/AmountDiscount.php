<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator\Discount;

use Nette\SmartObject;
use Sunfox\PriceCalculator\IDiscount;

/**
 * @property float $value
 */
final class AmountDiscount implements IDiscount
{
	use SmartObject;

	protected float $value = 0.0;

	public function __construct(float $value)
	{
		$this->setValue($value);
	}

	/**
	 * Get discount value.
	 */
	public function getValue(): float
	{
		return $this->value;
	}

	/**
	 * Set discount value.
	 */
	public function setValue(float $value): IDiscount
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Returns price after discount.
	 */
	public function addDiscount(float $price): float
	{
		return $price - $this->value;
	}

	/**
	 * Returns price before discount.
	 */
	public function removeDiscount(float $price): float
	{
		return $price + $this->value;
	}
}
