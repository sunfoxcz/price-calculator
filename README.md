# Price calculator library

<p align=center>
    <a href="https://github.com/sunfoxcz/price-calculator/actions"><img src="https://badgen.net/github/checks/sunfoxcz/price-calculator/master?cache=300"></a>
    <a href="https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/?branch=master"><img src="https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/badges/coverage.png?b=master"></a>
    <a href="https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/?branch=master"><img src="https://scrutinizer-ci.com/g/sunfoxcz/price-calculator/badges/quality-score.png?b=master"></a>
</p>
<p align=center>
    <a href="https://packagist.org/packages/sunfoxcz/price-calculator"><img src="https://badgen.net/packagist/v/sunfoxcz/price-calculator"></a>
    <a href="https://packagist.org/packages/sunfoxcz/price-calculator"><img src="https://badgen.net/packagist/php/sunfoxcz/price-calculator"></a>
    <a href="https://github.com/sunfoxcz/price-calculator"><img src="https://badgen.net/github/license/sunfoxcz/price-calculator"></a>
</p>

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
