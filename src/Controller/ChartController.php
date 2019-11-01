<?php

namespace App\Controller;

use App\Entity\DatePeriod;
use App\Entity\ParametersForChart;
use App\Entity\Skid10;

use App\Entity\Skid9;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ViewChartsController
 * @package App\Controller
 */
class ChartController extends Controller
{

    /**
     * @Route("charts/{nameLine}{id}", name="charts")
     *
     * @param string $nameLine
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function charts(string $nameLine, int $id, Request $request)
    {
        try {
            $startTime = $request->query->get('startTime');
            $endTime = $request->query->get('endTime');

            if ($startTime == null or $endTime == null) {
                $startTime = \DateTime::createFromFormat('d-m-y H:i:s', '2018-08-23 14:20:00')->format('d-m-y H:i:s');
                $endTime = \DateTime::createFromFormat('d-m-y H:i:s','2018-08-23 15:20:00')->format('d-m-y H:i:s');
        } else {
                $startTime =  \DateTime::createFromFormat('d-m-y H:i:s',$startTime)->format('d-m-y H:i:s');
                $endTime = \DateTime::createFromFormat('d-m-y H:i:s',$endTime)->format('d-m-y H:i:s');
            }
            $parametersChart = $this->getRepositoryParametersForChart($nameLine, $id);
            $dataForChart = $this->getRepositoryForCharts($nameLine, $id, new DatePeriod($startTime, $endTime));
    } catch (\Exception $e) {
        $message = $e->getMessage();
    }

        return $this->render('charts/regularCharts.html.twig', [
            'chart'=>$dataForChart ?? [],
            'parametersChart' => $parametersChart ?? [],
            'nameLine' => $nameLine,
            'id' => $id,
            'message' => $message ?? ''
        ]);
    }

    /**
     * @param string $nameLine
     * @param int $id
     * @param DatePeriod $datePeriod
     * @return mixed
     */
    private function getRepositoryForCharts(string $nameLine, int $id, DatePeriod $datePeriod)
    {
        switch ($nameLine) {
            case 'Skid10':
                $dataForCharts = $this->getDoctrine()->getRepository(Skid10::class)
                    ->findDataAboutPeriod($id, $datePeriod);
                break;

            case 'Skid9':
                $dataForCharts = $this->getDoctrine()->getRepository(Skid9::class)
                    ->findDataAboutPeriod($id, $datePeriod);
                break;
        }

        return $dataForCharts;
    }

    /**
     * @param string $nameLine
     * @param int $id
     * @return mixed
     */
    private function getRepositoryParametersForChart(string $nameLine, int $id)
    {
        $parametersChart = $this->getDoctrine()->getRepository(ParametersForChart::class)
            ->findParametersForChart($nameLine, $id);

        return $parametersChart;
    }
}
