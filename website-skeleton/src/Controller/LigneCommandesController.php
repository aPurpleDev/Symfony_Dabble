<?php

namespace App\Controller;

use App\Entity\LigneCommandes;
use App\Form\LigneCommandesType;
use App\Repository\LigneCommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ligne/commandes")
 */
class LigneCommandesController extends AbstractController
{
    /**
     * @Route("/", name="ligne_commandes_index", methods={"GET"})
     */
    public function index(LigneCommandesRepository $ligneCommandesRepository): Response
    {
        return $this->render('ligne_commandes/index.html.twig', [
            'ligne_commandes' => $ligneCommandesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ligne_commandes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ligneCommande = new LigneCommandes();
        $form = $this->createForm(LigneCommandesType::class, $ligneCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ligneCommande);
            $entityManager->flush();

            return $this->redirectToRoute('ligne_commandes_index');
        }

        return $this->render('ligne_commandes/new.html.twig', [
            'ligne_commande' => $ligneCommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ligne_commandes_show", methods={"GET"})
     */
    public function show(LigneCommandes $ligneCommande): Response
    {
        return $this->render('ligne_commandes/show.html.twig', [
            'ligne_commande' => $ligneCommande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ligne_commandes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LigneCommandes $ligneCommande): Response
    {
        $form = $this->createForm(LigneCommandesType::class, $ligneCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ligne_commandes_index');
        }

        return $this->render('ligne_commandes/edit.html.twig', [
            'ligne_commande' => $ligneCommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ligne_commandes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LigneCommandes $ligneCommande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligneCommande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ligneCommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ligne_commandes_index');
    }
}
