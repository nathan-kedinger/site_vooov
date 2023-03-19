<?php

namespace App\Repository;

use App\Entity\VoiceStyle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VoiceStyle>
 *
 * @method VoiceStyle|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoiceStyle|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoiceStyle[]    findAll()
 * @method VoiceStyle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoiceStyleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoiceStyle::class);
    }

    public function save(VoiceStyle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VoiceStyle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getVoiceStyleChoices()
    {
        $voiceStyles = $this->findAll();

        $choices = array();
        foreach ($voiceStyles as $voiceStyle) {
            $choices[$voiceStyle->getVoiceStyle()] = $voiceStyle;
        }

        return $choices;
    }
//    /**
//     * @return VoiceStyle[] Returns an array of VoiceStyle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VoiceStyle
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
