<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'date_of_birthday' => 'required|date',
            'role' => 'required|string'
        ]);

        DB::transaction(function () use ($request) {
            $user = User::firstOrCreate([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'role' => 'client',
                'password' => Hash::make($request->password),
                'date_of_birthday' => $request->date_of_birthday,
                'remember_token' => Str::random(10),
        ]);

            $token = $user->createToken('auth_token')->accessToken;

            return response([
                'message' => 'success',
                'token' => $token,
            ], 200);
        });
    }
}
