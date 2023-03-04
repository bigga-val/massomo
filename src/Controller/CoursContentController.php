<?php

namespace App\Controller;

use App\Entity\CoursContent;
use App\Form\CoursContentType;
use App\Repository\CoursContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cours/content")
 */
class CoursContentController extends AbstractController
{
    /**
     * @Route("/", name="cours_content_index", methods={"GET"})
     */
    public function index(CoursContentRepository $coursContentRepository): Response
    {
        return $this->render('cours_content/index.html.twig', [
            'cours_contents' => $coursContentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cours_content_new", methods={"GET","POST"})
     * @Route("/{id}", name="cours_content_show", methods={"GET"})
     */
    public function new(Request $request): Response
    {
        $coursContent = new CoursContent();
        $form = $this->createForm(CoursContentType::class, $coursContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coursContent);
            $entityManager->flush();

            return $this->redirectToRoute('cours_content_index');
        }

        return $this->render('cours_content/new.html.twig', [
            'cours_content' => $coursContent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_content_show", methods={"GET"})
     */
    public function show(CoursContent $coursContent): Response
    {
        return $this->render('cours_content/show.html.twig', [
            'cours_content' => $coursContent,
        ]);
    }

    /**
     * @Route("/{id}", name="cours", methods={"GET"})
     */
    public function CoursCont(CoursContent $cours): Response
    {
        return $this->render('cours/show.html.twig', [
            'cours_content' => $cours,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cours_content_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CoursContent $coursContent): Response
    {
        $form = $this->createForm(CoursContentType::class, $coursContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_content_index');
        }

        return $this->render('cours_content/edit.html.twig', [
            'cours_content' => $coursContent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_content_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CoursContent $coursContent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coursContent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coursContent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cours_content_index');
    }
}
