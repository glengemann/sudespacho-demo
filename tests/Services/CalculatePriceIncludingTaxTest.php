<?php declare(strict_types=1);

namespace App\Tests\Services;

use App\Entity\Product;
use App\Enums\Tax;
use App\Services\CalculatePriceIncludingTax;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CalculatePriceIncludingTaxTest extends TestCase
{
    public static function getProducts(): array
    {
        return [
            [100, Tax::LOW, 104],
            [100, Tax::MEDIUM, 110],
            [100, Tax::HIGH, 121],
        ];
    }

    #[DataProvider('getProducts')]
    public function testCalculate($price, $tax, $expected)
    {
        $product = new Product();
        $product->setPrice($price);
        $product->setTax($tax);

        $calculatePriceIncludingTax = new CalculatePriceIncludingTax();
        $result = $calculatePriceIncludingTax->calculate($product);

        $this->assertEquals($expected, $result);
    }
}
