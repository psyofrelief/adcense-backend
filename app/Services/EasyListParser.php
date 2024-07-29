<?php

namespace App\Services;

class EasyListParser
{
    public function parse()
    {
        // Path to the EasyList file
        $filePath = storage_path("app/easylist.txt");

        // Initialize an array to hold the parsed rules
        $rules = [];

        // Open the file for reading
        if ($handle = fopen($filePath, "r")) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                // Ignore lines starting with !
                if (strpos($line, "!") === 0 || strpos($line, "[") === 0) {
                    continue;
                }
                // Add the line to the rules array
                $rules[] = $line;
            }
            fclose($handle);
        }

        return $rules;
    }
}
