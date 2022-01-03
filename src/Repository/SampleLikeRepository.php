<?php

namespace App\Repository;


use App\Entity\SampleLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SampleLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method SampleLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method SampleLike[]    findAll()
 * @method SampleLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SampleLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SampleLike::class);
    }

    // /**
    //  * @return SampleLike[] Returns an array of SampleLike objects
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

    public function findOneByUserLike($user,$sample): ?SampleLike
    {
        return $this->createQueryBuilder('s')
            ->andWhere('user.id = :user')
            ->andWhere('sample.id = :sample')
            ->leftJoin('s.sample','sample')
            ->leftJoin('s.user','user')
            ->setParameter('sample', $sample)
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
