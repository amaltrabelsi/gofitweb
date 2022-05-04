<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Utilisateur;
use App\Repository\PanierRepository;
use App\Controller\ProduitController;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Doctrine\ORM\EntityManagerInterface;


///**
// * @Route("/panier")
// */
class PanierController extends AbstractController
{

    /**
     * @Route("/panier/{id}", name="app_panier")
     * @param $id
     * @param PanierRepository $panierRepository
     * @return Response
     */

    public function panierParClient( $id,PanierRepository $panierRepository,ProduitRepository $produitRepository ): Response
    {

        $produitspanier=$panierRepository->findCartByClient($id);
        $nbproduit=0;
        $total = 0;
        foreach($produitspanier as $item){
        $produit = $produitRepository->find($item->getFkProduitp());
        $total=$total+$produit->getprixUni();
        $nbproduit++;


    }


        return $this->render('panier/panierClient.html.twig', [
            'panier' => $produitspanier, 't'=> $total, 'n'=>$nbproduit,'idclient'=> $id
        ]);
    }


    /**
     * @Route("/clientpanier", name="client_panier")
     */
    public function index(): Response
    {
        $produitsPanier = $this->getDoctrine()->getManager()->getRepository(Panier::class)->findAll();
        return $this->render('panier/panierClient.html.twig', [
            'p'=>$produitsPanier,
        ]);
    }
    /**
     * @Route("/supprimerProduitPanier/{id}", name="supprimerProduitPanier", requirements={"id":"\d+"})
     */
    public function suppressionPanier(Panier $panier): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($panier);
        $em->flush();


        return $this->redirectToRoute('app_panier',['id'=>11]);


    }
    /**
     * @Route("/viderPanier/{id}", name="vider-panier", requirements={"id":"\d+"})
     */

    public function viderPanier($id,PanierRepository $panierRepository):Response
    {
        $produitspanier=$panierRepository->findCartByClient($id);
        if ( $produitspanier!=null) {
            foreach ($produitspanier as $item) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($item);
                $em->flush();

            }
        }
        return $this->redirectToRoute('app_panier',['id'=>11]);


    }
    /**
     * @Route("/passerCommande/{id}", name="passerCommande")
     */
    public function passerCommande($id,PanierRepository $panierRepository,ProduitRepository $produitRepository, Request $request): Response
    {
//        //wallet tezedelha flous
//        $authWallet = $walletRepository->findOneBy(array('client' => $author,'isMain' => true));
//
//        $authWallet->setBalance($authWallet->getBalance() + $nft->getPrice() );
//        $buyerWallet->setBalance($buyerWallet->getBalance() - $nft->getPrice());
//
//        $walletBlocks = $blockRepository->findBy(array('wallet'=> $buyerWallet));
//
//        $counter = ( $nft->getPrice() / $authWallet->getNodeId()->getNodeReward() )+1;
//
        $produitspanier=$panierRepository->findCartByClient($id);
        $nbproduit=0;
        $total = 0;
        foreach($produitspanier as $item) {
            $produit = $produitRepository->find($item->getFkProduitp());
            $total = $total + $produit->getprixUni();
            $nbproduit++;
        }

        $commande = new Commande();
        $commande->setDateC(new \DateTime('now'));
        $commande->setStatut(0);
        $commande->setFkClientpan($this->getDoctrine()->getRepository(Utilisateur::class)->find($id));
        $commande->setNbProduit($nbproduit);
        $commande->setTotal($total);
        $commande->setModePaiement('chèque');


        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);//Add
        $em->flush();
        $this->viderPanier($id,$panierRepository);
        return $this->redirectToRoute('app_commande');




    }






//    /**
//     * @Route("/", name="app_panier_index", methods={"GET"})
//     */
//    public function index(EntityManagerInterface $entityManager): Response
//    {
//        $paniers = $entityManager
//            ->getRepository(Panier::class)
//            ->findAll();
//
//        return $this->render('mana3rafsh/panierClient.html.twig', [
//            'paniers' => $paniers,
//        ]);
//    }
//



//
//    /**
//     * @Route("/{panierajoutId}", name="app_panier_show", methods={"GET"})
//     */
//    public function show(Panier $panier): Response
//    {
//        return $this->render('panier/panierClient.html.twig', [
//            'panier' => $panier,
//        ]);
//    }
//
//
//    /**
//     * @Route("/{panierajoutId}", name="app_panier_delete", methods={"POST"})
//     */
//    public function delete(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$panier->getPanierajoutId(), $request->request->get('_token'))) {
//            $entityManager->remove($panier);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
//    }




}



