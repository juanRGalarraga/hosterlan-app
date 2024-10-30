<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use App\Enums\Publication\StateEnum;
use App\Models\Publication;
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
        $files = Storage::disk('temp')->files("publication_1GkhyXXzJ9WTxGyaJJaSo");
        $publication = new Publication();
        dump($publication->getFillable());
        // foreach ($files as $key => $file) {
        //     dump(basename($file));
        //     dump(pathinfo($file, PATHINFO_EXTENSION));
        // }

    }
}
