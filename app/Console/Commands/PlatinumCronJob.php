<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlatinumCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platinumcron:job2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $response = Http::get('https://integrow.org/indiamart-hub/cron_run_10');
        if($response){
        Log::info("Platinum URL{$response}".now()); 
        }
        echo "Command executed successfully.20 minuts";

     }
}
