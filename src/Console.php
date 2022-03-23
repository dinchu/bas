<?php
namespace App;


class ConsoleHandler
{

    /**
     *
     * @param $year
     * @return Application
     */
    public function getFilename($year): string
    {
        $fileName = readline("Enter the file name (optional)  ");
        //check if the name is valid
        if (!empty($fileName) && !is_valid_name($fileName)) {
            die('You need to specify a valid filename');
        }

        if (empty($fileName)) {
            $fileName = "salary_schedule_{$year}";
        }

        return $fileName;
    }


}
