<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Agar login ma'lumotlari to'g'ri bo'lsa
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role; // Foydalanuvchi roli

            // Rollar bo'yicha yo'naltirish
            $url = '';
            if ($role === 'admin') {
                $url = 'dashboard';
            } elseif ($role === 'seller') {
                $url = 'seller/dashboard';
            } elseif ($role === 'guard') {
                $url = 'guard/dashboard';
            } elseif ($role === 'warehouseman') {
                $url = 'warehouseman/dashboard';
            } elseif ($role === 'user') {
                $url = 'user/dashboard';
            } else {
                // Roli aniqlanmagan bo'lsa, 403 xatolik qaytarish
                return response()->json(['message' => 'Sizda ushbu sahifaga kirish uchun ruxsat yo\'q.'], 403);
            }

            // Token yaratish va foydalanuvchini URLga yo'naltirish
            $token = $user->createToken('YourAppName')->plainTextToken;
            return response()->json([
                'token' => $token,
                'redirect_url' => url($url)
            ]);
        }

        // Login xatolik bo'lsa Unauthorized xabari
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
