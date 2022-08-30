<?php

namespace App\Repository;

use App\Entity\SystemForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SystemForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method SystemForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method SystemForm[]    findAll()
 * @method SystemForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SystemFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SystemForm::class);
    }

    // /**
    //  * @return SystemForm[] Returns an array of SystemForm objects
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
    public function findOneBySomeField($value): ?SystemForm
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
