<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function post(Post $post): Response
    {
        return $this->render('post/post.html.twig', [
            'post' =>$post,
        ]);
    }

    public function recentArticles(PostRepository $emPost, int $max = 5): Response
    {
        return $this->render('post/sidebar.html.twig', ['articles' => $emPost->findBy(["isDeleted"=>false],["createdAt"=>"desc"], $max)]);
    }

}
