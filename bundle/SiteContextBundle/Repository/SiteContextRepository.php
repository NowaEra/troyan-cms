<?php
declare(strict_types=1);

namespace SiteContextBundle\Repository;

use App\Entity\SiteContext;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use SiteContextBundle\Entity\BaseContext;

/**
 * Class SiteContextRepository
 * @package SiteContextBundle\Repository
 */
class SiteContextRepository extends ServiceEntityRepository
{
    const ROOT_NAME = 'root';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteContext::class);
    }

    public function findExcluding(BaseContext $context): array
    {
        return $this
            ->createQueryBuilder('site_context')
            ->select('site_context')
            ->where('site_context != :filteredContext')
            ->setParameter('filteredContext', $context)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getDefaultContext(): BaseContext
    {
        return $this
            ->createQueryBuilder('site_context')
            ->where('site_context.name = :name')
            ->setParameter('name', self::ROOT_NAME)
            ->getQuery()
            ->getSingleResult()
            ;
    }

    public function findOneByHost(string $host): ?BaseContext
    {
        return $this->findOneBy(['host' => $host]);
    }
}
