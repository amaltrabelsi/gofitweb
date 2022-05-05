<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Business;
use App\Form\BusinessType;
use App\Repository\ActualiteRepository;
use App\Repository\BusinessRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BusinessController extends AbstractController
{
    /**
     * @Route("/business", name="app_business")
     */
    public function index(): Response
    {
        $businesses = $this->getDoctrine()->getManager()->getRepository(Business::class)->findAll();
        return $this->render('business/index.html.twig', [
            'p'=>$businesses
        ]);
    }
    /**
     * @Route("/createBusiness", name="createBusiness")
     */
    public function createBusiness(Request $request): Response
    {
        $business = new Business();

        $form = $this->createForm(BusinessType::class,$business);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $file =$form->get('pathImage')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directory'), $fileName);
            $business->setPathImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($business);//Add
            $em->flush();

            return $this->redirectToRoute('app_business');
        }
        return $this->render('business/createBusiness.html.twig',['f'=>$form->createView()]);

    }

    /**
     * @Route("/deleteBusiness/{id}", name="deleteBusiness")
     */
    public function deleteBusiness(Business  $business): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($business);
        $em->flush();

        return $this->redirectToRoute('app_business');


    }


    /**
     * @Route("/editBusiness/{id}", name="editBusiness")
     */
    public function editBusiness(Request $request,$id): Response
    {
        $business = $this->getDoctrine()->getManager()->getRepository(Business::class)->find($id);

        $form = $this->createForm(BusinessType::class,$business);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_business');
        }
        return $this->render('business/editBusiness.html.twig',['f'=>$form->createView()]);




    }
    /**
     * @param BusinessRepository $repository
     * @return Response
     * @Route("/businessFront",name="businessFront")
     */
    public function Affiche(BusinessRepository $repository,Request $request, PaginatorInterface $paginator){
        $donnees = $this->getDoctrine()->getRepository(Business::class)->findAll();
        $businesses = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3// Nombre de résultats par page
        );

        return $this->render('business/businessFront.html.twig',
            ['Business'=>$businesses]);
    }










}
