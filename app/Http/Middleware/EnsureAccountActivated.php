<?php

namespace App\Http\Middleware;

use App\Models\Activation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAccountActivated
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and if their account is not activated
        if (Auth::check() && !Activation::where('user_id', Auth::user()->id)->where('status', status_name('COMPLETED'))->first()) {
            // Redirect to a specific route/page with a message
            return redirect()->route('activation');
        }

        return $next($request);
    }
}
