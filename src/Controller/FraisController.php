<?php

namespace App\Controller;

use App\Entity\Frais;
use App\Entity\Tuteur;
use App\Form\FraisType;
use App\Form\TuteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FraisController extends AbstractController
{
    /**
     * @Route("/frais", name="frais")
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $frais = new Frais();
        $form = $this->createForm(FraisType::class, $frais);
        //dd($form);

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $frais->setIsActive(true);
            $entityManager->persist($frais);
            $entityManager->flush();
        }
        $liste_frais = $this->getDoctrine()->getRepository(Frais::class)
            ->findBy(['is_active'=>true], ['id'=>'asc']);
        return $this->render('frais/index.html.twig', [
            'controller_name' => 'FraisController',
            'form'=>$form->createView(),
            'liste_frais'=>$liste_frais
        ]);
    }

    /**
     * @Route("/{id}/edit", name="frais_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Frais $frais): Response
    {
          $form =$this->createForm(FraisType::class, $frais );
          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('frais');
          }

          return $this->render('frais/edit.html.twig', [
            'frais' => $frais,
            'form' => $form->createView(),
        ]);
    }
    
    
    /**
     * @Route("/{id}", name="frais_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Frais $frais): Response 
    {
        if($this->isCsrfTokenValid('delete'.$frais->getId(), $request->request->get('_token'))){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($frais);
            $entityManager->flush();
        }
        return $this->redirectToRoute('frais');
    }

}
