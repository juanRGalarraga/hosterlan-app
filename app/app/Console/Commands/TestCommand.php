<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;
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
        $files = Storage::allFiles('stock');
        if($files){
            Storage::copy("stock/$picture->name", "{$picture->publication->id}/{$picture->name}");
        }
        dump($files);
    }
}
