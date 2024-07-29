<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchEasyListDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "app:fetch-easy-list-domains";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch EasyList ad domains from EasyList website.";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = "https://easylist.to/easylist/easylist.txt";
        $response = Http::get($url);

        if ($response->successful()) {
            Storage::put("easylist.txt", $response->body());
            $this->info("EasyList downloaded successfully.");
        } else {
            $this->error("Failed to download EasyList.");
        }
    }
}
