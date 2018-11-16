<?php

namespace App\Listeners;

use App\Events\DeleteMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteMessageEventListner
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
     * @param  DeleteMessageEvent  $event
     * @return void
     */
    public function handle(DeleteMessageEvent $event)
    {
        //
    }
}
