<?php declare(strict_types=1);

namespace App\Tests\Services;

use App\Entity\Product;
use App\Services\CalculatePriceIncludingTax;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CalculatePriceIncludingTaxTest extends TestCase
{
    public static function getProducts()
    {
        return [
            [100, 20, 120],
            [200, 20, 220],
            [100, 10, 110],
            [200, 10, 210],
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
