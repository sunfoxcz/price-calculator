Price calculator library
===============

[![Build Status](https://travis-ci.org/sunfoxcz/price-calculator.svg?branch=master)](https://travis-ci.org/sunfoxcz/price-calculator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/?branch=master)

Library for easier price calculation using VAT and discount.

Installation
------------

	composer require sunfoxcz/price-calculator:@dev

Usage
-----

```php
use Sunfox\PriceCalculator;

$result = (new PriceCalculator\PriceCalculator)
	->setBasePrice(1983.48)
	->setReduction(10)
	->setVatRate(21)
	->calculate();
```
