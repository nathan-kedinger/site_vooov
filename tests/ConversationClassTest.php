<?php

namespace App\Tests;

use App\Classes\ConversationsClass;
use App\Entity\Users;
use App\Repository\ConversationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

class ConversationClassTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreateConversations()
    {
        $sender = $this->createMock(UserInterface::class);
        $receiver = $this->createMock(Users::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $sender->method('getPseudo')->willReturn('User1');
        $receiver->method('getPseudo')->willReturn('User2');

        $conversationsClass = new ConversationsClass();
        $conversationsClass->createConversations($sender, $receiver, $entityManager);

        // Vérifiez que la méthode persist et flush ont été appelées une fois
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');
    }

    /**
     * @throws NonUniqueResultException
     * @throws Exception
     */
    public function testFindOneConversation()
    {
        $senderId = 1;
        $receiverId = 2;
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $repository = $this->createMock(ConversationsRepository::class);
        $entityManager->method('getRepository')->willReturn($repository);

        $conversationsClass = new ConversationsClass();
        $conversationsClass->findOneConversation($senderId, $receiverId, $entityManager);

        // Vérifiez que la méthode findOneConversation a été appelée une fois avec les paramètres appropriés
        $repository->expects($this->once())->method('findOneConversation')->with($senderId, $receiverId);
    }

    /**
     * @throws Exception
     */
    public function testFindCurrentUserConversations()
    {
        $currentUserId = 1;
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $repository = $this->createMock(ConversationsRepository::class);
        $entityManager->method('getRepository')->willReturn($repository);

        $conversationsClass = new ConversationsClass();
        $conversationsClass->findCurrentUserConversations($currentUserId, $entityManager);

        // Vérifiez que la méthode findConversations a été appelée une fois avec le paramètre approprié
        $repository->expects($this->once())->method('findConversations')->with($currentUserId);
    }

}