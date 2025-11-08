<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AddleaveController;

class AddLeave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:addleavebycorn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every Monthy Add Leave (1.5) At 12:00 Am';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $objaddleaveController = new AddleaveController;
        $getdata = $objaddleaveController->index();
        $this->info('Push sent successfully!!');
        return Command::SUCCESS;
    }
}
