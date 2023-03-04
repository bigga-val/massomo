<?php

namespace App\Repository;

use App\Entity\CoursContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoursContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursContent[]    findAll()
 * @method CoursContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursContent::class);
    }

    // /**
    //  * @return CoursContent[] Returns an array of CoursContent objects
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
    public function findOneBySomeField($value): ?CoursContent
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
