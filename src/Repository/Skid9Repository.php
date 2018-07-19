<?php

namespace App\Repository;

use App\Entity\Skid9;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Skid9|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skid9|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skid9[]    findAll()
 * @method Skid9[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Skid9Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Skid9::class);
    }

//    /**
//     * @return Skid9[] Returns an array of Skid9 objects
//     */
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
    public function findOneBySomeField($value): ?Skid9
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
