<?php

namespace Test;

use Nette;
use Tester;
use Tester\Assert;
use Sunfox\PriceCalculator\PriceCalculatorFactory;


require __DIR__ . '/bootstrap.php';


class PriceCalculatorTest extends Tester\TestCase
{
	/** @var PriceCalculator\PriceCalculator */
	private $calculator;

	public function setup()
	{
		$factory = new PriceCalculatorFactory();
		$this->calculator = $factory->create()
			->setBasePrice(1983.48)
			->setReduction(10)
			->setVatRate(21);
	}

	public function testSetBasePrice()
	{
		$result = $this->calculator->calculate();

		Assert::same($this->calculator, $result->calculator);
		Assert::equal(1983.48, $result->basePrice);
		Assert::equal(10.0, $result->reduction);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPrice()
	{
		$result = $this->calculator->calculate();

		Assert::same($this->calculator, $result->calculator);
		Assert::equal(1983.48, $result->basePrice);
		Assert::equal(10.0, $result->reduction);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

	public function testSetPriceVat()
	{
		$result = $this->calculator->calculate();

		Assert::same($this->calculator, $result->calculator);
		Assert::equal(1983.48, $result->basePrice);
		Assert::equal(10.0, $result->reduction);
		Assert::equal(1785.13, $result->price);
		Assert::equal(21.0, $result->vatRate);
		Assert::equal(374.88, $result->vat);
		Assert::equal(2160.01, $result->priceVat);
	}

}


$test = new PriceCalculatorTest;
$test->run();
