<?php

namespace Sunfox\PriceCalculator\Discount;

use Nette;


/**
 * @property float $value
 */
class AmountDiscount implements \Sunfox\PriceCalculator\IDiscount
{
	use Nette\SmartObject;

	/** @var float */
	protected $value = 0.0;


	/**
	 * @param int|float
	 */
	public function __construct($value)
	{
		$this->setValue($value);
	}

	/**
	 * Get discount value.
	 *
	 * @return float
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set discount value.
	 *
	 * @param int|float
	 * @return IPriceCalculator
	 */
	public function setValue($value)
	{
		$this->value = (float) $value;
		return $this;
	}

	/**
	 * Returns price after discount.
	 * @param float
	 * @return float
	 */
	public function addDiscount($price)
	{
		return $price - $this->value;
	}

	/**
	 * Returns price before discount.
	 * @param float
	 * @return float
	 */
	public function removeDiscount($price)
	{
		return $price + $this->value;
	}

}
