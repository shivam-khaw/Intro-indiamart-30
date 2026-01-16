<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Test1Command extends Command
{
    // The name and signature of the console command
    protected $signature = 'test1:run';

    // The console command description
    protected $description = 'This is a test command called test1';

    // Execute the console command
    public function handle()
    {
        Log::info("Test1 command is running");  // Logs a message to the Laravel log file
        // Your logic here
            echo "Command executed successfully.";

    }
}
