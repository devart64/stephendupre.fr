<?php


namespace App\Controller;


use App\Application\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/article-{id}", name="blog_read")
     * @param Post $post
     * @return Response
     */
    public function read(Post $post): Response
    {
        return $this->render('read.html.twig', [
            'post' => $post
        ]);
    }
}