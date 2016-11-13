<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Prayer;

class NewPrayer implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $prayer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($prayer)
    {
        $this->prayer = $prayer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-prayers');
    }
}
