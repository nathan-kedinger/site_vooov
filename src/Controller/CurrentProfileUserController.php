<?php

namespace App\Controller;

use App\Classes\ConversationsClass;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentProfileUserController extends AbstractController
{
    #[Route('/mon-profil', name: 'app_current_profile_user')]
    public function index(ConversationsClass $conversations, Security $security, EntityManagerInterface $em): Response
    {
        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);
        }

        return $this->render('current_profile_user/index.html.twig', [
            'conversations' => $currentUserConversations,
        ]);
    }
}
