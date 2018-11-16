<?php

namespace App\Listeners;

use App\Events\CreateMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateMessageEventListner
{
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
     * @param  CreateMessageEvent  $event
     * @return void
     */
    public function handle(CreateMessageEvent $event)
    {
        //
    }
}
