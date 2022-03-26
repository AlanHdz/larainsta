<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) : JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Registered successfully',
            'token' => $user->createToken('web')->plainTextToken,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username
            ]
        ]);
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['errors' => ['global' => 'User or password incorrect']], 503);
        }

        return response()->json([
            'message' => 'Login successfully',
            'token' => $user->createToken('web')->plainTextToken,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username
            ]
        ]);
    }
}
