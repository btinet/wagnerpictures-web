<?php

namespace App\Repository;

use App\Entity\ApplicationImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApplicationImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationImage[]    findAll()
 * @method ApplicationImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationImage::class);
    }
}
