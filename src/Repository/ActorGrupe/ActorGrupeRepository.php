<?php

namespace App\Repository\ActorGrupe;

use App\Entity\ActorGrupe\ActorGrupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActorGrupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActorGrupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActorGrupe[]    findAll()
 * @method ActorGrupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorGrupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActorGrupe::class);
    }

    // /**
    //  * @return ActorGrupe[] Returns an array of ActorGrupe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActorGrupe
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
