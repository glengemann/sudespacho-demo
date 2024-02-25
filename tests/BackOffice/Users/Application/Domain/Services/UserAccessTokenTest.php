<?php declare(strict_types=1);

namespace App\Tests\BackOffice\Users\Application\Domain\Services;

use App\BackOffice\Users\Domain\Model\User;
use App\BackOffice\Users\Domain\Services\UserAccessToken;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class UserAccessTokenTest extends TestCase
{
    private EntityManagerInterface $entityManager;
    private UserAccessToken $userAccessToken;

    protected function setUp(): void
    {
        $this->entityManager = $this
            ->createMock(EntityManagerInterface::class);
        $this->userAccessToken = new UserAccessToken($this->entityManager);
    }

    public function testCreate()
    {
        $user = $this->createMock(User::class);

        $result = $this->userAccessToken->create($user);

        $this->assertIsString($result);
    }
}