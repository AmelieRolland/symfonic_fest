<?php

namespace App\Repository;

use App\Entity\ProgDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProgDay>
 *
 * @method ProgDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgDay[]    findAll()
 * @method ProgDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgDay::class);
    }

    //    /**
    //     * @return ProgDay[] Returns an array of ProgDay objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProgDay
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
