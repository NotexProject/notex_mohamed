<?php

namespace App\Controller;


use App\Entity\Evenements;
use App\Form\EvenementType;
use App\Repository\EvenementsRepository;;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EvenementsController extends AbstractController
{
    /**
     * @Route("/evenements", name="evenements")
     */
    public function index(): Response
    {
        return $this->render('evenements/AjouterEvent.html.twig', [
            'controller_name' => 'EvenementsController',
        ]);
    }

    /**
     * @param EvenementsRepository $repository
     * @return Symfony\Component\HttpFoundation\Response;
     * @route("/afficheE",name="afficheE")
     */
    public function affiche(EvenementsRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(Evenements::class);
        $Evenements=$repository->findAll();
        return $this->render('evenements/affiche.html.twig',
        ['evenements'=>$Evenements]);
    }


    /**
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     * @route("/AjouterE" , name="AjouterE" )
     */

    function Add(Request $request,EvenementsRepository $repo ) {
        $Event=$repo->findAll() ;

        $Evenements=new Evenements();
        $form1=$this->createForm(EvenementType::class,$Evenements);
        $form1->add('ajouter',submitType::class);
        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Evenements);
            $em->flush();
            return $this->redirectToRoute('afficheE') ;
        }
        return $this->render('Evenements/AjouterEvent.html.twig',
            [
                'form1'=>$form1->createView() ,
                'Evenements'=>$Event
            ]);


    }

    /**
     * @param EvenementsRepository $repository
     * @param $idEvent
     * @param Request $request
     * @return void
     * @route ("Evenements/UpdateEvent/{idEvent}",name="UpdateE" )
     */

    function UpdateE(EvenementsRepository $repository,$idEvent,Request $request){
        $Evenements=$repository->find ($idEvent);
        $form1=$this->createForm(EvenementType::class,$Evenements);
        $form1->add('UpdateE',submitType::class);
        $form1->handleRequest($request);
        if ($form1->isSubmitted() && $form1->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this -> redirectToRoute('UpdateE') ;
        }
        return $this->render('evenements/UpdateEvent.html.twig' , [
            'form'=>$form1->createView()
        ]);
    }

    /**
     * @param $idEvent

     * @route ("/deleteE/{idEvent}",name="deleteEvent")
     */

    function deleteE($idEvent,EvenementsRepository $repository){
        $Evenements=$repository->find($idEvent);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Evenements);
        $em->flush();
        return $this->redirectToRoute('afficheE') ;
    }


}
