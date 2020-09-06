<?php

namespace App\Listeners;

use App\ApiCode;
use App\Events\UserCouponPurchasedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\CouponsUser;
use App\Mail\SendCouponCodeMail;
use App\Notifications\CouponPayment;
use App\Notifications\SendCouponCode;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;

class UserCouponPurchasedListener
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
    public function generate_coupon_code()
    {
        $code = join('-', str_split(Str::random(16), 4));
        return $code;
    }

    public function get_coupon_code()
    {
        $code = $this->generate_coupon_code();
        if (CouponsUser::where('coupon_code', $code)->exists())
            $this->generate_coupon_code();
        return Str::upper($code);
    }

    /**
     * Handle the event.
     *
     * @param  UserCouponPurchasedEvent  $event
     * @return void
     */
    public function handle(UserCouponPurchasedEvent $event)
    {

        $coupon_user = [
            'user_id' => $event->payment->user_id,
            'content_id' => $event->payment->item_id,
            'coupon_code' => $this->get_coupon_code(),
            'email_to' => $event->email_to,
            'expires_at' => now()->addDays(ApiCode::COUPON_EXIPRES_IN_DAYS),
        ];
        $coupon_payment = CouponsUser::create($coupon_user);
        if ($coupon_payment) {
            $event->user->notify(new CouponPayment($coupon_payment, $event->email_to));
            Notification::route('mail', $event->email_to)->notify(new SendCouponCode($coupon_payment));
            //Mail::to($event->email_to)->send(new SendCouponCodeMail($coupon_payment));
        }
    }
}
