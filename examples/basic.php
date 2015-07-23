<?php

require __DIR__ . '/../vendor/autoload.php';


use Sunfox\PriceCalculator;

$calc = (new PriceCalculator\PriceCalculator)
	->setBasePrice(1983.48)
	->setReduction(10)
	->setVatRate(21);

echo "------------------------------------------------------------\n";
echo "RESULT:\n";
echo "------------------------------------------------------------\n";
foreach ($calc->calculate() as $k => $v)
{
	echo "{$k}: {$v}\n";
}
