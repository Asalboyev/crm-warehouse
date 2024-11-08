<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginController extends Controller
{
   // LoginController.php
//   public function login(Request $request)
//   {
//       $credentials = $request->validate([
//           'email' => 'required|string|email',
//           'password' => 'required|string',
//       ]);
//
//       if (Auth::attempt($credentials)) {
//           $user = Auth::user();
//           $accessToken = $user->createToken('access_token')->plainTextToken; // Create access token
//           $refreshToken = Str::random(60); // Generate a random refresh token
//
//           // Store the refresh token in the database
//           $user->tokens()->updateOrCreate(
//               ['name' => 'refresh_token'],
//               ['token' => hash('sha256', $refreshToken)]
//           );
//
//           return response()->json([
//               'access_token' => $accessToken, // Return access token
//               'refresh_token' => $refreshToken, // Return refresh token
//               'role' => $user->role ?? 'No role',
//               'redirect_url' => url('dashboard'),
//           ]);
//       }
//
//       return response()->json(['message' => 'Unauthorized'], 401);
//   }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $accessToken = $user->createToken('access_token')->plainTextToken;
            $refreshToken = Str::random(60);

            // Token yaratish vaqtini saqlash va amal qilish muddatini 1 minutga o‘rnatish
            $user->tokens()->updateOrCreate(
                ['name' => 'refresh_token'],
                [
                    'token' => hash('sha256', $refreshToken),
                    'created_at' => Carbon::now(),
                    'expires_at' => Carbon::now()->addMinute(1) // Amal qilish muddati: 1 minut
                ]
            );

            return response()->json([
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'role' => $user->role ?? 'No role',
                'redirect_url' => url('dashboard'),
            ]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    public function refresh(Request $request)
        {
            $refreshToken = $request->input('refresh_token');

            // Hash the incoming refresh token
            $hashedRefreshToken = hash('sha256', $refreshToken);

            // Look for the hashed token in the database
            $userToken = DB::table('personal_access_tokens')->where('token', $hashedRefreshToken)->first();

            if (!$userToken) {
                return response()->json(['message' => 'Invalid refresh token'], 401);
            }

            // Get the user associated with the refresh token
            $user = User::find($userToken->tokenable_id);

            // Create a new access token
            $accessToken = $user->createToken('access_token')->plainTextToken; // Create new access token

            return response()->json([
                'access_token' => $accessToken, // Return new access token
                'role' => $user->role ?? 'No role',
                'redirect_url' => url('dashboard'),
            ]);
        }

    // Method to log out the user and delete all tokens
    public function logout(Request $request)
    {
        // Check if the user is authenticated
        if ($user = $request->user()) {
            // Delete all tokens
            $user->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }

        // Handle case where user is not authenticated
        return response()->json(['message' => 'User not authenticated'], 401);
    }

}
