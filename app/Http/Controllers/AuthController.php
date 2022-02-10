<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->only('name', 'username', 'email', 'password', 'password_confirmation', 'device_name'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'device_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Registered successfully',
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username
            ]
        ]);
    }

    public function login(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->only('email', 'password', 'device_name'), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['errors' => ['global' => 'User or password incorrect']], 503);
        }

        return response()->json([
            'message' => 'Login successfully',
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username
            ]
        ]);
    }
}
