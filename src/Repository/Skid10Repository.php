<?php

namespace App\Repository;

use App\Entity\DatePeriod;
use App\Entity\Skid10;
use App\Exception\IncorrectDatePeriodException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @method Skid10|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skid10|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skid10[]    findAll()
 * @method Skid10[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Skid10Repository extends ServiceEntityRepository
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

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
     * Skid10Repository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Skid10::class);
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

        $queryBuilder = $this->createQueryBuilder('skid10')
            ->select('skid10')
            ->where('skid10.date > :startDate')
            ->andWhere('skid10.date < :endDate')
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
        $queryBuilder = $this->createQueryBuilder('skid10')
            ->select('skid10')
            ->orderBy('skid10.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        $this->prepareDataForTable($queryBuilder);

        return $queryBuilder;
    }

    /**
     * Метод обязательно должен возвращать ассоциативный массив такого формата,
     * для корректности отображения графиков
     *
     * @param Skid10 [] $dataForSkid
     * @param DatePeriod $datePeriod
     * @param int $id
     * @return array
     */
    private function prepareDataForChart(array $dataForSkid, DatePeriod $datePeriod, int $id): array
    {
        $startTime =  \DateTime::createFromFormat('d-m-y H:i:s',$datePeriod->getStartDate())->getTimestamp();
        $endTime = \DateTime::createFromFormat('d-m-y H:i:s',$datePeriod->getEndDate())->getTimestamp();

        if ($dataForSkid == []) {
            $time = $endTime < time() ? $endTime : time();
            $this->generateEmptyData( $startTime, $time, $id);
        }

        foreach ($dataForSkid as $skid10) {
            $endTimeInChart = (end($this->chart1)[0] ?? 0 - 10800) / 1000;
            $currentEndTimeInChart = $skid10->getDate()->getTimestamp();

            if ((($currentEndTimeInChart - $startTime) > 60) and ($this->chart1 == [])) {
                $this->generateEmptyData($startTime, $currentEndTimeInChart, $id);
            }

            if (($this->chart1 != []) and (($currentEndTimeInChart - $endTimeInChart) > 60)) {
                    $this->generateEmptyData($currentEndTimeInChart, $endTimeInChart, $id);
            }

            $this->generateFillData($skid10, $id);
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
            'chart5' => json_encode([]),
            'pointStart' => $this->chart1[0][0]
        ];
    }

    /**
     * @param Skid10 $skid10
     */
    private function prepareDataForTable(Skid10 $skid10)
    {
        $interval  = time() - $skid10->getDate()->getTimestamp();

        if ($interval > 60) {
            $skid10->setPSirop(0);
            $skid10->setSpeed(0);
            $skid10->setTSirop(0);
            $skid10->setTVar(0);
            $skid10->setVakuum(0);
            $skid10->setZad(0);
            $skid10->setZadTSirop(0);
            $skid10->setResponse('');
        }
    }

    /**
     * @param DatePeriod $datePeriod
     * @throws IncorrectDatePeriodException
     */
    private function validateDate(DatePeriod $datePeriod)
    {
        $errors = $this->validator->validate($datePeriod);
        if ($errors->count() > 0) {
            throw new IncorrectDatePeriodException();
        }
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
            if ($id == 1) {
                array_push($this->chart4, [($startTime + 10800) * 1000, 0]);
            }
            $startTime += 5;
        }
    }

    /**
     * @param Skid10 $skid10
     * @param int $id
     */
    private function generateFillData(Skid10 $skid10, int $id)
    {
        if ($id == 1) {
            array_push($this->chart1, [($skid10->getDate()->getTimestamp() + 10800) * 1000, $skid10->getTVar() / 10]);
            array_push($this->chart2, [($skid10->getDate()->getTimestamp() + 10800) * 1000, $skid10->getZad() / 10]);
            array_push($this->chart3, [($skid10->getDate()->getTimestamp() + 10800) * 1000, $skid10->getSpeed() / 10]);
            array_push($this->chart4, [($skid10->getDate()->getTimestamp() + 10800) * 1000, $skid10->getVakuum()]);
        } elseif ($id == 2) {
            array_push($this->chart1, [($skid10->getDate()->getTimestamp() + 10800) * 1000, $skid10->getTSirop() / 10]);
            array_push($this->chart2, [($skid10->getDate()->getTimestamp() + 10800) * 1000, $skid10->getZadTSirop() / 10]);
            array_push($this->chart3, [($skid10->getDate()->getTimestamp() + 10800) * 1000, $skid10->getPSirop() / 10]);
        }
    }
}
