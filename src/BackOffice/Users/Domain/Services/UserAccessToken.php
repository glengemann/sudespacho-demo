<?php

namespace App\BackOffice\Users\Domain\Services;

use App\BackOffice\Users\Domain\Model\ApiToken;
use App\BackOffice\Users\Domain\Model\User;
use Doctrine\ORM\EntityManagerInterface;

class UserAccessToken
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function create(User $user): string
    {
        $token = new ApiToken();
        $token->setOwnedBy($user);

        $this->em->persist($token);
        $this->em->flush();

        return $token->getToken();
    }
}