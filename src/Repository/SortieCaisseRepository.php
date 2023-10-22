<?php

namespace App\Repository;

use App\Entity\SortieCaisse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SortieCaisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method SortieCaisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method SortieCaisse[]    findAll()
 * @method SortieCaisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieCaisseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SortieCaisse::class);
    }

    public function sortiesCaisse($anneeID){
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            '
                select SUM(s.montant)
                from App\Entity\SortieCaisse s, App\Entity\AnneeScolaire a 
                 where a.id = s.annee_scolaire
                 and a.id = :anneeID
            '
        );
        return $query->setParameter('anneeID', $anneeID)->getResult();
    }

    // /**
    //  * @return SortieCaisse[] Returns an array of SortieCaisse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SortieCaisse
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
