<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PrayedAlong implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $prayerid;

    public $prayalongcount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($prayerid, $prayalongcount)
    {
        $this->prayerid = $prayerid;

        $this->prayalongcount = $prayalongcount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('prayalong');
    }
}
