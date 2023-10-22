<?php

namespace App\Controller;

use App\Entity\SortieCaisse;
use App\Form\SortieCaisse1Type;
use App\Repository\SortieCaisseRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sortie/caisse')]
class SortieCaisseController extends AbstractController
{
    #[Route('/', name: 'sortie_caisse', methods: ['GET'])]
    public function index(SortieCaisseRepository $sortieCaisseRepository): Response
    {
        return $this->render('sortie_caisse/index.html.twig', [
            'sortie_caisses' => $sortieCaisseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sortie_caisse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->request->all();
            if($this->isCsrfTokenValid('paiement', $data['_token']))
            {
                $sortieCaisse = new SortieCaisse();
                $sortieCaisse->setActive(true);
                $sortieCaisse->setCreatedAt(new \DateTime());
                $sortieCaisse->setCreateBy($this->getUser());
                $sortieCaisse->setMontant($data["montant"]);
                $sortieCaisse->setRaison($data["raison"]);

                $entityManager->persist($sortieCaisse);
                $entityManager->flush();
                return $this->redirectToRoute("sortie_caisse");
            }
        }

        return $this->render('sortie_caisse/new.html.twig', [


        ]);
    }

    #[Route('/{id}', name: 'sortie_caisse_show', methods: ['GET'])]
    public function show(SortieCaisse $sortieCaisse): Response
    {
        return $this->render('sortie_caisse/show.html.twig', [
            'sortie_caisse' => $sortieCaisse,
        ]);
    }

    #[Route('/{id}/edit', name: 'sortie_caisse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SortieCaisse $sortieCaisse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SortieCaisse1Type::class, $sortieCaisse);
        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            $data = $request->request->all();
            if($this->isCsrfTokenValid('sortie', $data['_token']))
            {

                $sortieCaisse->setActive(true);
                $sortieCaisse->setMontant($data["montant"]);
                $sortieCaisse->setRaison($data["raison"]);
                $sortieCaisse->setModifiedAt(new \DateTime());
                $sortieCaisse->setModifiedBy($this->getUser());

                $entityManager->persist($sortieCaisse);
                $entityManager->flush();
                return $this->redirectToRoute("sortie_caisse");
            }
        }

        return $this->render('sortie_caisse/edit.html.twig', [
            'sortie_caisse' => $sortieCaisse,
            //'form' => $form->createView(),
        ]);
    }
    #[Route('/pprouver_sortie', name: 'approuver_sortie', methods: ['GET', 'POST'])]
    public function approuver_sortie(Request $request, EntityManagerInterface $entityManager, SortieCaisseRepository $sortieCaisseRepository): Response
    {

        if ($request->isMethod('POST'))
        {
            $data = $request->request->all();
            if($this->isCsrfTokenValid('sortie', $data['_token']))
            {
                $sortieCaisse = $sortieCaisseRepository->find($data["id"]);
                $sortieCaisse->setActive(true);
                $sortieCaisse->setApprovedAt(new \DateTime());
                $sortieCaisse->setApprovedBy($this->getUser());

                $entityManager->persist($sortieCaisse);
                $entityManager->flush();
                return $this->redirectToRoute("sortie_caisse");
            }
        }

        return $this->render('sortie_caisse/edit.html.twig', [
            'sortie_caisse' => $sortieCaisse,
            //'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'sortie_caisse_delete', methods: ['DELETE'])]
    public function delete(Request $request, SortieCaisse $sortieCaisse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sortieCaisse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sortieCaisse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sortie_caisse_index');
    }
}
