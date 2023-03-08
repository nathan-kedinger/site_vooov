<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OtherUserProfileController extends AbstractController
{
    #[Route('/other/user/profile', name: 'app_other_user_profile')]
    public function index(): Response
    {
        return $this->render('other_user_profile/index.html.twig', [
            'controller_name' => 'OtherUserProfileController',
        ]);
    }
}
