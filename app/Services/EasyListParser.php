<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class EasyListParser
{
    public function parse()
    {
        // Path to the EasyList file using the Storage facade
        $filePath = Storage::path("easylist.txt");

        // Initialize an array to hold the parsed rules
        $rules = [];

        // Open the file for reading
        if ($handle = fopen($filePath, "r")) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                // Ignore lines that are empty or start with ! or [
                if (
                    empty($line) ||
                    strpos($line, "!") === 0 ||
                    strpos($line, "[") === 0
                ) {
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
