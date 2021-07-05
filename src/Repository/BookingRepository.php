<?php

namespace App\Repository;

use App\Entity\Booking;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

     /**
     * @return Booking[] Returns an array of Booking objects
     */

    public function findAllByStartDateGreaterThan(DateTimeInterface $date): array
    {
        $dateMorning = $date->format('Y-m-d:00:00:00');
        return $this->createQueryBuilder('b')
            ->andWhere('b.startDate > :dayStart')
            ->setParameter('dayStart', $dateMorning)
            ->orderBy('b.id', 'ASC')
            ->groupBy('b.startStation')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByEndStationAndEndDate(int $station, DateTimeInterface $date): array
    {
        $dateMorning = $date->format('Y-m-d:00:00:0000');
        return $this->createQueryBuilder('b')
            ->andWhere('b.endStation = :station')
            ->setParameter('station', $station)
            ->andWhere('b.endDate > :dayStart')
            ->setParameter('dayStart', $dateMorning)
            ->orderBy('b.id', 'ASC')
            ->groupBy('b.endStation')
            ->getQuery()
            ->getResult()
            ;
    }
}
