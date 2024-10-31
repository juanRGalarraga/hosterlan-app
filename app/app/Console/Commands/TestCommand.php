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
        $record = [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'dni' => '12345678',
            'dirección' => 'Asturias 322',
        ];

        Session::put("publicartion__" . 2, $record);
        Session::put("publicartion__" . 3, $record);

        dump(Session::get("publicartion__" . 3));

    }
}
