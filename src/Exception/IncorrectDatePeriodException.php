<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 12.06.18
 * Time: 16:19
 */

namespace App\Exception;

class IncorrectDatePeriodException extends \Exception
{

    /**
     * IncorrectDatePeriodException constructor.
     */
    public function __construct()
    {
        parent::__construct('Не корректно введена дата');
    }
}