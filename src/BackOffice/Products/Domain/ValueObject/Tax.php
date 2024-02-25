<?php

namespace App\BackOffice\Products\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use App\BackOffice\Products\Domain\Enums\Tax as TaxEnum;

#[ORM\Embeddable]
class Tax
{
    #[ORM\Column]
    public readonly TaxEnum $tax;

    public function __construct(TaxEnum $tax)
    {
        $this->tax = $tax;
    }
}