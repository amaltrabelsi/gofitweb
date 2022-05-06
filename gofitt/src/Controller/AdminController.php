<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\UtilisateurRepository;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AdminController extends AbstractController
{



    /**
     * @IsGranted("ROLE_ADMIN")
     * @param UtilisateurRepository $repository
     * @Route ("/AfficheU",name="Affiche")
     */
    public function Affiche(UtilisateurRepository $repository ,PaginatorInterface $paginator ,Request $request
    )
    {

        $utilisateur = $repository->findAll();

        return $this->render('admin/Afficher.html.twig', [
            'utilisateur' => $utilisateur
        ]);
    }
    /**
     * @Route ("admin/Supprimer/{id_utilisateur}",name="supp")
     */
    public function Supprimer($id_utilisateur) {
        $utilisateur=$this->getDoctrine()->getRepository(Utilisateur::class)->find($id_utilisateur);
        $em=$this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();
        return $this->redirectToRoute('Affiche');

    }

    //////// search  with ajax
    /**
     * @Route("/ajaxSearch", name="search")
     */

    public function searchAction (Request $request,UtilisateurRepository $URepository): Response
    {

        $requestString =$request->get('q');
        $Utilisateur = $URepository->findEntitiesByString($requestString);
        if(!$Utilisateur)
        {
            $result['posts']['error']="PAS D'UTILISATEUR  ";
        }
        else {
            $result['posts']=$this->getRealEntities($Utilisateur);

        }
        return new Response(json_encode($result));

    }

    public function getRealEntities($Utilisateurs)
    {
        foreach ($Utilisateurs as $Utilisateur){
            $realEntities[$Utilisateur->getUtilisateur_Id()]=[$Utilisateur->getUtilisateur_Id()];
        }
        return $realEntities;

    }
    /**
     * @Route("/frontDetailsProduit/{id}", name="detail_produit_front")
     */
    public function detail_produit_front($id): Response
    {
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);
        if($user!= null ){
            $Role=$user->getRoles();
        }



        $rolesuser=$this->getDoctrine()->getRepository(Utilisateur::class)->findBy(['categorie'=>$Role],['categorie' => 'desc']);




        return $this->render('admin/detailsutilisateur.html.twig', [

            'detail' => $user,'produits'=>$rolesuser,


        ]);
    }



}
