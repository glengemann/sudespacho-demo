<?php

namespace App\Tests\BackOffice\Users\Application\Controller;

use App\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class SecurityControllerTest extends WebTestCase
{
    use ResetDatabase;
    use Factories;

    public function testLoginSuccess(): void
    {
        $email = 'test@test.com';
        UserFactory::createOne([
            'email' => $email,
        ]);

        static::ensureKernelShutdown();
        $client = static::createClient();

        $client->request(
            'POST',
            '/login',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode([
                'email' => $email,
                'password' => 'password',
            ])
        );

        $this->assertResponseIsSuccessful();
    }

    public function testLoginUnauthorized(): void
    {
        $client = static::createClient();
        $user = json_encode([
            'email' => 'noregister@user.com',
            'password' => 'password',
        ]);

        $client->request(
            'POST',
            '/login',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            $user
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
        $this->assertEquals('{"error":"Invalid credentials."}', $client->getResponse()->getContent());
    }
}