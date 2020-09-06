<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Payment;
use App\User;

class UserCouponPurchasedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $payment;
    public $user;
    public $email_to;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $payment, User $user, $email_to)
    {
        $this->payment = $payment;
        $this->user = $user;
        $this->email_to = $email_to;
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
