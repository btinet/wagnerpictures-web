<?php

namespace App\Repository;

use App\Entity\SampleImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SampleImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SampleImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SampleImage[]    findAll()
 * @method SampleImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SampleImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SampleImage::class);
    }

    public function findOneLikeByUser($id,$user): ?SampleImage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :id')
            ->andWhere('user.id = :user')
            ->leftJoin('s.sampleLikes','sampleLikes')
            ->leftJoin('sampleLikes.user','user')
            ->setParameter('id', $id)
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findByJoinUser($user)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('user.id = :user')
            ->andWhere('s.isPublished = TRUE')
            ->leftJoin('s.sampleLikes','sampleLikes')
            ->leftJoin('sampleLikes.user','user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }

    public function countLikes($id)
    {
        return $this->createQueryBuilder('s')
            ->select('count(sampleLikes.id)')
            ->andWhere('s.id = :id')
            ->leftJoin('s.sampleLikes','sampleLikes')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function getPreviousPost($id)
    {
        return $this->createQueryBuilder('s')
            ->select('s')


            ->andWhere('s.id < :id')
            ->andWhere('s.isPublished = TRUE')
            ->andWhere('s.parent is null')
            ->setParameter(':id', $id)
            ->orderBy('s.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getNextPost($id)
    {
        return $this->createQueryBuilder('s')
            ->select('s')

            ->andWhere('s.id > :id')
            ->andWhere('s.isPublished = TRUE')
            ->andWhere('s.parent is null')
            ->setParameter(':id', $id)
            ->orderBy('s.id', 'ASC')
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
