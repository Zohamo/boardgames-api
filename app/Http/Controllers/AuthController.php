<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Register a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $req)
    {
        $fields = $req->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('mathiasmille')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Log in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $req)
    {
        $fields = $req->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => "Bad creds"
            ], 401);
        }

        $token = $user->createToken('mathiasmille')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Log out user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $req)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => "Logged out"
        ];
    }
}
