<?php

namespace App\Repository;

use App\Entity\AudioRecordCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AudioRecordCategories>
 *
 * @method AudioRecordCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method AudioRecordCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method AudioRecordCategories[]    findAll()
 * @method AudioRecordCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AudioRecordCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AudioRecordCategories::class);
    }

    public function save(AudioRecordCategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AudioRecordCategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Return an array of the different ables  audio record categories
     * @return array
     */
    public function getCategoriesChoices(): array
    {
        $categories = $this->findAll();

        $choices = array();
        foreach ($categories as $category) {
            $choices[$category->getName()] = $category;
        }

        return $choices;
    }
//    /**
//     * @return AudioRecordCategories[] Returns an array of AudioRecordCategories objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AudioRecordCategories
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
