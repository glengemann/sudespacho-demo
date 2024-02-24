<?php

namespace App\Tests\Integration;

use App\Factory\ApiTokenFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ProductResourceTest extends WebTestCase
{
    use ResetDatabase;
    use Factories;

    public function testRetrieves(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/products');

        $this->assertResponseIsSuccessful();
    }


    public function testCreatesSuccess(): void
    {
        $client = static::createClient();

        $token = ApiTokenFactory::createOne();
        static::ensureKernelShutdown();
        $key = $token->getToken();

        $client->request(
            'POST',
            '/api/products',
            [],
            [],
            server: [
                'CONTENT_TYPE' => 'application/json',
                'ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $key,
            ],
            content: json_encode([
                'name' => 'Test Product',
                'description' => 'Test Description',
                'price' => 1000,
                'tax' => 4,
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    public function testCreatesFailOnMissingFields(): void
    {
        $client = static::createClient();

        $token = ApiTokenFactory::createOne();
        $key = $token->getToken();
        static::ensureKernelShutdown();

        $client->request(
            'POST',
            '/api/products',
            [],
            [],
            server: [
                'CONTENT_TYPE' => 'application/json',
                'ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $key,
            ],
            content: json_encode([
                'name' => 'Test Product',
                'price' => 1000,
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testCreatesInvalidCredentials(): void
    {
        $client = static::createClient();
        $key = 'invalid_token';
        $client->request(
            'POST',
            '/api/products',
            [],
            [],
            server: [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $key,
            ],
            content: json_encode([
                'name' => 'Test Product',
                'price' => 1000,
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testCreatesUnauthorized(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/products',
            [],
            [],
            server: [
                'CONTENT_TYPE' => 'application/json'
            ],
            content: json_encode([
                'name' => 'Test Product',
                'price' => 1000,
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
}