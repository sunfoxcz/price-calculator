<?php

namespace Sunfox\Tests;

use Tester;
use Tester\Assert;
use Sunfox\PriceCalculator\PriceCalculatorFactory;


require __DIR__ . '/bootstrap.php';


class PriceCalculatorTest extends Tester\TestCase
{
	/** @var PriceCalculatorFactory */
	private $factory;

	public function setup()
	{
		$this->factory = new PriceCalculatorFactory();
	}

	public function testToArray()
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

	public function testGetCalculator()
	{
		$calculator = $this->factory->create()
			->setBasePrice(1983.48)
			->setPercentDiscount(10)
			->setVatRate(21);
		$result = $calculator->calculate();

		Assert::same($calculator, $result->calculator);
	}

	public function testSetBasePriceAmoutDiscount()
	{
		$result = $this->factory->create()
			->setBasePrice(1983.48)
			->setAmountDiscount(500)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::equal(500.0, $result->discount->value);
		Assert::equal(1483.48, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(311.53, $result->vat);
		Assert::equal(1795.01, $result->priceVat);
	}

	public function testSetBasePricePercentDiscount()
	{
		$result = $this->factory->create()
			->setBasePrice(1983.48)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::equal(10.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPriceAmountDiscount()
	{
		$result = $this->factory->create()
			->setPrice(1785.13)
			->setAmountDiscount(500)
			->setVatRate(21)
			->calculate();

		Assert::equal(2285.13, $result->basePrice);
		Assert::equal(500.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPricePercentDiscount()
	{
		$result = $this->factory->create()
			->setPrice(1785.13)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::equal(10.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPriceVatAmountDiscount()
	{
		$result = $this->factory->create()
			->setPriceVat(2160.01)
			->setAmountDiscount(500)
			->setVatRate(21)
			->calculate();

		Assert::equal(2285.13, $result->basePrice);
		Assert::equal(500.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPriceVatPercentDiscount()
	{
		$result = $this->factory->create()
			->setPriceVat(2160.01)
			->setPercentDiscount(10)
			->setVatRate(21)
			->calculate();

		Assert::equal(1983.48, $result->basePrice);
		Assert::equal(10.0, $result->discount->value);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

}


$test = new PriceCalculatorTest;
$test->run();
