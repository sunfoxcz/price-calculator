<?php declare(strict_types=1);

namespace Sunfox\PriceCalculatorTests\Mocks;

use Sunfox\PriceCalculator\IDiscount;
use Sunfox\PriceCalculator\IPriceCalculator;
use Sunfox\PriceCalculator\PriceCalculatorResult;

final class PriceCalculatorMock implements IPriceCalculator
{

	public function __construct()
	{
	}

	public function getBasePrice(): float
	{
		return 0.0;
	}

	public function setBasePrice(float $value): IPriceCalculator
	{
		return $this;
	}

	public function getDiscount(): ?IDiscount
	{
		return NULL;
	}

	public function setDiscount(?IDiscount $discount): IPriceCalculator
	{
		return $this;
	}

	public function setAmountDiscount(float $value): IPriceCalculator
	{
		return $this;
	}

	public function setPercentDiscount(float $value): IPriceCalculator
	{
		return $this;
	}

	public function getPrice(): float
	{
		return 0.0;
	}

	public function setPrice(float $value): IPriceCalculator
	{
		return $this;
	}

	public function getVatRate(): float
	{
		return 0.0;
	}

	public function setVatRate(float $value): IPriceCalculator
	{
		return $this;
	}

	public function getPriceVat(): float
	{
		return 0.0;
	}

	public function setPriceVat(float $value): IPriceCalculator
	{
		return $this;
	}

	public function getDecimalPoints(): int
	{
		return 2;
	}

	public function setDecimalPoints(int $value): IPriceCalculator
	{
		return $this;
	}

	public function calculate(): PriceCalculatorResult
	{
		return new PriceCalculatorResult($this, 0.0, NULL, 0.0, 0.0, 0.0, 0.0);
	}
}
