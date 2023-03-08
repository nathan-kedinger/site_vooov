<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentProfileUserController extends AbstractController
{
    #[Route('/current/profile/user', name: 'app_current_profile_user')]
    public function index(): Response
    {
        return $this->render('current_profile_user/index.html.twig', [
            'controller_name' => 'CurrentProfileUserController',
        ]);
    }
}
