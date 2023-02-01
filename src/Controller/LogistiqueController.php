<?php

namespace App\Controller;

use App\Entity\CategorieMat;
use App\Entity\EtablirBesoin;
use App\Entity\Fournisseur;
use App\Entity\Logisticien;
use App\Entity\Materiel;
use App\Entity\RetraitMat;
use App\Repository\RetraitMatRepository;
use ContainerVvQ4hwJ\getResponseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LogistiqueController extends AbstractController
{
    /**
     * @Route("/logistique", name="logistique")
     */
    public function index(): Response
    {
        return $this->render('logistique/index.html.twig', [
            'controller_name' => 'logistiqueController',
        ]);
    }

    /**
     * @Route("/logins", name="logins")
     */
    public function login(): Response
    {
        return $this->render('logistique/login.html.twig');
    }

    /**
     * @Route("/addMateriel", name="materiel")
     */
    public function Materiel(Request $request, EntityManagerInterface $manager)
    {
       $newMateriel = new Materiel();
       $newMateriel->setDateAchat(new \DateTime('now'));
       $mat = $this->createFormBuilder($newMateriel)
                   ->add('nomMateriel')
                   ->add('quantite')
                   ->add('idFournisseur', EntityType::class,[
                       'class'=>Fournisseur::class,
                       'choice_label'=>'nomComplet'
                   ])
                   ->add('idCategorie', EntityType::class,[
                       'class'=>CategorieMat::class,
                       'choice_label'=>'nomCategorie',
                       'label'=>'Categorie'
                   ])
                //    ->add('etat',CheckboxType::class,[
                //        'label'=>'valider',
                //        'required'=>true
                //    ])
                   ->getForm();
        $mat->handleRequest($request);
        if($mat->isSubmitted() && $mat->isValid())
        {
             $manager->persist($newMateriel);
             $manager->flush();
             return $this->redirectToRoute('all_materiel');
        }
        return $this->render('logistique/materiel.html.twig',[
            'formMateriel'=>$mat->createView()
        ]);
    }

    /**
     * @Route("/allMateriel", name="all_materiel")
     */
    public function showMateriel()
    {
       $allMat = $this->getDoctrine()->getRepository(Materiel::class)->findAll();
        return $this->render('logistique/listeMat.html.twig', [
            'getAll'=>$allMat
        ]);
    }

    /**
     * @Route("/besionEtat", name="besionEtat")
     */

     public function etatBesion(Request $request, EntityManagerInterface $manager)
     {
        $besion = new EtablirBesoin();
        $besion->setCreatedAt( new \DateTime('now'));
        $etat = $this->createFormBuilder($besion)
                     ->add('designation',TextareaType::class,[
                        'attr' => ['class' => 'tinymce'],
                     ])
                     ->add('createdBy',EntityType::class,[
                        'class'=>Logisticien::class,
                        'choice_label'=>'nomLogisticien',
                        'label'=>'nom du logisticien'
                     ])
                     ->getForm();
        $etat->handleRequest($request);
        if($etat->isSubmitted() && $etat->isValid())
        {
            $manager->persist($besion);
            $manager->flush();
            return $this->redirectToRoute('all_besion');
        }
        return $this->render('logistique/etatBesion.html.twig', [
            'addBesoin'=>$etat->createView()
        ]);  
     }

     /**
      * @Route("/allBesion",name="all_besion")
      */
      public function getBesion()
      {
          $getEtat = $this->getDoctrine()->getRepository(EtablirBesoin::class)->findAll();
          return $this->render('logistique/showEtat.html.twig', [
            'allEtat'=>$getEtat
        ]); 
      }

      /**
       * @Route("detailEtat/{id}", name="detail_Etat")
       */
      public function detailBesoin($id)
      {
        $getById = $this->getDoctrine()->getRepository(EtablirBesoin::class)->find($id);
        return $this->render('logistique/detailEtat.html.twig', [
            'etatById'=>$getById
        ]); 
      }

    //   creation des categories
    /**
     * @Route("/newCategorie", name="categorie")
     */
    public function addCategorie(Request $request, EntityManagerInterface $manager)
    {
        $catag = new CategorieMat();
        $catag->setCreatedAt(new \DateTime('now'));
        $categorie = $this->createFormBuilder($catag)
                          ->add('nomCategorie')
                          ->getForm();
        $categorie->handleRequest($request);
        if($categorie->isSubmitted() && $categorie->isValid())
        {
            $manager->persist($catag);
            $manager->flush();
           
        }
        $getAllCategorie = $this->getDoctrine()->getRepository(CategorieMat::class)->findAll();
        return $this->render('logistique/categorie.html.twig', [
            'formCateg'=>$categorie->createView(),
            'getCateg'=>$getAllCategorie
        ]);
    }
    // faire l inventaire
    /**
     * @Route("addInventory",name="inventory")
     * @Route("addInventory/{id}/edit", name="inventory_edit")
     */
    public function addInventaire(Request $request, EntityManagerInterface $manager, RetraitMat $invente=null, RetraitMatRepository $getsomme)
    {
       if(!$invente)
       {
        $invente = new RetraitMat();
        $invente->setCreatedAt(new \DateTime('now'));
       }
        // $invente = new RetraitMat();
        $inventaire = $this->createFormBuilder($invente)
                           ->add('idMateriel',EntityType::class,[
                               'class'=>Materiel::class,
                               'choice_label'=>'nomMateriel',
                               'label'=>'nom du materiel'
                           ])
                           ->add('motif', ChoiceType::class, [
                            'choices' => [
                                'achat materiel' =>'achat',
                                'sortie materiel' =>'sortie',]
                            ],TextareaType::class,[
                                'attr' => ['class' => 'tinymce'],
                               ],)
                           ->add('quantite')
                           ->getForm();
        $inventaire->handleRequest($request);
        if($inventaire->isSubmitted() && $inventaire->isValid())
        {
            // dd($invente);
            $manager->persist($invente);
            $manager->flush();
            if(!$invente->getId())
            {
                $invente->setCreatedAt(new \DateTime('now'));
            }

        }
        // sommation des entrées
        $allSomme = $getsomme->SommeMateriel();
        $ids = $getsomme->tous_id_materiel();
        //dd($ids);
        $stock = 0;
        $tab = array();
        //dd($entree = $getsomme->get_entrees(1));
        for($i = 0; $i < count($ids); $i++)
        {
            
            $sortie = $getsomme->get_sortie($ids[$i]['id']);
            $entree = $getsomme->get_entrees($ids[$i]['id']);
            
            $stock = $entree[0]['entree'] - $sortie[0]['sortie'];
            $array = array($entree[0]['entree'], $entree[0]['designation'], $sortie[0]['sortie'], $stock);
            array_push($tab, $array);
        }
        // dd($tab);
        // inventaire par mois 
        // $allByMonth =$getsomme->getInventaireBy();
        return $this->render('logistique/inventaire.html.twig', [
           'formInvente'=>$inventaire->createView(),
           'editInvente'=>$invente->getId() !== null,
           'sommeMat'=>$allSomme,
           'stock'=>$tab,
        //    'getMonth'=>$allByMonth
        ]);
    }

    /**
     * @Route("/getAllMouvement", name="all_mouvement")
     */
    public function getMouvement()
    {
         // tous les mouvements 
         $mouv = $this->getDoctrine()->getRepository(RetraitMat::class)->findAll();
         return $this->render('logistique/listeMouv.html.twig', [
            'getAllStock'=>$mouv
         ]);
    }
    
}

