<?php


$a = readline('Enter a string: ');

die('pepe');
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


for($month = 1; $month<=12; $month++) {

    $salary   = getLastWorkingDateInMonth($month, 2022);
    $bonus    = getWorkingDayInQuarter($month, 2022);
    $output[] = [
        $salary->format('M'),
        $salary->format('D d'),
        $bonus->format('D d')
    ];

}
createCsv($output);
var_dump($output);

/**
 * This method finds the last working day in a given month/year
 * Using relative formats to modify the dates. read more here
 * https://www.php.net/manual/en/datetime.formats.relative.php
 * @param $month
 * @param $year
 * @return DateTime
 */
function getLastWorkingDateInMonth($month, $year) : DateTime {
    $currentMonth = new DateTime("{$year}-{$month}-01");
    $currentMonth->modify('last day of this month');

    if (isWeekend($currentMonth->getTimestamp())) {
        //process again to find the previous working day
        $currentMonth->modify('last friday of this month');
    }

    return $currentMonth;

}

/**
 * This method returns a date with the closest working day to day 15th
 * @param $month
 * @param $year
 * @return DateTime
 */
function getWorkingDayInQuarter($month, $year) : DateTime {
    $currentMonth = new DateTime("{$year}-{$month}-15");

    if (isWeekend($currentMonth->getTimestamp())) {
        //process again to find the previous working day
        $currentMonth->modify('wednesday next week');
    }

    return $currentMonth;
}

/**
 * Detects if the proposed date is weekend (Sun or Sat)
 * @param int $timeStamp
 * @return bool
 */
function isWeekend(int $timeStamp): bool {
    $weekDay = date('w', $timeStamp);
    return ($weekDay == 0 || $weekDay == 6);
}

function prepare(int $timeStamp): bool {

}

function createCsv(array $data): bool {
    $fileName = 'output/salary.csv';
    $csvHeader = [
        'month', 'salary payment date', 'bonus payment date'
    ];
    $data = array_merge($csvHeader, $data);
    fputcsv($fileName, $data);
}