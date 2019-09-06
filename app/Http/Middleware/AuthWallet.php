<?php

namespace App\Http\Middleware;

use Closure;

class AuthWallet
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
        // if session does not exists
        if (!session('authAddress')) {
            return redirect()->route('welcome');
        }
        return $next($request);
    }
}
