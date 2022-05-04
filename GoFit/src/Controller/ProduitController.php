<?php

namespace App\Controller;

use App\AppBundle;
use App\Entity\Business;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        return $this->render('produit/index.html.twig', [
            'p' => $produits
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


        $form = $this->createForm(ProduitType::class, $produit);


        $form->handleRequest($request);

        $produit->setFkBusinees($this->getDoctrine()->getRepository(Business::class)->find(1));

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('pathImage')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('images_directory'), $fileName);
            $produit->setPathImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);//Add
            $em->flush();

            return $this->redirectToRoute('app_produit');
        }
        return $this->render('produit/creerProduit.html.twig', ['f' => $form->createView()]);


    }






    /**
     * @Route("/supprimerProduit/{id}", name="supprimerProduit")
     */
    public function suppressionBlog(Produit $produit): Response
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
    public function modificationProduit(Request $request, $id): Response

    {
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $produit = $form->getData();


            $file = $form->get('pathImage')->getData();

            if ($produit->getPathImage() != null) {
                $image = $produit->getPathImage();

                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('images_directory'), $fileName);
                $produit->setPathImage($fileName);

            } else {

                $produit->setPathImage($file);

            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_produit');
        }
        return $this->render('produit/modifierProduit.html.twig', ['f' => $form->createView()]);


    }

    /**
     * @Route("/produit/{id}", name="detail_produit")
     */
    public function detail_produit($id): Response
    {
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        return $this->render('produit/detailsProduit.html.twig', [

            'detail' => $produit,


        ]);
    }


    /**
     * @Route("/frontDetailsProduit/{id}", name="detail_produit_front")
     */
    public function detail_produit_front($id, ProduitRepository $produitRepository): Response
    {   $categorie='fitness';
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        if($produit!= null ){
            $categorie=$produit->getCategorie();
        }



        $produitscategorie=$this->getDoctrine()->getRepository(Produit::class)->findBy(['categorie'=>$categorie],['categorie' => 'desc']);




        return $this->render('ProduitFront/detailsProduit.html.twig', [

            'detail' => $produit,'produits'=>$produitscategorie,


        ]);
    }

    /**
     * @Route("/listproduit", name="produit_front")
     */
    public function indexFront(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees= $this->getDoctrine()->getRepository(Produit::class)->findAll();
         $produits= $paginator->paginate(
             $donnees,
             $request->query->getInt('page',1),//numero de la page en cours par defaut 1
             20

         );

        return $this->render('ProduitFront/index.htm.twig', [

            'p' => $produits,


        ]);


    }


    //////// search  with ajax
    /**
     * @Route("/ajaxSearch", name="searchAjax")
     */

    public function searchAction (Request $request,ProduitRepository $produitRepository): Response
    {

        $requestString =$request->get('q');
        $posts = $produitRepository->findEntitiesByString($requestString);
        if(!$posts)
        {
            $result['posts']['error']="product not found";
        }
        else {
            $result['posts']=$this->getRealEntities($posts);

        }
        return new Response(json_encode($result));

    }
    //setCategorie   getNomProduit  getDescription  getPrixUni  getRefP  getProduitId

    public function getRealEntities($posts)
{
    foreach ($posts as $post){
        $realEntities[$post->getProduitId()]=[$post->getNomProduit()];
    }
    return $realEntities;

}


    /**
     * @Route("/ajouterProduitPanier/{id}", name="ajouterProduitPanier")
     */
    public function newPanier($id): Response
    {
        $panier = new Panier();
        $panier->setFkProduitp(($this->getDoctrine()->getRepository(Produit::class)->find($id)));
        $panier->setFkUserclient($this->getDoctrine()->getRepository(Utilisateur::class)->find(11));

        $em = $this->getDoctrine()->getManager();
        $em->persist($panier);
        $em->flush();

        $this->addFlash(

            'success',
            'produit ajouté au panier avec succès ! '
        );

        return $this->redirectToRoute('produit_front');
    }

}