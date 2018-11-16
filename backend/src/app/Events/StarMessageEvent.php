<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use function Sodium\add;

class StarMessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $added;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($added)
    {
        $this->added = $added;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('starChannel');
    }
}
