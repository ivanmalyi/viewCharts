<?php

namespace App\Controller;

use App\Entity\Skid10;
use App\Repository\Skid10Repository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableController extends Controller
{
    /**
     * @Route("tables/{nameLine}", name="tables")
     */
    public function tables(string $nameLine)
    {
        return $this->render('tables/baseTable.html.twig', ['nameLine'=>$nameLine]);
    }

    public function updateTable(string $nameLine)
    {
        $dataForTable = $this->getRepositoryForTable($nameLine);

        return $this->render('tables/' . $dataForTable['nameTable'] . '.html.twig', [
            'nameLine'=>$nameLine,
            'dataForTable'=>$dataForTable['dataForTable']
        ]);
    }

    private function getRepositoryForTable(string $nameLine)
    {
        $dataForTable = [];
        switch ($nameLine) {
            case 'Skid10':
                $skid10 = $this->getDoctrine()->getRepository(Skid10::class)
                    ->findLastData();
                $this->prepareDataForTable($skid10);

                $dataForTable['dataForTable'] = $skid10;
                $dataForTable['nameTable'] = 'skid';

                break;
        }

        return $dataForTable;
    }

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
}
