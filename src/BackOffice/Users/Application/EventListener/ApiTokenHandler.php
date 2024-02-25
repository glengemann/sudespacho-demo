<?php

namespace App\BackOffice\Users\Application\EventListener;

use App\BackOffice\Users\Infrastructure\Doctrine\DoctrineApiTokenRepository;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

readonly class ApiTokenHandler implements AccessTokenHandlerInterface
{
    public function __construct(private DoctrineApiTokenRepository $apiTokenRepository)
    {
    }

    public function getUserBadgeFrom(#[\SensitiveParameter] string $accessToken): UserBadge
    {
        $token = $this->apiTokenRepository->findOneByToken($accessToken);

        if (null === $token) {
            throw new BadCredentialsException('Invalid token');
        }

        if ($token->isExpired()) {
            throw new BadCredentialsException('Token expired');
        }

        return new UserBadge($token->getOwnedBy()->getUserIdentifier());
    }
}