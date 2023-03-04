<?php

namespace App\Controller;

use App\Entity\AffectationCours;
use App\Repository\ClasseRepository;
use App\Repository\ProfesseurRepository;
use Container4ArBDYO\getClasseRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\common\persistence\ObjectManager;
use App\Entity\Classe;
use App\Entity\Professeur;
use App\Entity\date;
use App\Entity\Cours;
use App\Entity\Option;
use App\Form\CoursType;
use App\Form\ClasseType;
use App\Form\OptionType;
use App\Respository\CoursRepository;
use App\Respository\OptionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use symfony\Component\Form\Extension\Core\Type\SubmittType;






class ClasseController extends AbstractController
{
   /**
    * @Route("/addClass", name="/addClass")
    */
    public function addClass(Request $request, EntityManagerInterface $manage) 
    {
        $addClass = new Classe();
        $addCl = $this->createFormBuilder($addClass)
                      ->add('Options', EntityType::class,[
                        'class'=>option::class,
                        'choice_label'=>'designation',
                      ])
                      ->add('titulaire', EntityType::class,[
                        'class'=>Professeur::class,
                        'choice_label'=>'nomComplet',
                      ])
                      ->add('designation', TextareaType::class,[
                        'attr' => ['class'=>'tinymce']
                      ])
                      ->add('is_active')
                      ->getForm();
            $addCl->handleRequest($request);
            if($addCl->isSubmitted() && $addCl->isValid()){
                $manage->persist($addClass);
                $manage->flush();
                return $this->redirectToRoute('liste_cours');
                 
            }
            return $this->render('classe/classe.html.twig', [
                'formClasse'=>$addCl->createView()
            ]); 
    }

    /**
     * @Route("/classe", name="classe")
     */
    public function prof( Request $request, EntityManagerInterface $manager): Response
    {
        $classe = new classe();
        $formClasse = $this->createForm(ClasseType::class, $classe);
        $formClasse->handleRequest($request);
        $manager->persist($classe);
        $manager->flush();

        return $this->render('classe/classe.html.twig', [
            'formClasse' => $formClasse->createView()
        ]);
    }

    /**
     * @Route("liste_cours", name="liste_cours")
     */
    public function liste(Request $request, EntityManagerInterface $manager, ClasseRepository  $coursrepo){
        $allcours =  $this->getDoctrine()->getRepository(Classe::class)->findAll();
        return $this->render('classe/liste_classe.html.twig',[
            'allcours' => $allcours
        ]);
    }
    /**
     * @Route("liste_classe", name="liste_classe")
     */
    public function liste_classe(Request $request, EntityManagerInterface $manager, ClasseRepository $classerepo){
        $allclasse = $classerepo->allclasse();

        return $this->render('classe/classe_cours.html.twig',[
            'allclasse' => $allclasse
        ]);
    }
    /**
     * @Route("detailclasse/{id}",name="detail_classe" )
     */
    public function detailclasse($id){
        //$detail = $this->getDoctrine()->getRepository(AffectationCours::class)->findBYclasse();
        $classe = $this->getDoctrine()->getRepository(AffectationCours::class)->findBy(['classe'=>$id],[]);


        return $this->render('classe/detail.html.twig', [ "affects"=>$classe]
        );
    }
}