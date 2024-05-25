<?php

namespace App\Repository;

use App\Entity\BandImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BandImages>
 *
 * @method BandImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method BandImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method BandImages[]    findAll()
 * @method BandImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BandImages::class);
    }

    //    /**
    //     * @return BandImages[] Returns an array of BandImages objects
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

    //    public function findOneBySomeField($value): ?BandImages
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
