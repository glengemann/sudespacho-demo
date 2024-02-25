<?php

namespace App\BackOffice\Users\Application\EventListener;

use App\BackOffice\Users\Domain\Model\ApiToken;
use App\BackOffice\Users\Infrastructure\Doctrine\ApiTokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\AccessToken\HeaderAccessTokenExtractor;
use Symfony\Component\Security\Http\Event\LogoutEvent;

final class LogoutListener
{
    public function __construct(
        private ApiTokenRepository $apiTokenRepository,
        private EntityManagerInterface $em,
    ) {
    }

    #[AsEventListener(event: LogoutEvent::class)]
    public function onLogoutEvent(LogoutEvent $event): void
    {
        $request = $event->getRequest();
        $headerAccessTokenExtractor = new HeaderAccessTokenExtractor(); // TODO
        $token = $headerAccessTokenExtractor->extractAccessToken($request);

        if (null === $token) {
            throw new \Exception('No token found');
        }

        /** @var ApiToken $apiToken */
        $apiToken = $this->apiTokenRepository->findOneByToken($token);
        if (null === $apiToken) {
            throw new \Exception('No token found');
        }

        $apiToken->invalidate();
        $this->em->flush();
    }
}
