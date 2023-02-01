<?php

namespace App\Repository;

use App\Entity\RetraitMat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Stmt\Declare_;

/**
 * @method RetraitMat|null find($id, $lockMode = null, $lockVersion = null)
 * @method RetraitMat|null findOneBy(array $criteria, array $orderBy = null)
 * @method RetraitMat[]    findAll()
 * @method RetraitMat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetraitMatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RetraitMat::class);
    }

    // /**
    //  * @return RetraitMat[] Returns an array of RetraitMat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RetraitMat
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function SommeMateriel()
    {
        $addMat = $this->getEntityManager();
        $query = $addMat->createQuery(
            'SELECT  sum(ret.quantite) entrees, mat.nomMateriel
             from App\Entity\RetraitMat ret, App\Entity\Materiel mat
             where ret.idMateriel = mat.id
             GROUP BY mat.nomMateriel  
             ORDER BY mat.nomMateriel ASC
            '
        );
        return $query->getResult(); 
    }

    public function tous_id_materiel()
    {
        $addMat = $this->getEntityManager();
        $query = $addMat->createQuery(
            'SELECT mat.id
             from App\Entity\RetraitMat ret, App\Entity\Materiel mat
             where ret.idMateriel = mat.id
             group by mat.id
            '
        );
        return $query->getResult(); 
    }

    public function get_entrees($id)
    {
        $addMat = $this->getEntityManager();
        $query = $addMat->createQuery(
            'SELECT sum(ret.quantite) entree, mat.nomMateriel designation
             from App\Entity\RetraitMat ret, App\Entity\Materiel mat
             where ret.idMateriel = mat.id
             and ret.motif = :motif
             and mat.id = :id
            '
        );
        return $query->setParameter('id', $id)->setParameter('motif', "achat")->getResult(); 
    }

    public function get_sortie($id)
    {
        $addMat = $this->getEntityManager();
        $query = $addMat->createQuery(
            'SELECT sum(ret.quantite) sortie
             from App\Entity\RetraitMat ret, App\Entity\Materiel mat
             where ret.idMateriel = mat.id
             and ret.motif = :motif
             and mat.id = :id
            '
        );
        return $query->setParameter('id', $id)->setParameter('motif', "sortie")->getResult(); 
    }

    public function getInventaireBy()
    {
        $invetBy = $this->getEntityManager();
        $query = $invetBy->createQuery(
            // "SELECT inv from App\Entity\RetraitMat inv
            //  WHERE inv.createdAt = current_date();
            //  ORDER By inv.createdAt desc
            // "
        );
        return $query->getResult();
    }
}
