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

    // Login ma'lumotlari to'g'ri bo'lsa
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Eski tokenlarni o'chirish
        $user->tokens()->delete();

        // Yangi token yaratish
        try {
            $token = $user->createToken('YourAppName')->plainTextToken;
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token yaratishda xatolik'], 401);
        }

        // Userning rolini olish (agar bir role bo'lsa)
        $role = $user->role ?? 'No role';  // Agar ko'plik bo'lsa, array bo'lishi mumkin

        // Agar userda ko'p rollar bo'lsa (many-to-many)
        // $roles = $user->roles->pluck('name');

        return response()->json([
            'token' => $token,
            'role' => $role, // Yoki ko'p rollar bo'lsa: 'roles' => $roles
            'redirect_url' => url('dashboard')
        ]);
    }

    // Agar login xato bo'lsa Unauthorized
    return response()->json(['message' => 'Unauthorized'], 401);
}


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
