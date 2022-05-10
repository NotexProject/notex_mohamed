<?php

namespace App\Controller;

use App\Repository\CommentsRepository;
use App\Entity\Comments;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Form\CommentsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentsController extends AbstractController
{
    /**
     * @Route("/comments", name="app_comments")
     */
    public function index(): Response
    {
        return $this->render('comments/index.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }


    /**
     *@Route("/homeC",name="comments_list")
     */
    public function home(Request $request)
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des articles est vide,
        //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
        $comments= [];

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'article tapé dans le formulaire
            $nickname = $propertySearch->getNickname();
            if ($nickname!="")
                //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
                $comments= $this->getDoctrine()->getRepository(comments::class)->findBy(['nickname' => $nickname] );
            else
                //si si aucun nom n'est fourni on affiche tous les articles
                $comments= $this->getDoctrine()->getRepository(Comments::class)->findAll();
        }
        return  $this->render('commentaire/searchC.html.twig',[ 'form' =>$form->createView(), 'comments' => $comments]);
    }

    /**
     * @param CommentsRepository $repository
     * @return Symfony\Component\HttpFoundation\Response;
     * @route("/afficheC",name="affichec")
     */
    public function affiche(CommentsRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(comments::class);
        $comments=$repository->findAll();
        return $this->render('commentaire/indexC.html.twig',
            ['comments'=>$comments]);
    }

    /**
     * @param CommentsRepository $repository
     * @param $id
     * @param Request $request
     * @return void
     * @route ("commentaire/UpdateComment/{id}",name="UpdateC" )
     */
    function UpdateC(CommentsRepository $repository,$id,Request $request){
        $Comments=$repository->find ($id);
        $form=$this->createForm(CommentsType::class,$Comments);
        $form->add('UpdateC',submitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this -> redirectToRoute('UpdateC') ;
        }
        return $this->render('commentaire/UpdateCommentaire.html.twig' , [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @param $id
     * @param CommentsRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *  * @route ("/deleteC/{id}",name="deleteComment")
     */
    function deleteC($id,CommentsRepository $repository){
        $Comments=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Comments);
        $em->flush();
        return $this->redirectToRoute('afficheC') ;
    }
}
