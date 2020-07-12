<?php

namespace Illuminate\Auth\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;

class ClientEmailIsVerified extends EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        $guards = array_keys(config('auth.guards'));
        foreach($guards as $guard) {
            if ($guard == 'client') {
                if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route($redirectToRoute ?: 'client.verification.notice');
            }else if($guard =='agent'){
                if (! $request->user() ||
                ($request->user() instanceof MustVerifyEmail &&
                ! $request->user()->hasVerifiedEmail())) {
                return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : Redirect::route($redirectToRoute ?: 'agent.verification.notice');
            }else{
                if (! $request->user() ||
                ($request->user() instanceof MustVerifyEmail &&
                ! $request->user()->hasVerifiedEmail())) {
                return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : Redirect::route($redirectToRoute ?: 'verification.notice');
            }
            }
        

        return $next($request);
    }
}
