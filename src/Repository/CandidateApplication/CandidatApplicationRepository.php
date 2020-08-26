<?php

namespace App\Repository\CandidateApplication;

use App\Entity\CandidateApplication\CandidatApplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CandidatApplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidatApplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidatApplication[]    findAll()
 * @method CandidatApplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidatApplication::class);
    }

    // /**
    //  * @return CandidatApplication[] Returns an array of CandidatApplication objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CandidatApplication
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
