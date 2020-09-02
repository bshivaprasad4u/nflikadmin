<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  CreateUserEvent  $event
     * @return void
     */
    public function handle(CreateUserEvent $event)
    {
        dd($event->user);
    }
}
