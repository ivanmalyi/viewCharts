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
    /**
     * @var array
     */
    private $chart1 = [];

    /**
     * @var array
     */
    private $chart2 = [];

    /**
     * @var array
     */
    private $chart3 = [];

    /**
     * @var array
     */
    private $chart4 = [];

    /**
     * @var array
     */
    private $chart5 = [];

    /**
     * Skid9Repository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Skid9::class);
    }

    /**
     * @param int $id
     * @param DatePeriod $datePeriod
     * @return array
     */
    public function findDataAboutPeriod(int $id, DatePeriod $datePeriod)
    {
        /*try {
            $this->validateDate($datePeriod);
        } catch (IncorrectDatePeriodException $e) {
            $startTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', time() - 3600))->format('Y-m-d H:i:s');
            $endTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', time()))->format('Y-m-d H:i:s');

            $datePeriod = new DatePeriod($startTime, $endTime);
        }*/

        $queryBuilder = $this->createQueryBuilder('skid9')
            ->select('skid9')
            ->where('skid9.date > :startDate')
            ->andWhere('skid9.date < :endDate')
            ->setParameters([
                'startDate' => \DateTime::createFromFormat('d-m-y H:i:s',$datePeriod->getStartDate()),
                'endDate' => \DateTime::createFromFormat('d-m-y H:i:s',$datePeriod->getEndDate()),
            ])
            ->getQuery()
            ->getResult();

        return $this->prepareDataForChart($queryBuilder, $datePeriod,  $id);
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

    /**
     * @param array $dataForSkid
     * @param DatePeriod $datePeriod
     * @param int $id
     * @return array
     */
    private function prepareDataForChart(array $dataForSkid, DatePeriod $datePeriod, int $id): array
    {
        $startTime =  \DateTime::createFromFormat('d-m-y H:i:s', $datePeriod->getStartDate())->getTimestamp();
        $endTime = \DateTime::createFromFormat('d-m-y H:i:s', $datePeriod->getEndDate())->getTimestamp();

        if ($dataForSkid == []) {
            $time = $endTime < time() ? $endTime : time();
            $this->generateEmptyData( $startTime, $time, $id);
        }

        foreach ($dataForSkid as $skid9) {
            $endTimeInChart = (end($this->chart1)[0] ?? 0 - 10800) / 1000;
            $currentEndTimeInChart = $skid9->getDate()->getTimestamp();

            if ((($currentEndTimeInChart - $startTime) > 60) and ($this->chart1 == [])) {
                $this->generateEmptyData($startTime, $currentEndTimeInChart, $id);
            }

            if (($this->chart1 != []) and (($currentEndTimeInChart - $endTimeInChart) > 60)) {
                $this->generateEmptyData($currentEndTimeInChart, $endTimeInChart, $id);
            }

            $this->generateFillData($skid9, $id);
        }

        if (($dataForSkid != []) and (($endTime - $currentEndTimeInChart) > 60)) {
            $time = $endTime < time() ? $endTime : time();
            $this->generateEmptyData($currentEndTimeInChart, $time, $id);
        }

        return $dataForPrepare = [
            'chart1' => json_encode($this->chart1),
            'chart2' => json_encode($this->chart2),
            'chart3' => json_encode($this->chart3),
            'chart4' => json_encode($this->chart4),
            'chart5' => json_encode($this->chart5)
        ];
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @param int $id
     */
    private function generateEmptyData(int $startTime, int $endTime, int $id)
    {
        while ( $startTime < $endTime) {
            array_push($this->chart1, [($startTime + 10800) * 1000, 0]);
            array_push($this->chart2, [($startTime + 10800) * 1000, 0]);
            array_push($this->chart3, [($startTime + 10800) * 1000, 0]);
            if ($id == 3) {
                array_push($this->chart4, [($startTime + 10800) * 1000, 0]);
                array_push($this->chart5, [($startTime + 10800) * 1000, 0]);
            }
            $startTime += 5;
        }
    }

    /**
     * @param Skid9 $skid9
     * @param int $id
     */
    private function generateFillData(Skid9 $skid9, int $id)
    {
        if ($id == 3) {
            array_push($this->chart1, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getK1() / 10]);
            array_push($this->chart2, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getK2() / 10]);
            array_push($this->chart3, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getK3() / 10]);
            array_push($this->chart4, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getK4() / 10]);
            array_push($this->chart5, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getK5() / 10]);
        } elseif ($id == 4) {
            array_push($this->chart1, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getVesVar() / 10]);
            array_push($this->chart2, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getTVar() / 10]);
            array_push($this->chart3, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getSpeed() / 10]);
        } elseif ($id == 5) {
            array_push($this->chart1, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getB1() / 10]);
            array_push($this->chart2, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getB2() / 10]);
            array_push($this->chart3, [($skid9->getDate()->getTimestamp() + 10800) * 1000, $skid9->getB3() / 10]);
        }
    }


    /**
     * @param Skid9 $skid9
     */
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
