<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SilverCron extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'silvercron:job2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command silvar cron run';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://integrow.org/indiamart-hub/cron_run_2');
        Log::info('Platinum route triggered successfully.'.$response); 
                    echo "Command executed successfully. 2hr";

     }

}
