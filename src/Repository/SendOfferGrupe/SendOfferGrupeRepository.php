<?php

namespace App\Repository\SendOfferGrupe;

use App\Entity\SendOfferGrupe\SendOfferGrupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SendOfferGrupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method SendOfferGrupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method SendOfferGrupe[]    findAll()
 * @method SendOfferGrupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SendOfferGrupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SendOfferGrupe::class);
    }

    // /**
    //  * @return SendOfferGrupe[] Returns an array of SendOfferGrupe objects
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
    public function findOneBySomeField($value): ?SendOfferGrupe
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
