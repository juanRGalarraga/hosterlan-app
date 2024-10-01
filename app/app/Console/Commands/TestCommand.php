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
        $since = (new \DateTime())->format('Y-m-d');
        $to = (new \DateTime($since))->modify('+7 days')->format('Y-m-d');
        print_r($since . PHP_EOL);
        print_r($to);
    }
}
