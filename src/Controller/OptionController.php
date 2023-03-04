<?php

namespace App\Controller;

use App\Entity\Option;
use App\Form\OptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OptionController extends AbstractController
{
    /**
     * @Route("/option", name="option")
     */
    public function prof( Request $request, EntityManagerInterface $manager): Response
    {
        $option = new option();
        $formOption = $this->createForm(OptionType::class, $option);
        $formOption->handleRequest($request);
        $manager->persist($option);
        $manager->flush();
        return $this->render('option/option.html.twig', [
            'formOption' => $formOption->createView(),
        ]);
    }

    /**
     * @Route("/tousOption", name="tsoption")
     */

    public function showOptions()
    {
        $getAllOption = $this->getDoctrine()->getRepository(Option::class)->findAll();
        return $this->render('option/listeOption.html.twig',[
            'options'=>$getAllOption
        ]);
    }
}
