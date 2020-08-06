<?php

namespace App\Repository\SendOfferBusiness;

use App\Entity\SendOfferBusiness\SendOfferBusiness;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SendOfferBusiness|null find($id, $lockMode = null, $lockVersion = null)
 * @method SendOfferBusiness|null findOneBy(array $criteria, array $orderBy = null)
 * @method SendOfferBusiness[]    findAll()
 * @method SendOfferBusiness[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SendOfferBusinessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SendOfferBusiness::class);
    }

    // /**
    //  * @return SendOfferBusiness[] Returns an array of SendOfferBusiness objects
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
    public function findOneBySomeField($value): ?SendOfferBusiness
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
