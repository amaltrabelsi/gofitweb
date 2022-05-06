<?php

namespace App\Controller;
use App\Entity\Actualite;
use App\Form\ActualiteType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActualiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Dompdf\Options;



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
     * @Route("/oneBlog/{id}", name="one_Blog")
     */
    public function detail_actualite($id): Response
    {
        $actualite= $this->getDoctrine()->getRepository(Actualite::class)->find($id);


        return $this->render('actualite/oneBlog.html.twig', [

            'detail'=> $actualite,


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
     * @param ActualiteRepository $repository
     * @return Response
     * @Route("/blogsFront",name="blogsFront")
     */
    public function Affiche(ActualiteRepository $repository,Request $request, PaginatorInterface $paginator){
        $donnees = $this->getDoctrine()->getRepository(Actualite::class)->findAll();



        $actualites = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
        // Nombre de résultats par page
        );
        return $this->render('actualite/blogsFront.html.twig',
            ['Actualite'=>$actualites]);
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
            $file =$form->get('pathImage')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directory'), $fileName);
            $actualite->setPathImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);//Add
            $em->flush();
            $this->addFlash('success' , 'Article Crée Avec Succès!');

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
/////////////////////////////////////////////
///    /**
//     * @param Request $request
//     * @param  ActualiteRepository $ActualiteRepository
//     * @param CommentRepository $CommentRepository
//     * @Route("blog/AfficheBItem/{id}", name="articleItem")
//     */
//    function AfficheAr($id, BlogArticleRepository $BARepository, BlogCommentRepository $Commentrepository, Request $request){
//        $BA =$BARepository->find($id);
//        $commentb =$Commentrepository->findAllBYBA($BA->getId());
//        $comment = new BlogComment();
//        $ajoutComment = $this->createForm(CommentbType::class,$comment);
//        $ajoutComment->handleRequest($request);
//        if(($ajoutComment->isSubmitted()) && $ajoutComment->isValid()) {
//            $comment->setUser($this->getUser());
//            $comment->setarticle($BA);
//            $comment->setPostDate(new \DateTime('now'));
//            $comment->setLikes(0);
//            $comment->setDislikes(0);
//            $badwords = array('bad1', 'sisi', 'mtar', 'khalil');
//            $text =$comment->getComment();
//            function filterBadwords($text, array $badwords, $replaceChar = '*') {
//                return preg_replace_callback(
//                    array_map(function($w) { return '/\b' . preg_quote($w, '/') . '\b/i'; }, $badwords),
//                    function($match) use ($replaceChar) { return str_repeat($replaceChar, strlen($match[0])); },
//                    $text
//                );
//            }
//            $comment->setComment(filterBadwords($text, $badwords));
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($comment);
//            $em->flush();
//            return $this->redirectToRoute('articleItem',['id'=>$BA->getId()]);
//        }
//
//        return $this->render('blog_article/AfficheAr.html.twig',['articleItem'=>$BA,'BlogComment'=>$commentb,
//            'CommentbForm'=>$ajoutComment->createView()]);
//    }
/// ///////////////////////////////////
    /**
     * @param $id
     * @Route("/actualite/pdf/{id}",name="pdf")
     */
    function pdf($id){

        $Actualite = $this->getDoctrine()->getRepository(Actualite::class)->find($id);        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->setIsHtml5ParserEnabled(true);

        $pdfOptions->set('isRemoteEnabled', TRUE);

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $path = 'assets/images/logo.png';

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('actualite/mypdf.html.twig',['actualite'=>$Actualite
         ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html)  ;

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", array(
            "Attachment" => 0
        ));
    }


    /**
     * @Route("/search", name="ajax_search")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('q');

        $actualites =  $em->getRepository(Actualite::class)->findActualitesByString($requestString);

        if(!$actualites) {
            $result['actualites']['error'] = "empty articles";
        } else {
            $result['actualites'] = $this->getRealActualites($actualites);
        }

        return new Response(json_encode($result));
    }

    public function getRealActualites($actualites){

        foreach ($actualites as $actualite){
            $realEntities[$actualite->getActualiteId()]  = [$actualite->getTitre()];
        }
        return $realEntities;


    }


}

