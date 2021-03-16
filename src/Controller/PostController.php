<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
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

    #[Route('/post/add', name: 'addPost')]
    public function add(UserRepository $userRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $post = new Post();
        $post->setCreatedAt(new \DateTime());
        $post->setIsDeleted(false);
        //TODO : set id de l'user connecté
        $post->setAuthor($userRepository->findAll()[0]);


        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();

            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('post/addPost.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/post/{post}', name: 'detail')]
    public function post(UserRepository $userRepository, EntityManagerInterface $entityManager, Post $post, Request $request): Response
    {
        $comment = new Comment();
        $comment->setCreatedAt(new \DateTime());
        $comment->setIsDeleted(false);
        //TODO : set id de l'user connecté
        $comment->setAuthor($userRepository->findAll()[0]);


        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();

            $post->addComment($comment);
            $entityManager->persist($comment);
            $entityManager->flush();
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
