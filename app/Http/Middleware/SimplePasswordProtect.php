<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimplePasswordProtect
{
    public function handle(Request $request, Closure $next)
    {
        // Check if browser is already trusted
        if ($request->cookie('trusted_browser') === 'yes') {
            return $next($request);
        }

        // // If session has access, allow
        // if (session('simple_password_granted')) {
        //     return $next($request);
        // }

        // Otherwise, show password form
        return response()->view('live_interviews.simple-password');
    }
}
// C:\laragon\www\businessDevelopmentLive\resources\views\live_interviews\simple-password.blade.php
