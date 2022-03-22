<?php

for($month = 1; $month<=12; $month++) {
    var_dump(getLastWorkingDayInMonth($month, 2022));
}

/*


This company is handling their sales payroll in the following way:

Sales staff gets a monthly fixed base salary and a monthly bonus.
The base salaries are paid on the last day of the month unless that day is a Saturday or a Sunday (weekend).

On the 15th of every month bonuses are paid for the previous month, unless that day is a weekend.
In that case, they are paid the first Wednesday after the 15th.
The output of the utility should be a CSV file, containing the payment dates for the remainder of this year.
 The CSV file should contain a column for the month name, a column that contains the salary payment date for that month,
 and a column that contains the bonus payment date
For your convenience, we've added the following flow-chart to visualize the requirements
 */

function getLastWorkingDayInMonth($month, $year) : DateTime {
    $currentMonth = new DateTime("{$year}-{$month}-01");
    $currentMonth->modify('last day of this month');

    if (isWeekend($currentMonth->getTimestamp())) {
        //process again to find the previous working day
        var_dump('is weekend');
    }

    return $currentMonth;

}

function isWeekend(int $timeStamp): bool {
    $weekDay = date('w', $timeStamp);
    return ($weekDay == 0 || $weekDay == 6);
}

function format(int $timeStamp): bool {

}