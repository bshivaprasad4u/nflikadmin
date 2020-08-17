<?php

namespace App\Notifications;

use App\ApiCode;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class SendOtpNotification extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
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
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {


        return (new MailMessage)
            ->subject(Lang::get('One Time Password for Login'))
            ->line(Lang::get('You are receiving this email because we received a login request from new device.'))
            //->action(Lang::get('Reset Password'), $url)
            ->line(Lang::get('Code: ' . $notifiable->otp))
            ->line(Lang::get('This OTP will expire in ' . ApiCode::OTP_EXIPRES_IN_MINS . ' minutes.'))
            ->line(Lang::get('If you dont want to use this OPT, You can login with.'));
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
