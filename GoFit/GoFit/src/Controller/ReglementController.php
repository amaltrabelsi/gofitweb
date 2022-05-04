<?php

namespace App\Controller;

use App\Entity\Reglement;
use App\Form\ReglementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reglement")
 */
class ReglementController extends AbstractController
{
    /**
     * @Route("/", name="app_reglement_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reglements = $entityManager
            ->getRepository(Reglement::class)
            ->findAll();

        return $this->render('reglement/index.html.twig', [
            'reglements' => $reglements,
        ]);
    }

    /**
     * @Route("/new", name="app_reglement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reglement = new Reglement();
        $form = $this->createForm(ReglementType::class, $reglement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reglement);
            $entityManager->flush();

            return $this->redirectToRoute('app_reglement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reglement/new.html.twig', [
            'reglement' => $reglement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{reglementId}", name="app_reglement_show", methods={"GET"})
     */
    public function show(Reglement $reglement): Response
    {
        return $this->render('reglement/show.html.twig', [
            'reglement' => $reglement,
        ]);
    }

    /**
     * @Route("/{reglementId}/edit", name="app_reglement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reglement $reglement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReglementType::class, $reglement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reglement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reglement/edit.html.twig', [
            'reglement' => $reglement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{reglementId}", name="app_reglement_delete", methods={"POST"})
     */
    public function delete(Request $request, Reglement $reglement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reglement->getReglementId(), $request->request->get('_token'))) {
            $entityManager->remove($reglement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reglement_index', [], Response::HTTP_SEE_OTHER);
    }





}
