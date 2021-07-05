<?php

namespace App\Repository;

use App\Entity\Van;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Van|null find($id, $lockMode = null, $lockVersion = null)
 * @method Van|null findOneBy(array $criteria, array $orderBy = null)
 * @method Van[]    findAll()
 * @method Van[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Van::class);
    }
}
