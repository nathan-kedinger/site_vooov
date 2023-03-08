<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(): Response 
    {
        return $this->render('home_page/home_page.html.twig',[
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomePageController.php',
        ]);
    }
}
