<?php

namespace App\BackOffice\Products\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class ProductId
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(name: 'id')]
    #[ORM\SequenceGenerator(sequenceName: 'product_id_seq')]
    public readonly int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}