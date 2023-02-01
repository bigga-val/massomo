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
use App\Repository\CoursRepository as RepositoryCoursRepository;
use symfony\Component\Form\Extension\Core\Type\TextType;
use symfony\Component\Form\Extension\Core\Type\TextareaType;
use symfony\Component\Form\Extension\Core\Type\SubmittType;

class CoursController extends AbstractController
{
    /**
     * @Route("/cours", name="cours")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $cours= new cours();
        $formCours = $this->createForm(CoursType::class, $cours);
        $formCours->handleRequest($request);
        $manager->persist($cours);
        $manager->flush();
        return $this->render('cours/cours.html.twig', [
            'formCours' => $formCours->createView()
        ]);
    }
    /**
     * @Route("liste_cour", name="liste_cour")
     */
    public function liste(Request $request, EntityManagerInterface $manager, RepositoryCoursRepository  $coursrepo){
        $allcours = $coursrepo->allcours();
        return $this->render('cours/liste_classe.html.twig',[
            'allcours' => $allcours
        ]);
    }

}
