<?php

namespace App\Listeners;

use App\Events\CreateClientEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateClientListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateClientEvent  $event
     * @return void
     */
    public function handle(CreateClientEvent $event)
    {
        dd($event->user);
        //dd($event->password);
        //return $event->client->sendClientPasswordNotification($event->password);
    }
}
