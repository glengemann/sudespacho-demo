<?php

namespace App\BackOffice\Users\Infrastructure\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[Post(
    routeName: 'app_login',
    shortName: 'login',
    denormalizationContext: [
        'groups' => ['user:login'],
    ],
)]
#[Post(
    routeName: 'app_logout',
    shortName: 'logout',
    denormalizationContext: [
        'groups' => ['user:logout'],
    ],
)]
final class UserResource
{
    public function __construct(
        #[ApiProperty(default: 'admin@demo.com')]
        #[Assert\NotBlank]
        #[Groups(['user:login'])]
        public ?string $email = null,

        #[ApiProperty(default: 'password')]
        #[Assert\NotBlank]
        #[Groups(['user:login'])]
        public ?string $password = null,
    ) {
    }
}