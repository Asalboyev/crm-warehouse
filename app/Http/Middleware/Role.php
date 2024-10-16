<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Token hato'], 401);
        }

        $user = Auth::user();

        // Agar foydalanuvchi ro'li ko'rsatilgan ro'llardan biriga mos kelmasa
        if (!in_array($user->role, $roles)) {
            abort(403, 'Sizda ushbu sahifaga kirish huquqi yo‘q.');
        }

        return $next($request);
    }
}
