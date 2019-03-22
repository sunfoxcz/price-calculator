# Price calculator library

[![Build Status](https://travis-ci.org/sunfoxcz/price-calculator.svg?branch=master)](https://travis-ci.org/sunfoxcz/price-calculator)
[![Code Coverage](https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/?branch=master)

Library for easier price calculation using VAT and discount.

## Installation

```bash
composer require sunfoxcz/price-calculator:@dev
```

## Usage

```php
<?php declare(strict_types=1);

use Sunfox\PriceCalculator\Discount\PercentDiscount;
use Sunfox\PriceCalculator\PriceCalculator;

$calc = (new PriceCalculator)
	->setBasePrice(1983.48)
	->setDiscount(new PercentDiscount(10))
	->setVatRate(21);

foreach ($calc->calculate()->toArray() as $k => $v) {
	echo "{$k}: {$v}\n";
}
```
