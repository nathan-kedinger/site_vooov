<?php

namespace App\Controller;

use App\Classes\ConversationsClass;
use App\Classes\UsersClass;
use App\Entity\Messages;
use App\Form\MessageType;
use Ramsey\Uuid\Nonstandard\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstMessageController extends AbstractController
{
    #[Route('/first-message/{id}', name: 'app_first_message')]
    public function index($id, UsersClass $receiverUser, ConversationsClass $conversations, Request $request, Security $security): Response
    {

        $message = new Messages();
        $sendingMessage = $this->createForm(MessageType::class, $message);
        $sendingMessage->handleRequest($request);
        $uuid = Uuid::uuid4();
        $uuid_string = $uuid->toString();
        $actualeDate = new \DateTime('now');
        $actualeDate_string = $actualeDate->format('d/m/y');
        $receiver = $receiverUser->findOneUserById($id);

        if ($sendingMessage->isSubmitted() && $sendingMessage->isValid() && $security->isGranted('IS_AUTHENTICATED_FULLY')) {
                $user = $security->getUser();
                $targetedConversation = $conversations->findOneConversation($user, $receiver);
                if($targetedConversation == null) {
                    $conversations->createConversations($user, $receiver);

                    if ($targetedConversation->getUuid() == null) {
                        $conversationUuid = Uuid::uuid4();
                        $conversationUuidString = $conversationUuid->toString();

                        $message->setUuid($uuid_string);
                        $message->setConversationUuid($conversationUuidString);
                        $message->setSender($user);
                        $message->setReceiver($receiver);
                        $message->setSeen(false);
                        $message->setSendAt($actualeDate_string);
                    }

                } else {
                    $message->setUuid($uuid_string);
                    $message->setConversationUuid($targetedConversation->getUuid());
                    $message->setSender($user);
                    $message->setReceiver($receiver);
                    $message->setSeen(false);
                    $message->setSendAt($actualeDate_string);
                }

        } else {
                // Renvoyer un message proposant de se connecter
            }
        return $this->render('first_message/index.html.twig', [
            'sendingMessage' => $sendingMessage->createView()

        ]);
    }
}
