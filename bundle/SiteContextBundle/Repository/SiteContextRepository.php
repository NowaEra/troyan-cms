<?php
declare(strict_types=1);

namespace SiteContextBundle\Repository;

use App\Entity\SiteContext;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function findExcluding(SiteContext $context): array
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
}
