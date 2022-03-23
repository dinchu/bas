<?php

namespace App\Models;

use DateTime;
use App\PayrollRules;

class Salary extends PayrollRules
{

    public function __construct()
    {
        $this->currentYear  = date('Y');
        $this->currentMonth = date('m');
    }

    /**
     * This method finds the last working day in a given month/year
     * Using relative formats to modify the dates. read more here
     * https://www.php.net/manual/en/datetime.formats.relative.php
     * @param $month
     * @param $year
     * @return DateTime
     */
    function getPaymentDate(int $month, int $year) : DateTime {
        $currentMonth = new DateTime("{$year}-{$month}-01");
        $currentMonth->modify('last day of this month');

        if ($this->isWeekend($currentMonth->getTimestamp())) {
            //process again to find the previous working day
            $currentMonth->modify('last friday of this month');
        }

        return $currentMonth;

    }

}
