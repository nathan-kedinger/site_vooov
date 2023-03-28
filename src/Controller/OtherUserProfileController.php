<?php

namespace App\Controller;

use App\Classes\ConversationsClass;
use App\Classes\UsersClass;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OtherUserProfileController extends AbstractController
{
    #[Route('/utilisateur/{id}', name: 'app_other_user')]
    public function index($id,UsersClass $user, ConversationsClass $conversations, Security $security, EntityManagerInterface $em): Response
    {
        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);
        }

        $user = $user->findOneUserById($id);
        if(!$user){
            throw $this->createNotFoundException('Utilisateur introuvable');
        }

        return $this->render('other_user_profile/index.html.twig', [
            'user' => $user,
            'conversations' => $currentUserConversations,

        ]);
    }
}
