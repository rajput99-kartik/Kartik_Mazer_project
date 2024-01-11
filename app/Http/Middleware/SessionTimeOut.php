<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\CacheQueryResults;


class SessionTimeOut
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (now()->diffInMinutes(session('lastActivityTime')) >= (1) ) {  // also you can this value in your config file and use here
            if (auth()->check() && auth()->id() > 1) {
                $user = auth()->user();
                auth()->logout();
     
                $user->update(['is_logged_in' => false]);
                $this->reCacheAllUsersData();
     
                session()->forget('lastActivityTime');
     
                return redirect(route('users.login'));
            }
     
        }
    }
}
