<?php

namespace App\Repository\CandidateProfil;

use App\Entity\CandidateProfil\CandidateProfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CandidateProfil|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidateProfil|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidateProfil[]    findAll()
 * @method CandidateProfil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateProfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidateProfil::class);
    }

    // /**
    //  * @return CandidateProfil[] Returns an array of CandidateProfil objects
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
    public function findOneBySomeField($value): ?CandidateProfil
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
