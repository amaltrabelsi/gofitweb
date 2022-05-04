<?php

namespace App\Controller;
use App\Entity\Utilisateur;
use App\Repository\CommandeRepository;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CommandeController extends AbstractController

{   //PART ADMIN


    /**

     * @Route("/admin/commande", name="app_commande")
     */
    public function index(CommandeRepository $commandeRepository): Response
    {


        $statut=false ;
        $commandesapproved = $commandeRepository->findAll();
        $commandesnotapprocved = $this->getDoctrine()->getRepository(Commande::class)->findBy(['statut'=> false],['dateC' => 'desc']);

        return $this->render('commande/index.html.twig', [
             'c'=>$commandesnotapprocved
        ]);
    }




    /**
     * @Route("/supprimerCommande/{id}", name="supprimerCommande")
     */
    public function supprimerCommande(Commande  $commande): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($commande);
        $em->flush();

        return $this->redirectToRoute('app_commande');


    }

    /**
     * @Route("/ajouterCommande", name="ajouterCommande")
     */
    public function ajouterCommande(Request $request): Response
    {
        $commande = new Commande();
        $commande->setDateC(new \DateTime('now'));
        $commande->setStatut(0);
        $form = $this->createForm(CommandeType::class,$commande);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);//Add
            $em->flush();
            return $this->redirectToRoute('app_commande');
        }
        return $this->render('commande/creerCommande.html.twig',['c'=>$form->createView()]);


    }
















    /**
     * @Route("/modifierCommande/{id}", name="modifierCommande")
     */
    public function modificationCommande(Request $request,$id): Response
    {
        $commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->find($id);

        $form = $this->createForm(CommandeType::class,$commande);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_commande');
        }
        return $this->render('commande/modifierCommande.html.twig',['c'=>$form->createView()]);




    }



    /**
     * @param $id
     * @param CommandeRepository $commandeRepository
     * @return Response
     * @Route("/commandesClient/{id}", name="app_commandeClient")
     */

    public function commandeParClient( $id,CommandeRepository $commandeRepository): Response
    {
        $commandes=$commandeRepository->findCommandsByClient($id);

        return $this->render('commandeClient/listCommandeClient.html.twig', [
            'c'=>$commandes
        ]);
    }





//    /**
//     * @param $id
//     * @param CommandeRepository $commandeRepository
//     * @return Response
//     * @Route("/client/commandeClient/{id}", name="app_commandeClient")
//     */
//
//    public function commandeParClient2( $id,CommandeRepository $commandeRepository): Response
//    {
//        $commandes=$commandeRepository->findByFkClientpan($id);
//
//        return $this->render('commandeClient/listCommandeClient.html.twig', [
//            'c'=>$commandes
//        ]);
//    }

    // PART CLIENT





    /**
     * @Route("/clientCommande", name="commande_all")
     */
    public function indexCommmandeClient( ): Response
    {
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->find();
        return $this->render('commandeClient/listCommandeClient.html.twig', [
            'c'=>$commandes
        ]);

    }


    /**

     * @Route("/commande/{id}", name="clientcommandeclient")
     */
    public function findClientCommands($id): Response
    {
        $commandes = $this->getDoctrine()->getRepository(Commande::class)->findBy(
            ['fkClientpan' => $id],
            ['dateC' => 'ASC']
        );
        return $this->render('commandeClient/listCommandeClient.html.twig', [
            'c'=>$commandes
        ]);
    }

    /**
     * @param $id
     * @param CommandeRepository $commandeRepository
     * @Route("commande/pdf/{id}",name="pdf")
     */
    function pdf($id, CommandeRepository $commandeRepository){
        $commande =$commandeRepository->find($id);
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();

        $pdfOptions->set('isRemoteEnabled', true);

        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('commande/mypdf.html.twig',['commande'=>$commande
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }































//          ghalta el mèthode ya benti
//    /**
//     * @Route("/ajouterCommande/{id}", name="ajouterCommande")
//     */
//    public function passerComande($id, Request $request): Response
//    {
//        $commande = new Commande();
//        $commande->setDateC(new \DateTime('now'));
//
//        $commande->setFkClientpan($this->getDoctrine()->getRepository(Utilisateur::class)->find($id));
//        $commande->setnbProduit(45);
//        $commande->setmodePaiement('en espèces');
//        $commande->settotal(50);
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($commande);//Add
//            $em->flush();
//            return $this->redirectToRoute('app_commande');
//
//
//
//
//    }



















}