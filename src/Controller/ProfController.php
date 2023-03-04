<?php

namespace App\Controller;

use App\Entity\AffectationCours;
use App\Repository\AffectationCoursRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\common\persistence\ObjectManager;
use App\Entity\Professeur;
use App\Entity\Classe;
use App\Entity\Option;
use App\Entity\Cours;
use App\Respository\CoursRepository;
use App\Respository\ClasseRepository;
use App\Respository\OptionRepository;
use App\Form\ProfType;
use symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use symfony\Component\Form\Extension\Core\Type\SubmittType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ProfController extends AbstractController
{

    /**
     * @Route("/addProf", name="addProf")
     */
    public function NewProf(Request $request, EntityManagerInterface $manager)
    {
        $prof = new Professeur();
        $addProff = $this->createFormBuilder($prof)
                         ->add('nomComplet')
                         ->add('telephone')
                         ->add('adresse', TextareaType::class,[
                            'attr'=>['class'=>'tinymce']
                         ])
                         ->add('lieuNaissance')
                         ->add('dateNaissance', DateType::class,[
                            'widget'=>'single_text',
                            'input'  => 'datetime_immutable'
                         ])
                         ->getForm();
        $addProff->handleRequest($request);
        if($addProff->isSubmitted() && $addProff->isValid()){
             $manager->persist($prof);
             $manager->flush();
             return $this->redirectToRoute('liste_prof');
        }
        return $this->render('prof/prof.html.twig',[
            'formProfesseur'=>$addProff->createView()
        ]);
    }


    /**
     * @Route("/prof", name="prof")
     */
    public function prof(Request $request, EntityManagerInterface $manager): Response
    {

        $professeur = new professeur();
        $formProfesseur = $this->createForm(ProfType::class, $professeur);
        $formProfesseur->handleRequest($request);
        $manager->persist($professeur);
        $manager->flush();

        return $this->render('prof/prof.html.twig', [
            'formProfesseur' => $formProfesseur->createView()
        ]);
    }
    /**
     * @Route("liste_prof", name="liste_prof")
     */
    public function liste(){
        $allprof = $this->getDoctrine()->getRepository(Professeur::class)->findAll();
       return $this->render('prof/liste.html.twig',[
            'allprof' => $allprof
        ]);
    }
    /**
     * @Route("detailprofesseur/{id}",name="detail_prof" )
     */
    public function detailprof($id){
        $detail = $this->getDoctrine()->getRepository(AffectationCours::class)->findBYprofesseur();
        $prof = $this->getDoctrine()->getRepository(AffectationCours::class)->findBy(['professeur'=>$id],[]);
        return $this->render('prof/detail.html.twig', ["listcours"=>$detail, "affects"=>$prof]
        );
    }
}

