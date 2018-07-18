<?php

namespace App\Repository;

use App\Entity\ParametersForChart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParametersForChart|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParametersForChart|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParametersForChart[]    findAll()
 * @method ParametersForChart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParametersForChartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParametersForChart::class);
    }

    /**
     * @param string $lineName
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findParametersForChart(string $lineName, $id)
    {
        $queryBuilder = $this->createQueryBuilder('parameters_for_charts')
            ->select('parameters_for_charts')
            ->where('parameters_for_charts.name = :lineName')
            ->andWhere('parameters_for_charts.id = :id')
            ->setParameters([
                'lineName' => $lineName,
                'id' => $id
            ])
            ->getQuery()
            ->getOneOrNullResult();

        return $queryBuilder;
    }
}
