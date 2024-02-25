<?php

namespace App\Tests\BackOffice\Products\Domain\ValueObjetcs;

use App\BackOffice\Products\Domain\Enums\Tax as TaxEnum;
use App\BackOffice\Products\Domain\ValueObject\Tax;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TaxTest extends TestCase
{
    public static function getTaxes()
    {
        return [
            [4],
            [10],
            [21],
        ];
    }

    #[DataProvider('getTaxes')]
    public function testTax($tax)
    {
        $taxEnum = TaxEnum::from($tax);

        $taxObject = new Tax($taxEnum);
        $this->assertEquals($tax, $taxObject->tax->value);
    }

    public function testTaxException()
    {
        $this->expectException(\ValueError::class);

        TaxEnum::from(0);
    }
}
