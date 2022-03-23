<?php

namespace App\Models;

use DateTime;
use App\PayrollRules;

class Bonus extends PayrollRules
{
    /**
     * This method returns a date with the closest working day to day 15th
     * @param $month
     * @param $year
     * @return DateTime
     */
    public function getPaymentDate(int $month, int $year) : DateTime
    {
        $currentMonth = new DateTime("{$year}-{$month}-15");

        if ($this->isWeekend($currentMonth->getTimestamp())) {
            //process again to find the previous working day
            $currentMonth->modify('wednesday next week');
        }

        return $currentMonth;
    }

}
