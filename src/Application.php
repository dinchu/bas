<?php
namespace App;


class Application
{
    private static Application $instance;

    private const DEFAULT_FOLDER = 'output';

    private int $currentYear;

    private int $currentMonth;

    private string $fileName;

    private $fp;


    public function __construct()
    {
        $this->currentYear  = date('Y');
        $this->currentMonth = date('m');
    }

    /**
     *
     * @return Application
     */
    public static function getInstance() : Application
    {
        if (!isset(self::$instance))
        {
            self::$instance = new Application();
        }
        return self::$instance;
    }

    /**
     *
     * @return void
     */
    public function execute() : void
    {
        //handles the CLI input
        $consoleHandler = new ConsoleHandler();
        $this->fileName = self::DEFAULT_FOLDER . $consoleHandler->getFilename($this->currentYear) . 'csv';

        $this->writeToCsv(
            [
                'month', 'salary payment date', 'bonus payment date'
            ]
        );

        $this->processSalaryDates();

    }

    /**
     * @param $data
     * @return void
     */
    private function writeToCsv(array $data): void
    {
        $this->checkFP();
        fputcsv($this->fp, $data);
    }

    /**
     * @return void
     */
    private function processSalaryDates(): void
    {
        for ($month = $this->currentMonth; $month <= 12; $month++) {

            $salary   = getLastWorkingDateInMonth($month, $this->currentYear);
            $bonus    = getWorkingDayInQuarter($month, $this->currentYear);
            $output = [
                $salary->format('M'),
                $salary->format('D d'),
                $bonus->format('D d')
            ];
            fputcsv($this->fp, $output);
        }
    }

    /**
     * @return void
     */
    private function checkFP(): void
    {
        if (!isset($this->fp)) {
            $this->fp = fopen($this->fileName, 'w');
        }

    }

    public function __destruct()
    {
        fclose($this->fp);
    }

}
