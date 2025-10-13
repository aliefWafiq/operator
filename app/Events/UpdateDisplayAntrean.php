<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateDisplayAntrean implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dataAntreanTerkini;

    public function __construct($dataAntreanTerkini)
    {
        $this->dataAntreanTerkini = $dataAntreanTerkini;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('antrean-display-channel'),
        ];
    }
}
