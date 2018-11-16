<?php

namespace App\Listeners;

use App\Events\StarMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StarMessageEvent
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
     * @param  StarMessageEvent  $event
     * @return void
     */
    public function handle(StarMessageEvent $event)
    {
        //
    }
}
