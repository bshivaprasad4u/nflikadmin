<?php

namespace App\Listeners;

use App\Events\UserSubscribedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\SubscriptionUser;
use App\Client;
use App\User;
use App\Events\GetUserClientIdEvent;
use App\Events\SendClientPasswordEvent;
use App\Notifications\ClientPasswordEmail;
use Illuminate\Support\Str;
use App\Notifications\SubscriptionPayment;
use Illuminate\Support\Facades\Hash;

class UserSubscribedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function get_client_id(User $user)
    {
        $client = Client::where(['email' => $user->email, 'phone' => $user->mobile])->first();
        if ($client) {
            $client_id = $client->id;
        } else {
            $password = Str::random(8);
            $save_data = ['name' => $user->name, 'email' => $user->email, 'phone' => $user->mobile, 'password' => Hash::make($password)];
            $insert_client = Client::create($save_data);
            $insert_client->notify((new ClientPasswordEmail($password))->delay(now()->addSeconds(10)));
            //$insert_client->sendClientPasswordNotification($password)->delay(10);
            $client_id = $insert_client->id;
        }
        return $client_id;
    }

    /**
     * Handle the event.
     *
     * @param  UserSubscribedEvent  $event
     * @return void
     */
    public function handle(UserSubscribedEvent $event)
    {

        $subscription_user = [
            'user_id' => $event->payment->user_id,
            'subscription_id' => $event->payment->item_id,
            'expires_at' => now()->addYear(),
            'client_id' => $this->get_client_id($event->user)
        ];
        $subscription_payment = SubscriptionUser::create($subscription_user);
        if ($subscription_payment) {
            $event->user->notify(new SubscriptionPayment($subscription_payment));
        }
    }
}
