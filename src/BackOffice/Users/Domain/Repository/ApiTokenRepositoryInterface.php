<?php

namespace App\BackOffice\Users\Domain\Repository;

use App\BackOffice\Users\Domain\Model\ApiToken;
use App\Shared\Domain\Repository\RepositoryInterface;

interface ApiTokenRepositoryInterface extends RepositoryInterface
{
    public function findOneByToken(string $token): ?ApiToken;
}