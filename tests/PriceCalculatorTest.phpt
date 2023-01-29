<?php declare(strict_types=1);

namespace Sunfox\PriceCalculatorTests;

use Sunfox\PriceCalculator\Discount\AmountDiscount;
use Sunfox\PriceCalculator\Discount\PercentDiscount;
use Tester;
use Tester\Assert;
use Sunfox\PriceCalculator\PriceCalculatorFactory;

require __DIR__ . '/bootstrap.php';

final class PriceCalculatorTest extends Tester\TestCase
{
	private PriceCalculatorFactory $factory;

	public function setup(): void
	{
		$this->factory = new PriceCalculatorFactory();
	}

	public function testResultGetters(): void
	{
		$result = $this->factory->create()
			->setBasePrice(1983.48)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::type(PercentDiscount::class, $result->discount);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testResultToArray(): void
	{
		$result = $this->factory->create()
			->setBasePrice(1983.48)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal([
			'basePrice' => 1983.48,
			'discount' => 10.0,
			'price' => 1785.13,
			'vatRate' => 21.0,
			'vat' => 374.88,
			'priceVat' => 2160.01,
		], $result->toArray());
	}

	public function testGetCalculator(): void
	{
		$calculator = $this->factory->create()
			->setBasePrice(1983.48)
			->setPercentDiscount(10)
			->setVatRate(21);
		$result = $calculator->calculate();

		Assert::same($calculator, $result->calculator);
	}

	public function testCalculatorGetters(): void
	{
		$calculator = $this->factory->create()
			->setBasePrice(1983.48)
			->setAmountDiscount(500)
			->setVatRate(21);

		Assert::equal(1983.48, $calculator->basePrice);
		Assert::type(AmountDiscount::class, $calculator->discount);
		Assert::equal(500.0, $calculator->discount->value);
		Assert::equal(0.0, $calculator->price);
		Assert::equal(21.0, $calculator->vatRate);
		Assert::equal(0.0, $calculator->priceVat);
		Assert::equal(2, $calculator->decimalPoints);
	}

	public function testSetDecimalPoints(): void
	{
		$result = $this->factory->create()
			->setBasePrice(1983.4893)
			->setAmountDiscount(500)
			->setVatRate(21)
			->setDecimalPoints(4)
			->calculate();

		Assert::equal(1983.4893, $result->basePrice);
		Assert::type(AmountDiscount::class, $result->discount);
		Assert::equal(500.0, $result->discount->value);
		Assert::equal(1483.4893, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(311.5328, $result->vat);
		Assert::equal(1795.0221, $result->priceVat);
	}

	public function testSetBasePriceAmoutDiscount(): void
	{
		$result = $this->factory->create()
			->setBasePrice(1983.48)
			->setAmountDiscount(500)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::type(AmountDiscount::class, $result->discount);
		Assert::equal(500.0, $result->discount->value);
		Assert::equal(1483.48, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(311.53, $result->vat);
		Assert::equal(1795.01, $result->priceVat);
	}

	public function testSetBasePricePercentDiscount(): void
	{
		$result = $this->factory->create()
			->setBasePrice(1983.48)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::type(PercentDiscount::class, $result->discount);
		Assert::equal(10.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPriceAmountDiscount(): void
	{
		$result = $this->factory->create()
			->setPrice(1785.13)
			->setAmountDiscount(500)
			->setVatRate(21)
			->calculate();

		Assert::equal(2285.13, $result->basePrice);
		Assert::type(AmountDiscount::class, $result->discount);
		Assert::equal(500.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPricePercentDiscount(): void
	{
		$result = $this->factory->create()
			->setPrice(1785.13)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::type(PercentDiscount::class, $result->discount);
		Assert::equal(10.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPriceVatAmountDiscount(): void
	{
		$result = $this->factory->create()
			->setPriceVat(2160.01)
			->setAmountDiscount(500)
			->setVatRate(21)
			->calculate();

		Assert::equal(2285.13, $result->basePrice);
		Assert::type(AmountDiscount::class, $result->discount);
		Assert::equal(500.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPriceVatPercentDiscount(): void
	{
		$result = $this->factory->create()
			->setPriceVat(2160.01)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::type(PercentDiscount::class, $result->discount);
		Assert::equal(10.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}
}

(new PriceCalculatorTest)->run();
