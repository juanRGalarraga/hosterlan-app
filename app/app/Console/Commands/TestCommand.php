<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Enums\Publication\StateEnum;
use Carbon\Carbon;
class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $date = \DateTime::createFromFormat('d/m/Y', "24/06/2024");
        print_r( \DateTime::createFromFormat('d/m/Y', "24/06/2024")->format("Y-m-d")); 
    }
}
