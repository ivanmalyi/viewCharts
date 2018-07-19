<?php

namespace App\Repository;

use App\Entity\DatePeriod;
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

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLastData()
    {
        $queryBuilder = $this->createQueryBuilder('skid9')
            ->select('skid9')
            ->orderBy('skid9.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        $this->prepareDataForTable($queryBuilder);

        return $queryBuilder;
    }


    private function prepareDataForTable(Skid9 $skid9)
    {
        $interval = time() - $skid9->getDate()->getTimestamp();

        if ($interval > 60) {
            $skid9->setK1(0);
            $skid9->setK2(0);
            $skid9->setK3(0);
            $skid9->setK4(0);
            $skid9->setK5(0);
            $skid9->setTVar(0);
            $skid9->setVesVar(0);
            $skid9->setB1(0);
            $skid9->setB2(0);
            $skid9->setB3(0);
            $skid9->setSpeed(0);
            $skid9->setResponse('');
        }
    }
}
