<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
        if (Auth::check()) {
            if ($request->user()->user_role != 'admin') {
                return redirect('home');
            } else {
                return $next($request);
            }
        } else {
            return redirect('home')->with('permission-message', 'You lack the permission for this action!');
        }
    }
}
