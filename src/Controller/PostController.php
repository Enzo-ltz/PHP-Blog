<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PostController extends AbstractController
{

    public function __construct() {}


    #[Route('/', name: 'home')]
    public function index(PostRepository $emPost): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $emPost->findAll()
        ]);
    }

    #[Route('/post/{post}', name: 'detail')]
    public function post(UserRepository $emUser, EntityManagerInterface $entity, Post $post, Request $request): Response
    {
        $comment = new Comment();
        $comment->setCreatedAt(new \DateTime());
        $comment->setIsDeleted(false);
        //TODO : set id de l'user connecté
        $comment->setAuthor($emUser->findAll()[0]);


        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();

            $post->addComment($comment);
            $entity->persist($comment);
            $entity->flush();
            return $this->redirectToRoute('detail',['post'=> $post->getId()]);
        }

        return $this->render('post/detailPost.html.twig', [
            'post' =>$post,
            'form' => $form->createView()
        ]);
    }

    public function recentArticles(PostRepository $emPost, int $max = 5): Response
    {
        return $this->render('post/sidebar.html.twig', ['articles' => $emPost->findBy(["isDeleted"=>false],["createdAt"=>"desc"], $max)]);
    }

}
