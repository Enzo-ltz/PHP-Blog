<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PostController extends AbstractController
{

    public function __construct(private EntityManagerInterface $entityManager) {}


    #[Route('/home', name: 'home')]
    public function index(): Response
    {

        $emPost = $this->entityManager->getRepository(Post::class);

        return $this->render('post/index.html.twig', [
            'posts' => $emPost->findAll(),
        ]);
    }

    #[Route('/post/{post}', name: 'detail')]
    public function post(Post $post): Response
    {

        $emPost = $this->entityManager->getRepository(Post::class);

        return $this->render('post/post.html.twig', [
            'post' => $emPost->find($post),
        ]);
    }
}
