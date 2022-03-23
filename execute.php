<?php

    $fileName = readline("Enter the file name (optional)  ");

    $year = date('Y');

    if (empty($fileName)) {
        $fileName = "salary_schedule_{$year}.csv";
    }

    for ($month = 1; $month<=12; $month++) {

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