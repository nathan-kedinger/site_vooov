<?php

namespace App\Classes;

use App\Entity\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Nonstandard\Uuid;

class MessagesClass
{
    /**
     * Creating a new message in database
     * @param $user
     * @param $receiver
     * @param $conversationUuidString
     * @param $body
     * @return void
     */
    public function createMessage($user, $receiver, $conversationUuidString, $body, EntityManagerInterface $em): void{
        $message = new Messages();

        $uuid = Uuid::uuid4();
        $uuid_string = $uuid->toString();
        $actualDate = new \DateTime('now');
        $actualDate_string = $actualDate->format('d/m/y');

        $message->setUuid($uuid_string);
        $message->setConversationUuid($conversationUuidString);
        $message->setSender($user);
        $message->setReceiver($receiver);
        $message->setSeen(false);
        $message->setSendAt($actualDate_string);
        $message->setBody($body); // Ajout de cette ligne

        $em->persist($message);
        $em->flush();
    }

    public function findAllMessagesFromOneConversation(string $conversationUuid, EntityManagerInterface $em)
    {
        return $em->getRepository(Messages::class)->findAllMessagesFromOneConversation($conversationUuid);
    }
}