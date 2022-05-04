<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadFile;


use Symfony\Component\Validator\Constraints\File;
use App\Repository\ProduitRepository;
class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        $produits = $this->getDoctrine()->getManager()->getRepository(Produit::class)->findAll();
        return $this->render('produit/index.html.twig', [
            'p'=>$produits
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
     * @Route("/ajouterProduit", name="ajouterProduit")
     */
    public function ajouterProduit(Request $request): Response
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitType::class,$produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $file =$form->get('pathImage')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directory'), $fileName);
            $produit->setPathImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);//Add
            $em->flush();

            return $this->redirectToRoute('app_produit');
        }
        return $this->render('produit/creerProduit.html.twig',['f'=>$form->createView()]);


    }
    /**
     * @Route("/supprimerProduit/{id}", name="supprimerProduit")
     */
    public function suppressionBlog(Produit  $produit): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('app_produit');


    }


    /**
     * @Route("/modifierProduit/{id}", name="modifierProduit")
     *
     */
    public function modificationProduit(Request $request,$id): Response

    {
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        $form = $this->createForm(ProduitType::class,$produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {


            $produit = $form->getData();


            $file = $form->get('pathImage')->getData();

            if ( $produit->getPathImage() != null) {
                $image = $produit->getPathImage();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('images_directory'), $fileName);
                $produit->setPathImage($fileName);

            } else {

                $produit->setPathImage( $file );

            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_produit');
        }
        return $this->render('produit/modifierProduit.html.twig',['f'=>$form->createView()]);




    }

    /**
     * @Route("/produit/{id}", name="detail_produit")
     */
    public function detail_produit($id): Response
    {
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        return $this->render('produit/detailsProduit.html.twig', [
            'detail'=> $produit,
        ]);
    }





}
