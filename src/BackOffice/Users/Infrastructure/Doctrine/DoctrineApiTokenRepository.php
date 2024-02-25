<?php

namespace App\BackOffice\Users\Infrastructure\Doctrine;

use App\BackOffice\Users\Domain\Model\ApiToken;
use App\BackOffice\Users\Domain\Repository\ApiTokenRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApiToken>
 *
 * @method ApiToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiToken[]    findAll()
 * @method ApiToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineApiTokenRepository extends ServiceEntityRepository implements ApiTokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiToken::class);
    }

    public function findOneByToken(string $token): ?ApiToken
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
