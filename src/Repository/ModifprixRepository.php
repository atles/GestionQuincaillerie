<?php

namespace App\Repository;

use App\Entity\Modifprix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Modifprix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modifprix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modifprix[]    findAll()
 * @method Modifprix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModifprixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modifprix::class);
    }

    // /**
    //  * @return Modifprix[] Returns an array of Modifprix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Modifprix
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
