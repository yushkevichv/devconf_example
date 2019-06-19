<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventForLoggingFired
{
    use Dispatchable, SerializesModels;

    public $model;
    public $extraData;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $model, $extraData)
    {
        $this->model = $model;
        $this->extraData = $extraData;
    }
}
