<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';


use Sunfox\PriceCalculator;

$calc = (new PriceCalculator\PriceCalculator)
	->setBasePrice(1983.48)
	->setDiscount(10)
	->setVatRate(21);

echo "------------------------------------------------------------\n";
echo "RESULT:\n";
echo "------------------------------------------------------------\n";
foreach ($calc->calculate()->toArray() as $k => $v)
{
	echo "{$k}: {$v}\n";
}
