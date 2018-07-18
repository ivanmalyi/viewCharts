<?php

declare(strict_types=1);

namespace App\Controller;


use App\Entity\Skid10;

trait ControllerTrait
{
    private function getRepositoryForChart(string $nameLine)
    {
        $dataForChart = $this->getDoctrine()->getRepository(Skid10::class)
            ->findDataAboutPeriod();
    }
}