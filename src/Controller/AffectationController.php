<?php

namespace App\Controller;

use App\Repository\AffectationCoursRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\common\persistence\ObjectManager;
use App\Entity\AffectationCours;
use App\Entity\Professeur;
use App\Entity\Classe;
use App\Entity\Option;
use App\Entity\Cours;
use App\Form\AffectationType;
use App\Form\CoursType;
use App\Form\OptionType;
use App\Entity\date;
use App\Respository\OptionRepository;
use App\Respository\ClasseRepository;
use App\Respository\CoursRepository;
use symfony\Component\Form\Extension\Core\Type\TextType;
use symfony\Component\Form\Extension\Core\Type\TextareaType;
use symfony\Component\Form\Extension\Core\Type\SubmittType;





class AffectationController extends AbstractController
{
    /**
     * @Route("/affectation", name="affectation")
     */
    public function affectation( Request $request, EntityManagerInterface $manager): Response
    {
        $affectationcours = new affectationcours();
        $formAffectationCours = $this->createForm(AffectationType::class, $affectationcours);
        $formAffectationCours->handleRequest($request);
        $manager->persist($affectationcours);
        $manager->flush();

        return $this->render('affectation/affectation.html.twig', [
            'formAffectationCours' => $formAffectationCours->createView()
        ]);
    }
    /**
     * @Route("prof_cours", name="prof_cours")
     */
    public function liste(Request $request, EntityManagerInterface $manager, ProfesseurRepository  $profcoursrepo){
        $findBYProfesseur = $profcoursrepo->findBYProfesseur();
        return $this->render('affectation/prof_cours.html.twig',[
            'findBYProfesseur' => $findprofcours
        ]);
    }
    /**
     * @Route("liste_affectation", name="liste_affectation")
     */
    public function findByprofesseur(Request $request, EntityManagerInterface $manager, AffectationCoursRepository $affectationrepo){

        $findBYprofesseur = $affectationrepo->findBYprofesseur();
        return $this->render('affectation/prof_cours.html.twig',[
            'findBYprofesseur' => $findBYprofesseur
        ]);
    }
}