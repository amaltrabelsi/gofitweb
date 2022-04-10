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
        return $this->render('base-front.html.twig', [
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
            }



            return $this->render('utilisateur/Ajouter.html.twig', ['fa' => $form->createView()]);

        }

    }
