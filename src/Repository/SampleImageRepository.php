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
}
