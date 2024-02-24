<?php

namespace App\Services;

use App\Entity\ApiToken;
use App\Entity\User;
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