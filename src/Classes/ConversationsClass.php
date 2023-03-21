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
    public function createConversations($sender, $receiver){

        $conversation = new Conversations();

        $uuid = Uuid::uuid4();
        $uuid_string = $uuid->toString();
        $actualeDate = new \DateTime('now');
        $actualeDate_string = $actualeDate->format('d/m/y');

        $conversation->setUuid($uuid_string);
        $conversation->setSender($sender);
        $conversation->setReceiver($receiver);
        $conversation->setTitle("{$sender}" . " et " ."$receiver");
        $conversation->setCreatedAt($actualeDate_string);
        $conversation->setUpdatedAt($actualeDate_string);

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