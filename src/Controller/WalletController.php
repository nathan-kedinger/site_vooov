<?php

namespace App\Controller;

use App\Classes\ConversationsClass;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends AbstractController
{
    #[Route('/porte-moon', name: 'app_wallet')]
    public function index(ConversationsClass $conversations, Security $security, EntityManagerInterface $em): Response
    {
        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);
        }

        return $this->render('wallet/index.html.twig', [
            'controller_name' => 'WalletController',
            'conversations' => $currentUserConversations,

        ]);
    }
}
