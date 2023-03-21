<?php

namespace App\Controller;

use App\Classes\UsersClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OtherUserProfileController extends AbstractController
{
    #[Route('/utilisateur/{pseudo}', name: 'app_other_user')]
    public function index($pseudo,UsersClass $user): Response
    {
        $user = $user->findOneUserByPseudo($pseudo);
        if(!$user){
            throw $this->createNotFoundException('Utilisateur introuvable');
        }

        return $this->render('other_user_profile/index.html.twig', [
            'user' => $user,
        ]);
    }
}
