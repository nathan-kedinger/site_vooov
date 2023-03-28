<?php

namespace App\Controller;

use App\Classes\ConversationsClass;
use App\Classes\MessagesClass;
use App\Classes\UsersClass;
use App\Entity\Messages;
use App\Entity\Users;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @param $id
     * @param UsersClass $receiverUser
     * @param ConversationsClass $conversations
     * @param MessagesClass $messages
     * @param Request $request
     * @param Security $security
     * @return Response
     * @throws NonUniqueResultException
     */
    #[Route('/first-message/{id}', name: 'app_first_message')]
    public function firstMessage($id, UsersClass $receiverUser, ConversationsClass $conversations, MessagesClass $messages, Request $request, Security $security, EntityManagerInterface $em): Response
    {

        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);

            $messageEntity = new Messages();
            $sendingMessage = $this->createForm(MessageType::class, $messageEntity);
            $sendingMessage->handleRequest($request);

            $receiver = $receiverUser->findOneUserById($id);

            if ($sendingMessage->isSubmitted() && $sendingMessage->isValid() && $security->isGranted('IS_AUTHENTICATED_FULLY')) {
                $targetedConversation = $conversations->findOneConversation($currentUser->getId(), $receiver->getId(),  $em);
                $body = $sendingMessage->get('body')->getData();

                if($targetedConversation == null) {
                    $conversations->createConversations($currentUser, $receiver, $em);
                }
                $targetedConversation = $conversations->findOneConversation($currentUser->getid(), $receiver->getId(), $em);
                $messages->createMessage($currentUser, $receiver, $targetedConversation->getUuid(), $body);
            } else {
                // Renvoyer un message proposant de se connecter
            }
        }

        return $this->render('first_message/index.html.twig', [
            'sendingMessage' => $sendingMessage->createView(),
            'conversations' => $currentUserConversations,

        ]);
    }

    #[Route('/conversation/{id}', name: 'app_conversation')]
    public function conversation($id, UsersClass $receiverUser, ConversationsClass $conversations, MessagesClass $messages, Request $request, Security $security, EntityManagerInterface $em): Response
    {

        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);

            $messageEntity = new Messages();
            $sendingMessage = $this->createForm(MessageType::class, $messageEntity);
            $sendingMessage->handleRequest($request);

            $conversationMessageList = $messages->

            $receiver = $receiverUser->findOneUserById($id);

            if ($sendingMessage->isSubmitted() && $sendingMessage->isValid() && $security->isGranted('IS_AUTHENTICATED_FULLY')) {
                $targetedConversation = $conversations->findOneConversation($currentUser->getId(), $receiver->getId(),  $em);
                $body = $sendingMessage->get('body')->getData();

                if($targetedConversation == null) {
                    $conversations->createConversations($currentUser, $receiver, $em);
                }
                $targetedConversation = $conversations->findOneConversation($currentUser->getid(), $receiver->getId(), $em);
                $messages->createMessage($currentUser, $receiver, $targetedConversation->getUuid(), $body);
            } else {
                // Renvoyer un message proposant de se connecter
            }
        }

        return $this->render('first_message/index.html.twig', [
            'sendingMessage' => $sendingMessage->createView(),
            'conversations' => $currentUserConversations,

        ]);
    }
}
