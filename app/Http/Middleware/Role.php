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
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Token noto'g'ri yoki foydalanuvchi autentifikatsiyadan o'tmagan bo'lsa, 401 qaytarish
        if (!Auth::check()) {
            return response()->json(['error' => 'Token hato yoki foydalanuvchi autentifikatsiyadan o‘tmagan'], 401);
        }

        $user = Auth::user();

        // Agar foydalanuvchining roli ko'rsatilgan ro'llardan biri bo'lmasa, 403 xato qaytarish
        if (!in_array($user->role, $roles)) {
            return response()->json(['error' => 'Sizda ushbu sahifaga kirish huquqi yo‘q.'], 403);
        }

        // Barcha tekshiruvlardan o‘tgan foydalanuvchi uchun requestni davom ettirish
        return $next($request);
    }
}
