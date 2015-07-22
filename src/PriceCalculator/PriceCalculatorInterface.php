<?php

namespace Sunfox\PriceCalculator;


interface PriceCalculatorInterface
{

	public function getBasePrice();

	public function setBasePrice($value);

	public function getReduction();

	public function setReduction($value);

	public function getPrice();

	public function setPrice($value);

	public function getVatRate();

	public function setVatRate($value);

	public function getPriceVat();

	public function setPriceVat($value);

	public function getDecimalPoints();

	public function setDecimalPoints($value);

	public function calculate();

}
