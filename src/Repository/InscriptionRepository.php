<?php

namespace App\Repository;

use App\Entity\Inscription;
use App\Entity\Option;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscription[]    findAll()
 * @method Inscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscription::class);
    }

    // /**
    //  * @return Inscription[] Returns an array of Inscription objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Inscription
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findElevesActifs($id_annee)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            select i
            from App\Entity\Inscription i, App\Entity\Eleve e
            where e.id = i.eleve and e.etat = 1 and i.annee_scolaire = :annee
        ');
        return $query->setParameter('annee', $id_annee)->getResult();
    }

   public function getTotalEleveInscrit($id_annee){
     $entityManager = $this->getEntityManager();
     $query = $entityManager->createQuery('
         select  count(i.id) tot
         FROM App\Entity\Inscription i
        Where  i.annee_scolaire = :annee
     ');
     return $query->setParameter('annee', $id_annee)->getResult();
   }
    
   public function getTotByOptionMaternelle(){
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery('
    SELECT count(e.nom_complet) mat, o.designation 
    from App\Entity\inscription i, App\Entity\eleve e, App\Entity\option o 
    WHERE e.id = i.eleve 
    and o.id = i.idOption
    and o.designation= :materne
        ');
        return $query->setParameter('materne', 'maternelle')->getResult();
   }
   
   public function getTotGenre(){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT e.genre, count(e.genre) age
            from App\Entity\inscription i, App\Entity\eleve e, App\Entity\option o
            WHERE e.id = i.eleve
            and o.id = i.idOption 
            GROUP by e.genre
        ');
        return $query->getResult();
    }
   
   public function getMaternelleGenre(){
      $entityManager = $this->getEntityManager();
      $query = $entityManager->createQuery('
           SELECT e.genre, count(e.genre) age
           from App\Entity\inscription i, App\Entity\eleve e, App\Entity\option o
           WHERE e.id = i.eleve
           and o.id = i.idOption 
           and o.designation= :genre 
           GROUP by e.genre
      ');
      return $query->setParameter('genre', 'maternelle')->getResult();
   }

   public function getTotByOptionPrimaire(){
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        '
        SELECT count(e.nom_complet) primaire, o.designation 
        from App\Entity\inscription i, App\Entity\eleve e, App\Entity\option o 
        WHERE e.id = i.eleve 
        and o.id = i.idOption
        and o.designation= :prime
        ');
        return $query->setParameter('prime', 'primaire')->getResult();
   }
   public function getPrimaireGenre(){
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery('
         SELECT e.genre, count(e.genre) age
         from App\Entity\inscription i, App\Entity\eleve e, App\Entity\option o
         WHERE e.id = i.eleve
         and o.id = i.idOption 
         and o.designation= :genre 
         GROUP by e.genre
    ');
    return $query->setParameter('genre', 'primaire')->getResult();
 }
   
   public function getTotByOptionSecondaire(){
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        '
        SELECT count(e.nom_complet) secondaire, o.designation 
        from App\Entity\inscription i, App\Entity\eleve e, App\Entity\option o 
        WHERE e.id = i.eleve 
        and o.id = i.idOption
        and o.designation= :second
        ');
        return $query->setParameter('second', 'secondaire')->getResult();
   }
   public function getSecondaireGenre(){
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery('
         SELECT e.genre, count(e.genre) age
         from App\Entity\inscription i, App\Entity\eleve e, App\Entity\option o
         WHERE e.id = i.eleve
         and o.id = i.idOption 
         and o.designation= :genre 
         GROUP by e.genre
    ');
    return $query->setParameter('genre', 'secondaire')->getResult();
 }

  public function findByclasse($designation, $Classe){
      $entityManager = $this->getEntityManager();
      $query = $entityManager->createQuery(' 
        SELECT count(e.nom_complet) totClass, o.designation, c.designation
        from App\Entity\inscription, App\Entity\eleve e, App\Entity\option o, App\Entity\classe c
        WHERE e.id = i.eleve and o.id = i.idOption
        and o.designation= :designation
        and c.designation=:Classe
        '
      );
      return $query->setParameter('designation', $designation)->setParameter('Classe', $Classe)->getResult();
  }
    public function findElevesNonActifs()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            select i
            from App\Entity\Inscription i, App\Entity\Eleve e
            where e.id = i.eleve and e.etat != 1
        ');
        return $query->getResult();
    }
}
