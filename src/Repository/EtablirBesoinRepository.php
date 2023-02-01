<?php

namespace App\Repository;

use App\Entity\EtablirBesoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtablirBesoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtablirBesoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtablirBesoin[]    findAll()
 * @method EtablirBesoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtablirBesoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtablirBesoin::class);
    }

    // /**
    //  * @return EtablirBesoin[] Returns an array of EtablirBesoin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtablirBesoin
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
