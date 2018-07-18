<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class DatePeriod
{
    /**
     * @Assert\DateTime()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $startDate;

    /**
     * @Assert\DateTime()
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $endDate;

    /**
     * DatePeriod constructor.
     * @param string $startDate
     * @param string $endDate
     */
    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }
}
