<?php

namespace App\Repository;

use App\Entity\Conversations;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conversations>
 *
 * @method Conversations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conversations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conversations[]    findAll()
 * @method Conversations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConversationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Conversations::class);
        $this->em = $em;

    }

    public function save(Conversations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Conversations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Use it to find all conversations from one user
     * @param int $userId
     * @return array
     */
    public function findConversations(int $userId): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.sender = :val')
            ->orWhere('c.receiver = :val')
            ->setParameter('val', $userId)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(15)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Use it to access to one particular conversation
     * @param int $senderId
     * @param int $receiverId
     * @return Conversations|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneConversation(int $senderId, int $receiverId): ?Conversations
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.sender = :senderId AND c.receiver = :receiverId OR c.sender = :receiverId AND c.receiver = :senderId')
            ->setParameters([
                'senderId' => $senderId,
                'receiverId' => $receiverId,
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneConversationByUuid(string $uuid): ?Conversations
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.uuid = :uuid')
            ->setParameters([
                'uuid' => $uuid,
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
