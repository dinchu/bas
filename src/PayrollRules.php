<?php

namespace App;

use DateTime;

abstract class PayrollRules
{
    /**
     * Detects if the proposed date is weekend (Sun or Sat)
     * @param int $timeStamp
     * @return bool
     */
    function isWeekend(int $timeStamp): bool {
        $weekDay = date('w', $timeStamp);
        return ($weekDay == 0 || $weekDay == 6);
    }

    /**
     * @param int $month
     * @param int $year
     * @return DateTime
     */
    abstract function getPaymentDate(int $month, int $year) : DateTime;

}
