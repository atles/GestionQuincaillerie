<?php

namespace App\Repository;

use App\Entity\Quincaillerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quincaillerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quincaillerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quincaillerie[]    findAll()
 * @method Quincaillerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuincaillerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quincaillerie::class);
    }

    // /**
    //  * @return Quincaillerie[] Returns an array of Quincaillerie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Quincaillerie
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
