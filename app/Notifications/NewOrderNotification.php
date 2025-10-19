<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // نخزنها في DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'name'     => $this->order->name,
            'status'   => $this->order->status,
        ];
    }
}

