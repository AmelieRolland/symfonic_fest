<?php

namespace App\Repository;

use App\Entity\BandRegister;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BandRegister>
 *
 * @method BandRegister|null find($id, $lockMode = null, $lockVersion = null)
 * @method BandRegister|null findOneBy(array $criteria, array $orderBy = null)
 * @method BandRegister[]    findAll()
 * @method BandRegister[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandRegisterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BandRegister::class);
    }

    //    /**
    //     * @return BandRegister[] Returns an array of BandRegister objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BandRegister
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
