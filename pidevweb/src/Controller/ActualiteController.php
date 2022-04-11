<?php

namespace App\Controller;
use App\Entity\Actualite;
use App\Form\ActualiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ActualiteController extends AbstractController
{
    /**
     * @Route("/actualite", name="app_actualite")
     */
    public function index(): Response
    {
        $actualites = $this->getDoctrine()->getManager()->getRepository(Actualite::class)->findAll();
        return $this->render('actualite/index.html.twig', [
            'p'=>$actualites
        ]);
    }
    /**
     * @Route("/admin", name="display_admin")
     */
    public function indexAdmin(): Response
    {

        return $this->render('admin/index.html.twig');
    }



    /**
     * @Route("/createActualite", name="createActualite")
     */
    public function createActualite(Request $request): Response 
    {
        $actualite = new Actualite();

        $form = $this->createForm(ActualiteType::class,$actualite);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);//Add
            $em->flush();

            return $this->redirectToRoute('app_actualite');
        }
        return $this->render('actualite/createActualite.html.twig',['f'=>$form->createView()]);

    }
     /**
     * @Route("/deleteActualite/{id}", name="deleteActualite")
     */
    public function deleteActualite(Actualite  $actualite): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($actualite);
        $em->flush();

        return $this->redirectToRoute('app_actualite');


    }


    /**
     * @Route("/editActualite/{id}", name="editActualite")
     */
    public function editActualite(Request $request,$id): Response
    {
        $actualite = $this->getDoctrine()->getManager()->getRepository(Actualite::class)->find($id);

        $form = $this->createForm(ActualiteType::class,$actualite);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_actualite');
        }
        return $this->render('actualite/editActualite.html.twig',['f'=>$form->createView()]);




    }

}

