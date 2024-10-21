<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated via Sanctum
        if (!Auth::guard('sanctum')->check()) {
            return response()->json(['error' => 'Token hato yoki foydalanuvchi autentifikatsiyadan o‘tmagan'], 401);
        }

        $user = Auth::user();

        // Check if the user's role is in the list of allowed roles
        if (!in_array($user->role, $roles)) {
            return response()->json(['error' => 'Sizda ushbu sahifaga kirish huquqi yo‘q.'], 403);
        }

        // Proceed with the request
        return $next($request);
    }
}
