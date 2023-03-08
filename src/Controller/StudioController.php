<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudioController extends AbstractController
{
    #[Route('/studio', name: 'app_studio')]
    public function index(): Response
    {
        return $this->render('studio/index.html.twig', [
            'controller_name' => 'StudioController',
        ]);
    }
}
