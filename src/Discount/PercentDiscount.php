<?php declare(strict_types=1);

namespace Sunfox\PriceCalculator\Discount;

use Nette\SmartObject;
use Sunfox\PriceCalculator\IDiscount;

/**
 * @property float $value
 */
final class PercentDiscount implements IDiscount
{
	use SmartObject;

	/**
	 * @var float
	 */
	protected $value = 0.0;

	/**
	 * @param int|float $value
	 */
	public function __construct($value)
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
	public function setValue(float $value): PercentDiscount
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Returns price after discount.
	 */
	public function addDiscount(float $price): float
	{
		return $price * (1 - $this->value / 100);
	}

	/**
	 * Returns price before discount.
	 */
	public function removeDiscount(float $price): float
	{
		return $price / (1 - $this->value / 100);
	}
}
