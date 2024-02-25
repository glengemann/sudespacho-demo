<?php

namespace App\BackOffice\Users\Infrastructure\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

// TODO
#[ApiResource(
    shortName: 'User',
    operations: [
        new Post(
            uriTemplate: '/login',
            denormalizationContext: [
                'groups' => ['user:login'],
            ],
        ),
        new Post(
            uriTemplate: '/logout',
        ),
    ],
)]
final class UserResource
{
    public function __construct(
        #[Assert\NotBlank]
        #[Groups(['user:login'])]
        public ?string $email = null,
        #[Assert\NotBlank]
        #[Groups(['user:login'])]
        public ?string $password = null,
    ) {
    }
}