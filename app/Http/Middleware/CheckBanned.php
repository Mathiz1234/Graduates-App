<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 0)
        {
            auth()->logout();
            return redirect()->route('login')->with('status', 'Your account has been blocked.');
        }

        return $next($request);
    }
}
