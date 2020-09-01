<?php

namespace App\Repository;

use App\Entity\Lignecommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lignecommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lignecommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lignecommande[]    findAll()
 * @method Lignecommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignecommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lignecommande::class);
    }

    // /**
    //  * @return Lignecommande[] Returns an array of Lignecommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lignecommande
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
