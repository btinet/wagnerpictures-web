<?php

namespace App\Repository;

use App\Entity\SampleComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SampleComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method SampleComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method SampleComment[]    findAll()
 * @method SampleComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SampleCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SampleComment::class);
    }

    // /**
    //  * @return SampleComment[] Returns an array of SampleComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SampleComment
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
