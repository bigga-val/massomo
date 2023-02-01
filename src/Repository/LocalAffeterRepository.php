<?php

namespace App\Repository;

use App\Entity\LocalAffeter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LocalAffeter|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocalAffeter|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocalAffeter[]    findAll()
 * @method LocalAffeter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalAffeterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocalAffeter::class);
    }

    // /**
    //  * @return LocalAffeter[] Returns an array of LocalAffeter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LocalAffeter
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
