<?php

namespace App\Repository;

use App\Entity\CategorieMat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieMat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieMat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieMat[]    findAll()
 * @method CategorieMat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieMatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieMat::class);
    }

    // /**
    //  * @return CategorieMat[] Returns an array of CategorieMat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieMat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
