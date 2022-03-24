<?php
namespace App;


class ConsoleHandler
{
    /**
     * The function reads the console and validates the user input
     * @param $year
     * @return Application
     */
    public function getFilename($year): string
    {
        $fileName = readline("Enter the file name (optional)  ");
        //check if the name is valid
        if (!empty($fileName) && !$this->isFilenameValid($fileName)) {
            die('You need to specify a valid filename');
        }

        if (empty($fileName)) {
            $fileName = "salary_schedule_{$year}";
        }

        return $fileName;
    }

    /**
     *
     * @param string $userInput
     * @return bool
     */
    private function isFilenameValid(string $userInput) : bool
    {
        return preg_match('/^([-\.\w]+)$/', $userInput) > 0;
    }
}
