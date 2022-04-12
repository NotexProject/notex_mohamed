<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Compt;
use App\Form\AbonnementType;
use App\Form\ComptType;
use App\Repository\AbonnementRepository;
use App\Repository\ComptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    //***********************************************abonnement back et front************************************************************
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        return $this->render('base.front.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }



    /**
     * @param AbonnementRepository $repo
     * @return Response
     * @Route  ("back/afficheA" , name ="afficheA")
     */
    public function Affiche(AbonnementRepository $repo   ) {
        //$repo=$this ->getDoctrine()->getRepository(Abonnement::class) ;
        $abonnement=$repo->findAll() ;
        return $this->render('back/afficherabonnement.html.twig' , [
            'abonnement' => $abonnement ,
            'ajoutA' => $abonnement
        ]) ;
    }


    /**
     * @return void
     * @route ("back/delete/{ida}" ,name ="delete" )
     */
    function Delete($ida,AbonnementRepository $repository) {
        $abonnement=$repository->find($ida) ;
        $em=$this->getDoctrine()->getManager() ;
        $em->remove($abonnement);
        $em->flush();
        return $this->redirectToRoute("afficheA") ;

    }

    /**
     * @return void
     * @route ("back/update{ida}" , name="update")
     */
    function update(AbonnementRepository $repo,$ida,Request $request){
        $abonnement = $repo->find($ida) ;
        $form=$this->createForm(AbonnementType::class,$abonnement) ;
        $form->add('update' , SubmitType::class) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted()&& $form->isValid()){
            $file =$abonnement->getImage();
            $uploads_directory = $this->getParameter('upload_directory');
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $uploads_directory,
                $fileName
            );
            $abonnement->setImage(($fileName));

            $abonnement = $form->getData();
            $em=$this->getDoctrine()->getManager()  ;
            $em->flush();
            return $this ->redirectToRoute('afficheA') ;
        }
        return $this->render('back/update.html.twig' , [
            'form' => $form->createView()
        ]) ;

    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("back/ajoutA" , name="ajoutA")
     */
    function Add(Request  $request ) {
        $Abonnement =  new Abonnement() ;
        $form =  $this->createForm(AbonnementType::class,$Abonnement) ;
        $form->add('Ajouter' , SubmitType::class) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted()&& $form->isValid()){
            $file =$Abonnement->getImage();
            $uploads_directory = $this->getParameter('upload_directory');
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $uploads_directory,
                $fileName
            );
            $Abonnement->setImage(($fileName));

            $Abonnement = $form->getData();
            $em=$this->getDoctrine()->getManager() ;
            $em->persist($Abonnement);
            $em->flush();
            return $this ->redirectToRoute('afficheA') ;
        }
        return $this->render('back/ajouterabonnement.html.twig' , [
            'form' => $form->createView()
        ]) ;
    }
    /**
     * @param AbonnementRepository $repo
     * @return Response
     * @Route  ("/FrontafficheA" , name ="FrontafficheA")
     */
    public function frontaffiche (AbonnementRepository $repo   ) {
        //$repo=$this ->getDoctrine()->getRepository(Abonnement::class) ;
        $abo=$repo->findAll() ;
        return $this->render('front/index.html.twig' , [
            'abonnement' => $abo ,
            'ajoutA' => $abo
        ]) ;
    }
//*****************************************************************************************compt back et front ***********************************************************************

    /**
     * @param AbonnementRepository $repo
     * @return Response
     * @route ("back/afficheC" , name ="afficheC")
     */
    public function AffichCompte (ComptRepository $repo   ) {
        //$repo=$this ->getDoctrine()->getRepository(Abonnement::class) ;
        $abo=$repo->findAll() ;
        return $this->render('back/afficherCompt.html.twig' , [
            'compt' => $abo ,
            'ajoutC' => $abo
        ]) ;
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("back/ajoutC" , name="ajoutC")
     */
    function addcompt (Request  $request ) {
        $compt =  new Compt() ;
        $formC =  $this->createForm(ComptType::class,$compt) ;
        $formC->add('Ajouter' , SubmitType::class) ;
        $formC->handleRequest($request) ;
        if($formC->isSubmitted()&& $formC->isValid()){

            $em=$this->getDoctrine()->getManager() ;
            $em->persist($compt);
            $em->flush();
            return $this ->redirectToRoute('afficheC') ;
        }
        return $this->render('back/ajoutercompt.html.twig' , [
            'formC' => $formC->createView()
        ]) ;
    }
    /**
     * @return void
     * @route ("back/updatC{idcompt}" , name="upc")
     */
    function updatec(ComptRepository $repo,$idcompt,Request $request){
        $compt = $repo->find($idcompt) ;
        $formC=$this->createForm(ComptType::class,$compt) ;
        $formC->add('update' , SubmitType::class) ;
        $formC->handleRequest($request) ;
        if($formC->isSubmitted()&& $formC->isValid()){

            $em=$this->getDoctrine()->getManager()  ;
            $em->flush();
            return $this ->redirectToRoute('afficheC') ;
        }
        return $this->render('back/updatecompt.html.twig' , [
            'formC' => $formC->createView()
        ]) ;

    }

    /**
     * @return void
     * @route ("back/deleteC/{idcompt}" ,name ="deleteC" )
     */
    function Deletec($idcompt,ComptRepository $repository) {
        $compt=$repository->find($idcompt) ;
        $em=$this->getDoctrine()->getManager() ;
        $em->remove($compt);
        $em->flush();
        return $this->redirectToRoute("afficheC") ;

    }
}
