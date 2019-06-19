<?php

namespace App\Repository;

use App\Entity\WatchedLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WatchedLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method WatchedLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method WatchedLink[]    findAll()
 * @method WatchedLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WatchedLinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WatchedLink::class);
    }

    // /**
    //  * @return WatchedLink[] Returns an array of WatchedLink objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WatchedLink
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
