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
     * @return ConversationsClass[] Returns an array of Conversations objects
     */
    public function findConversations($userId): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.sender = :val')
            ->andWhere('c.receiver = :val')
            ->setParameter('val', $userId)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(15)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneConversation($senderId, $receiverId): ?Conversations
    {
        $sender = $this->em->getRepository(Users::class)->find($senderId);
        $receiver = $this->em->getRepository(Users::class)->find($receiverId);

        return $this->createQueryBuilder('c')
            ->andWhere('c.sender = :sender')
            ->orWhere('c.sender = :receiver')
            ->andWhere('c.receiver = :receiver')
            ->orWhere('c.receiver = :sender')
            ->setParameters([
                'sender' => $sender,
                'receiver' => $receiver,
                ])
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
