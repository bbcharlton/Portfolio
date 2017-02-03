<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PostMiddleware
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
            if ($request->user()->user_role == 'admin' || $request->user()->user_role == 'editor') {
                return $next($request);
            } else {
                return redirect('home')->with('permission-message', 'You lack the permission for this action!');
            }
        } else {
            return redirect('home')->with('permission-message', 'You lack the permission for this action!');
        }
    }
}
