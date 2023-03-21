<?php

namespace App\Repository;

use App\Entity\AudioRecords;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AudioRecords>
 *
 * @method AudioRecords|null find($id, $lockMode = null, $lockVersion = null)
 * @method AudioRecords|null findOneBy(array $criteria, array $orderBy = null)
 * @method AudioRecords[]    findAll()
 * @method AudioRecords[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AudioRecordsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AudioRecords::class);
    }

    public function save(AudioRecords $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AudioRecords $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return AudioRecords[] Returns an array of AudioRecords objects
     */
    public function findByTitle($title): array
    {
        $query = $this->createQueryBuilder('a')
            ->join('a.artist', 'user')
            ->join('a.categories', 'categories')
            ->join('a.voice_style', 'voice')
            ->where('a.title LIKE :title')
            ->orWhere('user.pseudo LIKE :pseudo')
            ->orWhere('categories.name LIKE :categories')
            ->orWhere('voice.voice_style LIKE :voice')
            ->setParameters([
                'title' => "%{$title}%",
                'pseudo' => "%{$title}%",
                'categories' => "%" . ucfirst($title) . "%",
                'voice' => "%" . ucfirst($title) . "%",
            ])
            ->orderBy('a.id', 'DESC')
            ->getQuery();

        return $query->getResult();
    }


//    public function findOneBySomeField($value): ?AudioRecords
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
