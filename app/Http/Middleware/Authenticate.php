<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function unauthenticated($request, array $guards)
    {
        // If the request expects JSON (API call), return a 401 response
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Otherwise, redirect to login page
        return redirect()->guest(route('login'));
    }

}
