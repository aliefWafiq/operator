<?php

namespace App\Events;

use App\Models\antreans;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QueueCalled implements ShouldBroadcastNow
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
