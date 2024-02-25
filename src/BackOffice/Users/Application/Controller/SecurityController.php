<?php

namespace App\BackOffice\Users\Application\Controller;

use App\BackOffice\Users\Domain\Model\User;
use App\BackOffice\Users\Domain\Services\UserAccessToken;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SecurityController extends AbstractController
{
    public function __construct(private UserAccessToken $userAccessToken)
    {
    }

    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(#[CurrentUser] User $user = null): Response
    {
        if (!$user) {
            return $this->json([
                'error' => 'Invalid login request.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->userAccessToken->create($user);

        return $this->json([
            'email' => $user->getEmail(),
            'token' => $token,
        ], Response::HTTP_OK);
    }

    #[Route('/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}
