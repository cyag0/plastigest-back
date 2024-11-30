<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $isValid = Auth::attempt($credentials);
        $user = Auth::user();

        if ($isValid) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('token')->plainTextToken
            ]);
        }

        return response()->json([
            'error' => "El email o la contraseña son incorrectos",
        ], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
