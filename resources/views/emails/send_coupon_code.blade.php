@component('mail::message')
Hello there,
<br>
Your friend {{$content->purchased_by_user['name'] }} sent this coupon to wath the {{ $content->user_purchased_content['name']}} in our website.
<br>
Coupon Code : {{ $content->coupon_code }}<br>
Code valid upto : {{ $content['expires_at']->format('M-d-Y') }}<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent