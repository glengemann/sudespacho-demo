<?php

namespace App\BackOffice\Products\Domain\Enums;

enum Tax: int
{
    case LOW = 4;
    case MEDIUM = 10;
    case HIGH = 21;
}