<?php
namespace App;


use App\Models\Bonus;
use App\Models\Salary;

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
     * Main function
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
        $bonusModel  = new Bonus();
        $salaryModel = new Salary();
        for ($month = $this->currentMonth; $month <= 12; $month++)
        {
            $salaryDate   = $salaryModel->getPaymentDate($month, $this->currentYear);
            $bonusDate    = $bonusModel->getPaymentDate($month, $this->currentYear);
            $output = [
                $salaryDate->format('M'),
                $salaryDate->format('D d'),
                $bonusDate->format('D d')
            ];
            $this->writeToCsv($output);
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
