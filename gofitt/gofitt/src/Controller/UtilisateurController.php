<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateur;
use App\Form\AjouterType;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Routing\Annotation\Route;


class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="app_utilisateur")
     */
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
    /**
     * @Route("/utilisateur/shop", name="app_utilisateur/shop")
     */
    public function index1(): Response
    {
        return $this->render('base-back.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
    /**
     * @param Request $request
     * @return Response
     * @Route ("Utilisateur/Ajout",name="ajouter")
     */
        function Ajouter(Request $request)
        {
            $utilisateur= new utilisateur();
            $form = $this->createForm(AjouterType::class,$utilisateur);
            $form ->add('Ajouter',SubmitType::class);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $em=$this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
                return $this->render('utilisateur/connection.html.twig');
            }



            return $this->render('utilisateur/Ajouter.html.twig', ['fa' => $form->createView()]);

        }

    /**
     * @param UtilisateurRepository $repository
     * @Route ("AfficheU",name="Affiche")
     */
    public function Affiche( UtilisateurRepository $repository)
    {
        $utilisateur = $repository->findAll();
        return $this->render('utilisateur/Afficher.html.twig', [
            'utilisateur' => $utilisateur
        ]);
    }
    /**
* @Route ("/Supprimer/{id_utilisateur}",name="supp")
*/
    public function Supprimer($id_utilisateur) {
        $utilisateur=$this->getDoctrine()->getRepository(Utilisateur::class)->find($id_utilisateur);
        $em=$this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();
        return $this->redirectToRoute('Affiche');

    }

    /**
     * @Route ("/Modifier/{id_utilisateur}",name="mod")
     */
    public function Modifier ( Request $request  ,UtilisateurRepository $repository , $id_utilisateur )  {
        $utilisateur=$repository->find($id_utilisateur);

        $form = $this->createForm(AjouterType::class,$utilisateur);
        $form ->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('Affiche');
        }

        return $this->render('utilisateur/modifier.html.twig', ['f' => $form->createView()]);
    }


    public function login()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('afficher');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
