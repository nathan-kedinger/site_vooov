<?php

namespace App\Controller;

use App\Classes\ConversationsClass;
use App\Classes\MessagesClass;
use App\Classes\UsersClass;
use App\Entity\Messages;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstMessageController extends AbstractController
{
    /**
     * @param $id
     * @param UsersClass $receiverUser
     * @param ConversationsClass $conversations
     * @param MessagesClass $messages
     * @param Request $request
     * @param Security $security
     * @return Response
     */
    #[Route('/first-message/{id}', name: 'app_first_message')]
    public function index($id, UsersClass $receiverUser, ConversationsClass $conversations, MessagesClass $messages, Request $request, Security $security): Response
    {

        $messageEntity = new Messages();
        $sendingMessage = $this->createForm(MessageType::class, $messageEntity);
        $sendingMessage->handleRequest($request);

        $receiver = $receiverUser->findOneUserById($id);

        if ($sendingMessage->isSubmitted() && $sendingMessage->isValid() && $security->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $security->getUser();
            $targetedConversation = $conversations->findOneConversation($user, $receiver);
            $body = $sendingMessage->get('body')->getData(); // Ajout de cette ligne

            if($targetedConversation == null) {
                $conversations->createConversations($user, $receiver);
            }
            $targetedConversation = $conversations->findOneConversation($user, $receiver);
            $messages->createMessage($user, $receiver, $targetedConversation->getUuid(), $body);
        } else {
            // Renvoyer un message proposant de se connecter
        }
        return $this->render('first_message/index.html.twig', [
            'sendingMessage' => $sendingMessage->createView()

        ]);
    }
}
