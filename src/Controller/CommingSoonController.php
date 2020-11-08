<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommingSoonController extends AbstractController
{
    /**
     * @Route("/", name="commingsoon")
     * @return Response
     */
    public function index(){
        return $this->render('commingsoon.html.twig');
    }
}