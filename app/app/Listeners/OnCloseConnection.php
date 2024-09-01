<?php

namespace App\Listeners;

use App\Events\CloseConnection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
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
        Log::channel('debugger')->info("USER {$event->user->id} ABANDONO LA PAGINA");
        $sessionPublicationId = Session::getId() . '-publicationtemp';
        Session::remove($sessionPublicationId);
    }
}
