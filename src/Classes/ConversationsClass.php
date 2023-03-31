<?php

namespace App\Classes;

use App\Entity\Conversations;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Ramsey\Uuid\Nonstandard\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

class ConversationsClass
{
    /**
     * @param Users $sender
     * @param Users|null $receiver
     * @param EntityManagerInterface $em
     * @return void
     */
    public function createConversations(UserInterface $sender, ?Users $receiver, EntityManagerInterface $em): void
    {

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

        $em->persist($conversation);
        $em->flush();
    }

    /**
     * @param int $senderId
     * @param int $receiverId
     * @param EntityManagerInterface $em
     * @return Conversations|null
     * @throws NonUniqueResultException
     */
    public function findOneConversation(int $senderId, int $receiverId, EntityManagerInterface $em): Conversations|null
    {
        return $em->getRepository(Conversations::class)->findOneConversation($senderId, $receiverId);
    }

    /**
     * @param int $currentUserId
     * @param EntityManagerInterface $em
     * @return array
     */
    public function findCurrentUserConversations(int $currentUserId, EntityManagerInterface $em): array
    {
        return $em->getRepository(Conversations::class)->findConversations($currentUserId);
    }

    public function findOneConversationByUuid(string $uuid, EntityManagerInterface $em): Conversations
    {
        return $em->getRepository(Conversations::class)->findOneConversationByUuid($uuid);
    }
}