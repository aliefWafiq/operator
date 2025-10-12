<?php

namespace App\Events;

use App\Models\antreans;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QueueCalled implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $queue;

    public function __construct(antreans $queue)
    {
        $this->queue = $queue;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('antrean.' . $this->queue->id),
        ];
    }
}
