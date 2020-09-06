<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CouponPayment extends Notification implements ShouldQueue
{
    use Queueable;
    public $content;
    public $email_to;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content, $email_to)
    {
        $this->content = $content;
        $this->email_to = $email_to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Purchase Notification')
            ->line('Hi ' . $this->content->purchased_by_user['name'] . ',')
            ->line('Thank you for purchasing the ' . $this->content->user_purchased_content['name'] . ' Coupon.')
            ->line('We sent it to email : ' . $this->email_to)
            ->line('Thank you for using our application!');
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
