<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\AdDomain;

class EasyListSeeder extends Seeder
{
    public function run()
    {
        $url = "https://easylist.to/easylist/easylist.txt";
        $response = Http::get($url);

        if ($response->successful()) {
            Storage::put("easylist.txt", $response->body());

            $parser = new \App\Services\EasyListParser();
            $rules = $parser->parse();

            // Store the rules as a JSON object
            AdDomain::truncate(); // Clear old entries
            AdDomain::create(["domains" => json_encode($rules)]);

            $this->command->info(
                "EasyList downloaded and stored successfully."
            );
        } else {
            $this->command->error("Failed to download EasyList.");
        }
    }
}
