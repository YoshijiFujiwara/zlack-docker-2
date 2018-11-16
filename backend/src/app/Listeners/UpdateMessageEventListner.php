<?php

namespace App\Listeners;

use App\Events\UpdateMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateMessageEventListner
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
     * @param  UpdateMessageEvent  $event
     * @return void
     */
    public function handle(UpdateMessageEvent $event)
    {
        //
    }
}
