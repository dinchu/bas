<?php

    $year = date('Y');
    $fileName = readline("Enter the file name (optional)  ");
    //check if the name is valid
    if (!empty($fileName) && !is_valid_name($fileName)) {
        die('You need to specify a valid filename');
    }

    if (empty($fileName)) {
        $fileName = "salary_schedule_{$year}";
    }

    $fp = fopen("output/{$fileName}.csv", 'w');
    $csvHeader = [
        'month', 'salary payment date', 'bonus payment date'
    ];
    fputcsv($fp, $csvHeader);
    for ($month = 1; $month<=12; $month++) {

        $salary   = getLastWorkingDateInMonth($month, $year);
        $bonus    = getWorkingDayInQuarter($month, $year);
        $output = [
            $salary->format('M'),
            $salary->format('D d'),
            $bonus->format('D d')
        ];
        fputcsv($fp, $output);

    }
    fclose($fp);


    function is_valid_name($file) {
        return preg_match('/^([-\.\w]+)$/', $file) > 0;
    }

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

    function appendToCsv(array $data, string $fileName): bool {


        fputcsv($fileName, $data);
    }