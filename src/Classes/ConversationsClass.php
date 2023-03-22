<?php

namespace App\Classes;

use App\Entity\Conversations;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Nonstandard\Uuid;

class ConversationsClass
{
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    /**
     * @param $sender
     * @param $receiver
     * @return void
     */
    public function createConversations($sender, $receiver){

        $conversation = new Conversations();

        $uuid = Uuid::uuid4();
        $uuid_string = $uuid->toString();
        $actualDate = new \DateTime('now');
        $actualDate_string = $actualDate->format('d/m/y');

        $conversation->setUuid($uuid_string);
        $conversation->setSender($sender);
        $conversation->setReceiver($receiver);
        $conversation->setTitle("{$sender->getPseudo()}" . " et " ."{$receiver->getPseudo()}");
        $conversation->setCreatedAt($actualDate_string);
        $conversation->setUpdatedAt($actualDate_string);

        $this->em->persist($conversation);
        $this->em->flush();
    }

    public function findOneConversation($senderId, $receiverId){
        return $this->em->getRepository(Conversations::class)->findOneConversation($senderId, $receiverId);
    }

    public function findCurrentUserConversations($currentUserId){
        return $this->em->getRepository(Conversations::class)->findConversations($currentUserId);
    }
}