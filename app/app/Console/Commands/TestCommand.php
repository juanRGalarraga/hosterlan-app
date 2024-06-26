<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Enums\Publication\PublicationState;
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
        print_r(PublicationState::forMigration());
    }
}
