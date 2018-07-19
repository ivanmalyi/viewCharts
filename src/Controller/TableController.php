<?php

namespace App\Controller;

use App\Entity\Skid10;
use App\Entity\Skid9;
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

                $dataForTable['dataForTable'] = $skid10;
                $dataForTable['nameTable'] = 'skid';

                break;

            case 'Skid9':
                $skid9 = $this->getDoctrine()->getRepository(Skid9::class)
                    ->findLastData();

                $dataForTable['dataForTable'] = $skid9;
                $dataForTable['nameTable'] = 'skid9';

                break;
        }

        return $dataForTable;
    }
}
