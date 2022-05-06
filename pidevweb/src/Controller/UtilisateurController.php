<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Carbon\Carbon;
use Container8I4uLfq\EntityManager_9a5be93;
use Doctrine\ORM\EntityManager;
use App\Repository\UtilisateurRepository;

use Monolog\Handler\Curl\Util;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Carbon\CarbonImmutable;


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
     */
    public function indexWelcome(): Response
    {

        return $this->render('accueil/welcome.html.twig');
    }

    /**
     * Return a similar articles by category
      * @Route("/welcome", name="display_welcome")
     * @ParamConverter("user")

     */
    public function  trouverAnniversaire ( UtilisateurRepository $repository,Utilisateur $user, Request $request, EntityManager $em)
    {
        $time = date('d/m/Y');

        $birthdaytoday = [];
        $clients = $repository->findAll();
        foreach ($clients as $user)
        if ($user->getDateDeNaissance('w', timestamp) == $time ('w', timestamp) && $user->getDateDeNaissance('n', timestamp) == $time ('n', timestamp)) {
            {
                $birthdaytoday[] = $user->getEmail();
            }


        return $this->render('accueil/welcome.html.twig', [
        'p'=>$birthdaytoday
    ]);

    }}}
