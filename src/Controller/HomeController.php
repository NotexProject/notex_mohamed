<?php

namespace App\Controller;

use App\Entity\Compt;
use App\Entity\Offre;
use App\Entity\Reclamation;
use App\Form\OffreType;
use App\Form\ReclamationType;
use App\Repository\OffreRepository;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; // Nous avons besoin d'accéder à la requête pour obtenir le numéro de page
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator
use Dompdf\Dompdf;

use Dompdf\Options;


class HomeController extends AbstractController
{

    /**
     * @Route("/ahmed", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/{idoffre}/showo", name="offredetail", methods={"GET"})
     */
    public function showo(Offre $offre): Response
    {
        return $this->render('home/offredetail.html.twig', [
            'offre' => $offre,
        ]);
    }

    public function getcurrentuser()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getuser() ;
        return $user->getIdcompt() ;
    }
    /**
     * @Route("/usermenu", name="app_user")
     * @param OffreRepository $offreRepository
     * @return Response
     */
    public function usermenu(OffreRepository $offreRepository)
    {
        return $this->render('home/user.html.twig', [
            "offres" => $offreRepository->findBy(["cincreateuroffre"=>$this->getcurrentuser()])
        ]);
    }


    /**
     * @Route("/offress", name="toutesles_offress", methods={"GET"})
     */
    public function ind(Request $request, PaginatorInterface $paginator): Response
    {

        $donnees = $this->getDoctrine()->getRepository(Offre::class)->findBy([],['datedebut' => 'desc']);
        $offres = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        return $this->render('home/touteslesoffre.html.twig', [
            'offres' =>  $offres

            ]);

    }

    /**
     * @Route("/mesoffres", name="offres_moi")
     * @param OffreRepository $offreRepository
     * @return Response
     */
    public function moffres(OffreRepository $offreRepository)
    {

        return $this->render('home/mesoffre.html.twig', [
            "offres" => $offreRepository->findBy(["cincreateuroffre"=>$this->getcurrentuser()])
        ]);
    }

    /**
     * @Route("/newoffre", name="offre_new", methods={"GET", "POST"})
     */
    public function addo(Request $request, OffreRepository $offreRepository): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //get img from FORM
            $image = $form->get('imgsrc')->getData();
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fichier = $originalFilename.md5(uniqid()).'.'.$image->guessExtension();
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

            // On copie le fichier dans le dossier uploads
            $image->move(
                $destination ,
                $fichier
            );
            $offre->setImgsrc($fichier);

            $offreRepository->add($offre);
            return $this->redirectToRoute('offres_moi', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/newoffre.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }





    /**
     * @Route("/{idoffre}", name="offre_delete", methods={"POST"})
     */
    public function dele(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getIdoffre(), $request->request->get('_token'))) {
            $offreRepository->remove($offre);
        }

        return $this->redirectToRoute('offres_moi', [], Response::HTTP_SEE_OTHER);
    }






    /**
     * @Route("/{idoffre}/edit", name="offre_edit", methods={"GET", "POST"})
     */
    public function edito(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //get img from FORM
            $image = $form->get('imgsrc')->getData();
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fichier = $originalFilename.md5(uniqid()).'.'.$image->guessExtension();
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

            // On copie le fichier dans le dossier uploads
            $image->move(
                $destination ,
                $fichier
            );
            $offre->setImgsrc($fichier);
            $offreRepository->add($offre);
            return $this->redirectToRoute('offres_moi', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/editoffre.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/imp", name="impr")
     */
    public function imprimer(OffreRepository $offreRepository ,EntityManagerInterface $entityManager): Response

    {

        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $options->set('isRemoteEnabled', true);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();

        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $evenements = $entityManager
            ->getRepository(Offre::class)
            ->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('home/pdf.html.twig', [
            'offres' => $evenements,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste Offres.pdf", [
            "Attachment" => true

        ]);
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }



    /**
     * @Route("/mesreclamation", name="reclamations_moi")
     * @param ReclamationRepository $ReclamationRepository
     * @return Response
     */
    public function mrec(ReclamationRepository $ReclamationRepository)
    {

        return $this->render('home/mesreclamation.html.twig', [
            "reclamations" => $ReclamationRepository->findBy(["cinreclameur"=>$this->getcurrentuser()])
        ]);
    }





    /**
     * @Route("/offrerecla/recl/{id}", name="reclamation_new", methods={"GET", "POST"})
     */
    public function nerjj(Request $request, ReclamationRepository $reclamationRepository, OffreRepository $offreRepository, $id): Response
    {

        $offre = $offreRepository->findOneBy(['idoffre' => $id]);

        $reclamation = new Reclamation();
        $reclamation->setOffreareclamer($offre);
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $reclamationRepository->add($reclamation);
            return $this->redirectToRoute('reclamations_moi', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/reclamer_off.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),

        ]);
    }



    /**
     * @Route("/edit/{idreclamation}", name="reclamation_edit", methods={"GET", "POST"})
     */
    public function editr(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository,$idreclamation): Response
    {
        $reclamation = $reclamationRepository->findOneBy(['idreclamation' => $idreclamation]);

        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->add($reclamation);
            return $this->redirectToRoute('reclamations_moi', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/editerreclamation.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/showrecla/{idreclamation}", name="reclamation_show", methods={"GET"})
     */
    public function showr(Reclamation $reclamation): Response
    {
        return $this->render('home/reclamationdetail.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }







    /**
     * @Route("/deletereclamation/{idreclamation}", name="reclamation_delete", methods={"POST"})
     */
    public function deleterecla(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdreclamation(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation);
        }

        return $this->redirectToRoute('reclamations_moi', [], Response::HTTP_SEE_OTHER);
    }
}
