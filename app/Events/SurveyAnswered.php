<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SurveyAnswered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $owner;
    public $answers = [];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($owner, $answers = [])
    {
        $this->owner = $owner;
        $this->answers = $answers;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
