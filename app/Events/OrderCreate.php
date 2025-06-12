<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class OrderCreate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function broadcastAs(): string
    {
        return 'create';
    }

    public function broadcastOn()
    {
        return new Channel('orders');
    }

    public function broadcastWith(): array
    {
        return [
            'created_at' => $this->order->created_at,
            'order_code' => $this->order->order_code,
            'id' => $this->order->id
        ];
    }
}
