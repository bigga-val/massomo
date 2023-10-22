<?php

namespace App\Controller;

use App\Entity\AnneeScolaire;
use App\Entity\Categorie;
use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Option;
use App\Entity\Etat;
use App\Entity\Inscription;
use App\Entity\Tuteur;
use App\Entity\Parents;
use App\Repository\InscriptionRepository\getTotalEleveInscrit;
use App\Controller\AnneeScolaireController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use function mysql_xdevapi\getSession;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscriptions", name="inscriptions")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = new Session();
        //dd($session->get('annee_courante'));
        //$inscriptions = $this->getDoctrine()->getRepository(Inscription::class)
        //  ->findBy(['eleve.etat_id'=>1]);
        $inscripts = $this->getDoctrine()->getRepository(Inscription::class)
            ->findElevesActifs($session->get('id_annee'));

        //dd($inscripts);
        $user = $this->getUser();
        $annee_en_cours = $this->getDoctrine()->getRepository(AnneeScolaire::class)
            ->findOneBy(['etat'=>'en cours'], []);
        $session = new Session();
        //dd($session->get('annee_courante'));
        return $this->render('inscription/login.html.twig', [
            'controller_name' => 'InscriptionController',
            'inscriptions' => $inscripts,
            'annee_en_cours'=>$annee_en_cours
        ]);
    }

    /**
     * @Route("/nouvelle_inscription", name="nouvelle_inscription")
     */
    public function inscrire(Request $request, EntityManagerInterface $entityManager)
    {
        if($request->isMethod('POST'))
        {
            $session = new Session();
            $data = $request->request->all();
            if($this->isCsrfTokenValid('inscription', $data['_token']))
            {
                $eleve = new Eleve();
                $inscription = new Inscription();   
                $eleve->setCategorie($this->getDoctrine()->getRepository(Categorie::class)
                    ->find($data['categorie']));
                $eleve->setEtat($this->getDoctrine()->getRepository(Etat::class)
                    ->find($data['etat']));
                $eleve->setTuteur($this->getDoctrine()->getRepository(Tuteur::class)
                    ->find($data['tuteur']));
                $eleve->setParents($this->getDoctrine()->getRepository(Parents::class)
                ->find($data['parents']));
                $inscription->setIdOption($this->getDoctrine()->getRepository(Option::class)
                ->find($data['id_option']));
                $eleve->setAdresse($data['adresse']);
                $eleve->setDateNaissance(new \DateTime($data['date_naissance']));
                $eleve->setLieuNaissance($data['lieu_naissance']);
                $eleve->setNomComplet($data['nom_complet']);
                $eleve->setAptePhysique($data['aptePhysique']);
                $eleve->setMaladieChronique($data['maladieChronique']);
                $eleve->setNomMaladie($data['nomMaladie']);
                $eleve->setGenre($data['genre']);
                $eleve->setPhotographier($data['photographier']);
                $entityManager->persist($eleve);
                $files = $this->createFormBuilder($eleve)
                ->add('certificatMedical', FileType::class, [
                    'label'=>'selectionner un fichier',
                    'required'=>false
                ])->getForm();
                $files->handleRequest($request);
                // if($files->isSubmitted() && $files->isValid()){
                    $fichier = $eleve->getCertificatMedical();
                    if($fichier){
                        $fileName = md5(uniqid()).'.'.$fichier->guessExtension();
                        $fichier->move(
                            $this->getParameter('public/uploads'),
                            $fileName
                        );
                    }
                    $fichier->setCertificatMedical();
                    $entityManager->persist($fichier);
                    // $entityManager->flush();
            //    }
                $inscription->setCreatedAt(new \DateTime('now'));
                $inscription->setClasse($this->getDoctrine()->getRepository(Classe::class)
                    ->find($data['classe']));
                $inscription->setEleve($eleve);
                $inscription->setAnneeScolaire($this->getDoctrine()->getRepository(AnneeScolaire::class)
                    ->find($session->get('id_annee')));
                $inscription->setToken($data['_token']);
                $entityManager->persist($inscription);

                $entityManager->flush();
            }
        }
        $annees = $this->getDoctrine()->getRepository(AnneeScolaire::class)
            ->findAll();
        $classes = $this->getDoctrine()->getRepository(Classe::class)
            ->findAll();
        $tuteurs = $this->getDoctrine()->getRepository(Tuteur::class)
            ->findBy([], ['id'=>'asc']);
        $categories = $this->getDoctrine()->getRepository(Categorie::class)
            ->findAll();
        $parents = $this->getDoctrine()->getRepository(Parents::class)->findAll();

        $options = $this->getDoctrine()->getRepository(Option::class)->findAll();
        $etats = $this->getDoctrine()->getRepository(Etat::class)
            ->findAll();
        return $this->render('inscription/index.html.twig', [
           'annees'=>$annees,
           'categories'=>$categories,
           'etats'=>$etats,
           'classes'=>$classes,
           'tuteurs'=>$tuteurs,
           'parents'=>$parents,
           'options'=>$options
        ]);
    }

    /**
     * @Route("statEcole", name="statEcole")
     */
    public function getStatEcole(Request $request){
        $session = new Session();
        
        $liste_classes = $this->getDoctrine()->getRepository(Classe::class)
            ->findBy(['is_active'=>true]);
        $liste_option = $this->getDoctrine()->getRepository(Option::class)
            ->findBy(['is_active'=>true]);
        $inscrit = $this->getDoctrine()->getRepository(Inscription::class)
            ->findBy(['token'=>true]);

            if($request->isXmlHttpRequest()){
                $data = $request->request->all();
                $designation = $data['designation'];
                $Classe = $data['Classe'];
                
                $classTri = $this->getDoctrine()->getRepository(Inscription::class)->findByclasse($designation, $Classe);
                return new JsonResponse($classTri);
            } 
        
        $allStat = $this->getDoctrine()->getRepository(Inscription::class)->getTotalEleveInscrit($session->get('id_annee'));
        $genreTot = $this->getDoctrine()->getRepository(Inscription::class)->getTotGenre();
        $maternelle = $this->getDoctrine()->getRepository(Inscription::class)->getTotByOptionMaternelle();
        $genreMat = $this->getDoctrine()->getRepository(Inscription::class)->getMaternelleGenre(); 
        $primaire = $this->getDoctrine()->getRepository(Inscription::class)->getTotByOptionPrimaire(); 
        $genrePrimaire = $this->getDoctrine()->getRepository(Inscription::class)->getPrimaireGenre();
        $secondaire = $this->getDoctrine()->getRepository(Inscription::class)->getTotByOptionSecondaire();
        $genreSecondaire = $this->getDoctrine()->getRepository(Inscription::class)->getSecondaireGenre(); 
       

        return $this->render('inscription/stat.html.twig',
        [
            'total'=>$allStat,
            'maternelle'=>$maternelle,
            'primaire'=>$primaire,
            'secondaire'=>$secondaire,
            'genreMat'=>$genreMat,
            'genrePrimaire'=>$genrePrimaire,
            'genreSecondaire'=>$genreSecondaire,
            'genreTot'=>$genreTot,
            'liste_classe'=>$liste_classes,
            'liste_option'=>$liste_option,
            'getByClasse'=>$inscrit,
        ]);
    }

    /**
     * @Route("tri_par_classe", name="tri_par_classe")
     */
     public function trier_class(Request $request){

        if($request->isXmlHttpRequest()){
            $data = $request->request->all();
            $designation = $data['designation'];
            $Classe = $data['Classe'];
            
            $liste_par_classe = $this->getDoctrine()->getRepository(Inscription::class)->findByclasse($designation, $Classe);
            dd($liste_par_classe);
            return new JsonResponse($liste_par_classe);
        } 
    }
}
