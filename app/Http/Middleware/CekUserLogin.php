<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUserLogin
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next, $rules)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $user = Auth::user();
        if ($user->role == $rules) {
            return $next($request);
        }
        return redirect('/')->with('error');
    }
}
