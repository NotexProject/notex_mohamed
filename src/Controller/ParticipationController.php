<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use phpDocumentor\Reflection\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipationController extends AbstractController
{
    /**
     * @Route("/participation", name="participation")
     */
    public function index(): Response
    {
        return $this->render('participation/message.html.twig', [
            'controller_name' => 'ParticipationController',
        ]);
    }
    /**
     * @Route("/message", name="message")
     */
    public function message(): Response
    {
        return $this->render('participation/message.html.twig', [
            'controller_name' => 'ParticipationController',
        ]);
    }



    /**
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response;
     * @route("/AjouterP" , name="AjouterP" )
     */

function Add(Request $request,ParticipationRepository $repo ) {
        $part=$repo->findAll() ;

        $Participation=new Participation();
        $form=$this->createForm(ParticipationType::class,$Participation);
        $form->add('Participer',submitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Participation);
            $em->flush();
            return $this->redirectToRoute('message');
        }
        return $this->render('participation/AjouterPart.html.twig',
            [
            'form'=>$form->createView() ,
                'participation'=>$part
        ]);

    $comment = new Comments;
    $commentForm = $this->createForm(CommentsType::class, $comment);
    $commentForm->handleRequest($request);
    if($commentForm->isSubmitted() && $commentForm->isValid()){
        $comment->setCreatedAt(new DateTime());
        $comment->setParticipation($participation);
        $parentid = $commentForm->get("parentid")->getData();
        $em = $this->getDoctrine()->getManager();
        if($parentid != null){
            $parent = $em->getRepository(Comments::class)->find($parentid);
        }
        $comment->setParent($parent ?? null);
        $em->persist($comment);
        $em->flush();

        $this->addFlash('message', 'Votre commentaire a bien été envoyé');
    }



    return $this->render('participation/AjouterP.html.twig', [
        'participation' => $participation,
        'form' => $form->createView(),
        'commentForm' => $commentForm->createView()
    ]);
}




    /**
     * @param ParticipationRepository $repository
     * @param $idPart
     * @return void
     * @route("Participation/Update/{idPart}",name="update")
     */
    function Update(ParticipationRepository $repository,$idPart,Request $request){
    $Participation=$repository->find ($idPart);
    $form=$this->createForm(ParticipationType::class,$Participation);
    $form->add('Update',submitType::class);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->flush();
        return $this -> redirectToRoute('AjouterP') ;
    }
    return $this->render('participation/updatepart.html.twig' , [
        'form'=>$form->createView()
        ]);
    }


    /**
     * @param Participation $participation
     * @return Response
     * @route("/delete/{idPart}",name="delete")
     */
    function delete($idPart,ParticipationRepository $repository){
    $Participation=$repository->find($idPart);
    $em=$this->getDoctrine()->getManager();
    $em->remove($Participation);
    $em->flush();
        return $this->redirectToRoute("AjouterP") ;
    }

    /**
     * @param ParticipationRepository $repository
     * @return Response
     * @route("/afficheP",name="afficheP")
     */
    public function affiche(ParticipationRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(Participation::class);
        $Participation=$repository->findAll();
        return $this->render('participation/AffichePart.html.twig',
            ['Participation'=>$Participation]);
    }


}
