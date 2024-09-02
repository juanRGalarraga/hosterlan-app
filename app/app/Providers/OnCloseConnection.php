<?php

namespace App\Providers;

use App\Providers\CloseConnection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OnCloseConnection
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CloseConnection $event): void
    {
        //
    }
}
